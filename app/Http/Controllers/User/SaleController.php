<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\User\Category;
use App\Model\User\Sale\Sale;
use App\Model\User\Sale\OtherSale;
use App\Model\User\Sale\AssetSale;
use App\Model\User\Sale\ViewSale;
use App\Model\User\Accounting\Receivable;
use Session;
use PDF;
use DB;

 /***
    *
    * SaleController
    *
    * There is some route under the 'sale activities', that are
    * 'addSale(product)', 'otherSale', 'assetSale'
    * 
    * This routes is first adding data to there own tables like
    * 'add_sales(product sales table)', 'other_sales',
    * 'asset_sales' tables with 'token' & 'status=0', after 
    * adding the data when pressing 'pring' button it will
    * change the 'status=1' and the 'token' will be 'null'
    *
    * through the '..Print' route & also adding data to
    *  the 'view_sales' table
    * All sales is stored at the 'view_sales' table
    *
**/
 
class SaleController extends Controller
{
    //Route for the product sell
    public function saleProduct(){
        $allCategory = Category::orderBy('category_name', 'ASC')->get();
    	return view('user.pages.sales.product', compact('allCategory'));
    }

    public function addSale(Request $request){
        $request->validate([
            'category_name' => 'required',
            'item_name' => 'required',
            'customer_name' => 'required',
            'quentity' => 'required',
            'customer_phone' => 'required',
            'price' => 'required|integer'
        ]);
        try{
            $session_id = rand(40, 100);
            $data = $request->input();
            $request->session()->put('session_id', $data);
            $token = $request->input('_token');

            //random invoice number
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $invoiceNum = substr(str_shuffle($permitted_chars), 0, 8);

            $sale = new Sale();
            $sale->category_id = $request->category_name;
            $sale->invoiceNum = $invoiceNum;
            $sale->item_code = $request->item_code;
            $sale->item_name = $request->item_name;
            $sale->customer_name = $request->customer_name;
            $sale->bank_name = $request->bank_name;
            $sale->phone = $request->customer_phone;
            $sale->quentity = $request->quentity;
            $sale->amountdue = $request->amountdue;
            $sale->price = $request->price;
            $sale->discount = $request->discount * $request->quentity;
            $sale->total = $request->total;
            $sale->token = $token;
            $sale->save();

        }catch(\Exception $e){
            return redirect('/sale/product-sale')->with('error', $e->getMessage());
        }

        return redirect('/sale/product-sale')->with('success', 'Sale added successfully');
    }

    public function addSaleQty(Request $request, $id){
        $sale = Sale::find($id);
        $oldQty = $sale->quentity;
        $sale->quentity ++;
        //calculation of the product, when adding a quentity
        $newTotal = $sale->price * $sale->quentity;
        $newDiscount = $sale->discount / $oldQty * $sale->quentity;
        $sale->discount = $newDiscount;

        $sale->total = $newTotal - $newDiscount - $sale->amountdue;
        $sale->save();

        return back();
    }

    public function reduceSaleQty(Request $request, $id){
        $sale = Sale::find($id);
        $oldQty = $sale->quentity;
       $sale->quentity --;
       //calculation of the product, when reduce a quentity
        $newTotal = $sale->price * $sale->quentity;
        $newDiscount = $sale->discount / $oldQty * $sale->quentity;
        $sale->discount = $newDiscount;
        $sale->total = $newTotal - $newDiscount - $sale->amountdue;
        $sale->save();
        //when the quentity would be 0/< then the order would be deleted
        if($sale->quentity <= 0){
            $sale->delete();
        }
        return back();
    }

    /*checking the product quentity more than 1 or not if 1, then when delet it, it will also delet/forget the session*/

    public function deleteProduct($id){
        $allSale = Sale::where('token', Session('_token'))->get();
        $sale = Sale::find($id);
        if(count($allSale) <= 1){
            $sale->delete();
            Session::forget('session_id');
            return back();
        }
        $sale->delete();
        return back();
    }

    public function productSaleView(){
        $allSale = Sale::orderBy('id', 'DESC')
                ->where('token', Session('_token'))->get();
        return view('user.pages.sales.product.productView', compact('allSale'));
    }

