<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\User\Purchase\ProductPurchase;
use App\Model\User\Purchase\AssetPurchase;
use App\Model\User\Sale\Sale;
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
    * 'addSale(product)', 'assetSale'
    * 
    * This routes is first adding data to there own tables like
    * 'add_sales(product sales table)',
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
        $allPurchase = ProductPurchase::orderBy('item_name', 'ASC')->get();
    	return view('user.pages.sales.product', compact('allPurchase'));
    }


    public function addSale(Request $request){
        $request->validate([
            'customer_name' => 'required',
            'quentity' => 'required',
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
            
            //Checking the remaining stock of the 'product_purchases' table
            $storeQty = ProductPurchase::find($request->purchase_id);
            if($storeQty->quentity < $request->quentity){
                return redirect('/sale/product-sale')->with('error', 'Stock exceed! Remaining (' .$storeQty->item_name . ' = ' .  $storeQty->quentity .')');
                return back();
            }else{
                $sale->invoiceNum = $invoiceNum;
                $sale->purchase_id = $request->purchase_id;
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
            }
            

        }catch(\Exception $e){
            return redirect('/sale/product-sale')->with('error', $e->getMessage());
        }

        return redirect('/sale/product-sale');
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

    public function productSaleSave(Request $request){
        //Retriving data from 'sales' & 'product_purchases' table to view the 'productSalePrint' invoice
        $allSale = DB::table('sales')->orderBy('id', 'DESC')
             ->leftjoin('product_purchases', 'sales.purchase_id', 'product_purchases.id')
             ->select('sales.*', 'sales.customer_name', 'sales.phone', 'sales.invoiceNum', 'product_purchases.item_name', 'product_purchases.item_code')
             ->where('sales.token', Session('_token'))
             ->get();

        $saleUpdateTable = Sale::orderBy('id', 'DESC')
                ->where('token', Session('_token'))->get();
        
        try{
            $createdInv = $saleUpdateTable['0']['invoiceNum'];
            foreach($saleUpdateTable as $sale){
                $viewSale = new ViewSale();
                $allReceivable = new Receivable();

                //Update the 'product_purchase' table 'quentity'
                $storeQty = ProductPurchase::find($sale->purchase_id);
                $oldDiscount = $storeQty->discount / $storeQty->quentity;
                $storeQty->quentity = $storeQty->quentity - $sale->quentity;
                $storeQty->discount = $oldDiscount * $storeQty->quentity;
                $storeQty->total = $storeQty->price * $storeQty->quentity - $storeQty->discount;
                $storeQty->update();

                /*After updating data to the 'sales' table it will also save the data to the 'view_sales' table*/
                $viewSale->sales_id = $sale->id;
                $viewSale->invoiceNum = $createdInv;
                $viewSale->purchase_id = $sale->purchase_id;
                $viewSale->status = '1';
                $viewSale->save();

                //'receivable' table will get data from here, if there is
                if(!empty($sale->amountdue)){
                    $allReceivable->sales_id = $sale->id;
                    $allReceivable->purchase_id = $sale->purchase_id;
                    $allReceivable->amountdue = $sale->amountdue;
                    $allReceivable->save();
                }
                //If quentity of 'product_purchase' table is less-1(<1) it will delete the id
                if($storeQty->quentity < 1){
                    $storeQty->delete();
                }

                $sale->invoiceNum = $createdInv;
                $sale->token = null;
                $sale->status = '1';
                $sale->update();
            }

        }catch(\Exception $e){
            return redirect('/sale/product-sale')->with('error', $e->getMessage());
        }
        Session::forget('session_id');
        return redirect('/sale/product-sale')->with('success', 'Sales added successfully');
    }

    public function productSaleView()
    {
        $allSale = DB::table('sales')->orderBy('id', 'DESC')
             ->leftjoin('product_purchases', 'sales.purchase_id', 'product_purchases.id')
             ->select('sales.*', 'sales.customer_name', 'sales.phone', 'sales.invoiceNum', 'product_purchases.item_name', 'product_purchases.item_code')
             ->where('sales.token', Session('_token'))
             ->get();

        return view('user.pages.sales.product.productView', compact('allSale'));
    }

    public function productSalePrint(Request $request){
        //Retriving data from 'sales' & 'product_purchases' table to view the 'productSalePrint' invoice
        $allSale = DB::table('sales')->orderBy('id', 'DESC')
             ->leftjoin('product_purchases', 'sales.purchase_id', 'product_purchases.id')
             ->select('sales.*', 'sales.customer_name', 'sales.phone', 'sales.invoiceNum', 'product_purchases.item_name', 'product_purchases.item_code')
             ->where('sales.token', Session('_token'))
             ->get();

        $saleUpdateTable = Sale::orderBy('id', 'DESC')
                ->where('token', Session('_token'))->get();

        try{
            $pdf = PDF::loadView('user.pages.sales.product.invoice', compact('allSale'));
            $createdInv = $saleUpdateTable['0']['invoiceNum'];

            foreach($saleUpdateTable as $sale){
                //'receivable' table will get data from here, if there is
                $allReceivable = new Receivable();
                if(!empty($sale->amountdue)){
                    $allReceivable->sales_id = $sale->id;
                    $allReceivable->purchase_id = $sale->purchase_id;
                    $allReceivable->amountdue = $sale->amountdue;
                    $allReceivable->save();
                }

                //Update the 'product_purchase' table 'quentity'
                $storeQty = ProductPurchase::find($sale->purchase_id);
                $oldDiscount = $storeQty->discount / $storeQty->quentity;
                $storeQty->quentity = $storeQty->quentity - $sale->quentity;
                $storeQty->discount = $oldDiscount * $storeQty->quentity;;
                $storeQty->total = $storeQty->price * $storeQty->quentity - $storeQty->discount;
                $storeQty->update();

                /*After updating data to the 'sales' table it will also save the data to the 'view_sales' table*/
                $viewSale = new ViewSale();
                $viewSale->sales_id = $sale->id;
                $viewSale->invoiceNum = $createdInv;
                $viewSale->purchase_id = $sale->purchase_id;
                $viewSale->status = '1';
                $viewSale->save();

                
                //If quentity of 'product_purchase' table is less-1(<1) it will delete the id
                if($storeQty->quentity < 1){
                    $storeQty->delete();
                }

                $sale->invoiceNum = $createdInv;
                $sale->token = null;
                $sale->status = '1';
                $sale->update();
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

    //Route for asset sale
    public function assetSale(){
        $allAsset = AssetPurchase::orderBy('item_name', 'ASC')
                ->where('status', '1')->get();
    	return view('user.pages.sales.assetSale', compact('allAsset'));
    }

    public function addAssetSale(Request $request){
        $assetSales = new AssetSale();
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

            $assetSales->invoiceNum = $invoiceNum;
            $assetSales->item_name = $request->item_name;
            $assetSales->customer_name = $request->customer_name;
            $assetSales->price = $request->price;
            $assetSales->amountDue = $request->amountDue;
            $assetSales->description = $request->description;
            $assetSales->total = $request->total;
            $assetSales->token = $token;
            $assetSales->save();
        }catch(\Exception $e){
            return redirect('/sale/asset-sale')->with('error', $e->getMessage());
        }
        return redirect('/sale/asset-sale');
    }

    public function deleteAssetSale($id){
        $allAssetSale = AssetSale::where('token', Session('_token'))->get();
        $assetSales = AssetSale::find($id);
        if(count($allAssetSale) <= 1){
            $assetSales->delete();
            Session::forget('session_id');
            return back();
        }
        $assetSales->delete();
        return back();
    }

    public function assetSaleSave(Request $request){
        $allSale = AssetSale::orderBy('id', 'DESC')
                ->where('token', Session('_token'))->get();
        
        try{
            $createdInv = $allSale['0']['invoiceNum'];
            foreach($allSale as $sale){
                $sale->invoiceNum = $createdInv;
                $sale->token = null;
                $sale->status = '1';
                $sale->update();

            }
            Session::forget('session_id');
        }catch(\Exception $e){
            return redirect('/sale/asset-sale')->with('error', $e->getMessage());
        }
        return redirect('/sale/asset-sale')->with('success', 'Asset saved successfully');
    }

    public function assetSaleView(){
        $allSale = AssetSale::orderBy('id', 'DESC')
                ->where('token', Session('_token'))->get();
        return view('user.pages.sales.asset.assetView', compact('allSale'));
    }

    
    public function assetSalePrint(Request $request){
        $allSale = AssetSale::orderBy('id', 'DESC')
                ->where('token', Session('_token'))->get();
        try{
            $pdf = PDF::loadView('user.pages.sales.asset.invoice', compact('allSale'));
            $createdInv = $allSale['0']['invoiceNum'];
            foreach($allSale as $sale){
                $sale->invoiceNum = $createdInv;
                $sale->token = null;
                $sale->status = '1';
                $sale->update();
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
        $allSales = DB::table('sales')->orderBy('id', 'DESC')
                ->join('all_purchases', 'sales.purchase_id', '=', 'all_purchases.id')
                ->select('sales.*', 'all_purchases.item_name', 'all_purchases.item_code')
                ->where('sales.status', '1')
                ->get();
    	return view('user.pages.sales.product.allProductView', compact('allSales'));
    }

    public function viewAssetSale(){
        $allSales = AssetSale::orderBy('id', 'ASC')
                    ->where('status', '1')
                    ->get();

        return view('user.pages.sales.asset.allAssetSale', compact('allSales'));
    }
}