    public function productSalePrint(Request $request){
        $allSale = Sale::orderBy('id', 'DESC')
                ->where('token', Session('_token'))->get();
        $viewSale = new ViewSale();
        $allReceivable = new Receivable();
        try{
            $pdf = PDF::loadView('user.pages.sales.product.invoice', compact('allSale'));
            $createdInv = $allSale['0']['invoiceNum'];

            foreach($allSale as $sale){
                $sale->invoiceNum = $createdInv;
                $sale->token = null;
                $sale->status = '1';
                $sale->update();

    /*After updating data to the 'sale' table it will also save the data to the 'view_sales' table*/

                $viewSale->sales_id = $sale->id;
                $viewSale->invoiceNum = $createdInv;
                $viewSale->item_name = $sale->item_name;
                $viewSale->status = '1';
                $viewSale->save();

                $allReceivable->sales_id = $sale->id;
                $allReceivable->amountdue = $sale->amountdue;
                $allReceivable->save();
            }
            $pdf->stream('invoice.pdf');
            Session::forget('session_id');
            return $pdf->stream('invoice.pdf');
        }catch(\Exception $e){
            return redirect('/sale/product-sale')->with('error', $e->getMessage());
        }
        return redirect('/sale/product-sale');
    }
    //End of product sell route

    //Route for otherSale
    public function otherSale(){
    	return view('user.pages.sales.otherSale');
    }

    public function addOtherSale(Request $request){
        $otherSale = new OtherSale();
        $request->validate([
            'item_name' => 'required',
            'customer_name' => 'required',
            'price' => 'required'
        ]);

        try{
            $session_id = rand(40, 100);
            $data = $request->input();
            $request->session()->put('session_id', $data);
            $token = $request->input('_token');

            //creating random invoice number
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $invoiceNum = substr(str_shuffle($permitted_chars), 0, 8);

            $otherSale->invoiceNum = $invoiceNum;
            $otherSale->item_name = $request->item_name;
            $otherSale->customer_name = $request->customer_name;
            $otherSale->price = $request->price;
            $otherSale->amountDue = $request->amountDue;
            $otherSale->description = $request->description;
            $otherSale->total = $request->total;
            $otherSale->token = $token;
            $otherSale->save();
        }catch(\Exception $e){
            return redirect('/sale/other-sale')->with('error', $e->getMessage());
        }
        return back()->with('success', 'Sale added successfully');
    }

    public function deleteOtherSale($id){
        $allOtherSale = OtherSale::where('token', Session('_token'))->get();
        $otherSale = OtherSale::find($id);
        if(count($allOtherSale) <= 1){
            $otherSale->delete();
            Session::forget('session_id');
            return back();
        }
        $otherSale->delete();
        return back();
    }

    public function otherSaleView(){
        $allSale = OtherSale::orderBy('id', 'DESC')
                ->where('token', Session('_token'))->get();
        return view('user.pages.sales.other.otherView', compact('allSale'));
    }

    public function otherSalePrint(Request $request){
        $allSale = OtherSale::orderBy('id', 'DESC')
                ->where('token', Session('_token'))->get();
        $viewSale = new ViewSale();
        try{
            $pdf = PDF::loadView('user.pages.sales.other.invoice', compact('allSale'));
            $createdInv = $allSale['0']['invoiceNum'];
            foreach($allSale as $sale){
                $sale->invoiceNum = $createdInv;
                $sale->token = null;
                $sale->status = '1';
                $sale->update();

    /*After updating data to the 'sale' table it will also save the data to the 'view_sales' table*/
    
                $viewSale->sales_id = $sale->id;
                $viewSale->invoiceNum = $createdInv;
                $viewSale->item_name = $sale->item_name;
                $viewSale->status = '1';
                $viewSale->save();
            }
            $pdf->stream('invoice.pdf');
            Session::forget('session_id');
            return $pdf->stream('invoice.pdf');
        }catch(\Exception $e){
            return redirect('/sale/other-sale')->with('error', $e->getMessage());
        }
        return redirect('/sale/other-sale');
    }
    //End of other sale

    //Route for asset sale
    public function assetSale(){
    	return view('user.pages.sales.assetSale');
    }

    public function addAssetSale(Request $request){
        $otherSale = new AssetSale();
        $request->validate([
            'item_name' => 'required',
            'customer_name' => 'required',
            'price' => 'required'
        ]);

        try{
            $session_id = rand(40, 100);
            $data = $request->input();
            $request->session()->put('session_id', $data);
            $token = $request->input('_token');

            //creating random invoice number
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $invoiceNum = substr(str_shuffle($permitted_chars), 0, 8);

            $otherSale->invoiceNum = $invoiceNum;
            $otherSale->item_name = $request->item_name;
            $otherSale->customer_name = $request->customer_name;
            $otherSale->price = $request->price;
            $otherSale->amountDue = $request->amountDue;
            $otherSale->description = $request->description;
            $otherSale->total = $request->total;
            $otherSale->token = $token;
            $otherSale->save();
        }catch(\Exception $e){
            return redirect('/sale/asset-sale')->with('error', $e->getMessage());
        }
        return back()->with('success', 'Asset sale added successfully');
    }

    public function deleteAssetSale($id){
        $allOtherSale = AssetSale::where('token', Session('_token'))->get();
        $otherSale = AssetSale::find($id);
        if(count($allOtherSale) <= 1){
            $otherSale->delete();
            Session::forget('session_id');
            return back();
        }
        $otherSale->delete();
        return back();
    }

    public function assetSaleView(){
        $allSale = AssetSale::orderBy('id', 'DESC')
                ->where('token', Session('_token'))->get();
        return view('user.pages.sales.asset.assetView', compact('allSale'));
    }

    public function assetSalePrint(Request $request){
        $allSale = AssetSale::orderBy('id', 'DESC')
                ->where('token', Session('_token'))->get();
        $viewSale = new ViewSale();
        try{
            $pdf = PDF::loadView('user.pages.sales.asset.invoice', compact('allSale'));
            $createdInv = $allSale['0']['invoiceNum'];
            foreach($allSale as $sale){
                $sale->invoiceNum = $createdInv;
                $sale->token = null;
                $sale->status = '1';
                $sale->update();

    /*After updating data to the 'sale' table it will also save the data to the 'view_sales' table*/
                $viewSale->sales_id = $sale->id;
                $viewSale->invoiceNum = $createdInv;
                $viewSale->item_name = $sale->item_name;
                $viewSale->status = '1';
                $viewSale->save();
            }
            $pdf->stream('invoice.pdf');
            Session::forget('session_id');
            return $pdf->stream('invoice.pdf');
        }catch(\Exception $e){
            return redirect('/sale/asset-sale')->with('error', $e->getMessage());
        }
        return redirect('/sale/asset-sale');
    }

    //Functions for view all sales
    public function viewProductSale(){
        $allSales = DB::table('view_sales')->orderBy('id', 'DESC')
                ->join('sales', 'view_sales.sales_id', '=', 'sales.id')
                ->select('view_sales.*', 'sales.customer_name', 'sales.phone', 'sales.price', 'sales.quentity', 'sales.discount', 'sales.total')
                ->limit(10)
                ->get();
                
    	return view('user.pages.sales.product.allProductView', compact('allSales'));
    }

    public function viewOtherSale(){
        $allSales = DB::table('view_sales')->orderBy('id', 'DESC')
                ->join('other_sales', 'view_sales.sales_id', '=', 'other_sales.id')
                ->select('view_sales.*', 'other_sales.invoiceNum', 'other_sales.customer_name', 'other_sales.description', 'other_sales.price', 'other_sales.total')
                ->get();

        return view('user.pages.sales.other.allOtherSale', compact('allSales'));
    }

    public function viewAssetSale(){
        $allSales = DB::table('view_sales')->orderBy('id', 'DESC')
                ->join('asset_sales', 'view_sales.sales_id', '=', 'asset_sales.id')
                ->select('view_sales.*', 'asset_sales.invoiceNum', 'asset_sales.customer_name', 'asset_sales.description', 'asset_sales.price', 'asset_sales.total')
                ->get();

        return view('user.pages.sales.asset.allAssetSale', compact('allSales'));
    }
}
