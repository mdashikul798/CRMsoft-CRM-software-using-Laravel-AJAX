<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\User\Purchase\ProductPurchase;
use App\Model\User\Purchase\AllPurchase;
use App\Model\User\Purchase\StationaryPurchase;
use App\Model\User\Purchase\AssetPurchase;
use App\Model\User\Accounting\Payable;
use App\Model\User\Components\Depreciation;
use Session;
use PDF;
use DB;

 /***
    *
    * PurchaseController
    *
    * There is some route under the 'purchases activities', that are
    * 'productPurchase', 'stationeryPurchase', 'assetPurchase'
    *
    * This routes is first adding data to there own tables like
    * 'product_purchases', 'stationery_purchases',
    * 'asset_purchases' tables with 'token' & 'status=0', after 
    * adding the data when pressing 'pring' button it will
    * change the 'status=1' and the 'token' will be 'null'
    *
    * through the '..Print' route & also adding data to
    *  the 'all_purchases' table
    * All purchases is stored at the 'all_purchases' table
    *
**/

class PurchaseController extends Controller
{
    public function productPurchase(){
    	return view('user.pages.purchase.product.product');
    }

    public function addPurchase(Request $request){
        $request->validate([
            'category_name' => 'required',
            'item_name' => 'required',
            'supplier_name' => 'required',
            'quentity' => 'required',
            'supplier_phone' => 'required',
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

            $purchase = new ProductPurchase();
            $purchase->category_id = $request->category_name;
            $purchase->invoiceNum = $invoiceNum;
            $purchase->item_code = $request->item_code;
            $purchase->item_name = $request->item_name;
            $purchase->supplier_name = $request->supplier_name;
            $purchase->bank_name = $request->bank_name;
            $purchase->supplier_phone = $request->supplier_phone;
            $purchase->quentity = $request->quentity;
            $purchase->amountdue = $request->amountdue;
            $purchase->price = $request->price;
            $purchase->discount = $request->discount * $request->quentity;
            $purchase->total = $request->total;
            $purchase->token = $token;
            $purchase->save();

        }catch(\Exception $e){
            return redirect('/purchase/product-purchase')->with('error', $e->getMessage());
        }

        return redirect('/purchase/product-purchase')->with('success', 'Purchase added successfully');
    }

    public function addPurchaseQty(Request $request, $id){
        $purchase = ProductPurchase::find($id);
        $oldQty = $purchase->quentity;
        $purchase->quentity ++;
        //calculation of the product, when adding a quentity
        $newTotal = $purchase->price * $purchase->quentity;
        $newDiscount = $purchase->discount / $oldQty * $purchase->quentity;
        $purchase->discount = $newDiscount;

        $purchase->total = $newTotal - $newDiscount - $purchase->amountdue;
        $purchase->save();

        return back();
    }

    public function reducePurchaseQty(Request $request, $id){
        $purchase = ProductPurchase::find($id);
        $oldQty = $purchase->quentity;
       $purchase->quentity --;
       //calculation of the product, when reduce a quentity
        $newTotal = $purchase->price * $purchase->quentity;
        $newDiscount = $purchase->discount / $oldQty * $purchase->quentity;
        $purchase->discount = $newDiscount;
        $purchase->total = $newTotal - $newDiscount - $purchase->amountdue;
        $purchase->save();
        //when the quentity would be 0/< then the order would be deleted
        if($purchase->quentity <= 0){
            $purchase->delete();
        }
        return back();
    }

    /*checking the product quentity more than 1 or not if 1, then when delet it, it will also delet/forget the session*/
    public function deletePurchase($id){
        $allPurchase = ProductPurchase::where('token', Session('_token'))->get();
        $purchase = ProductPurchase::find($id);
        if(count($allPurchase) <= 1){
            $purchase->delete();
            Session::forget('session_id');
            return back();
        }
        $purchase->delete();
        return back();
    }

    public function purchasePrintView(){
        $allPurchase = ProductPurchase::orderBy('id', 'DESC')
                ->where('token', Session('_token'))->get();
        return view('user.pages.purchase.product.purchaseView', compact('allPurchase'));
    }

    public function purchasePrint(Request $request){
        $allProduct = ProductPurchase::orderBy('id', 'DESC')
                ->where('token', Session('_token'))->get();
        $allPurchase = new AllPurchase();
        $allPayable = new Payable();
        try{
            $pdf = PDF::loadView('user.pages.purchase.product.invoice', compact('allPurchase'));
            $createdInv = $allProduct['0']['invoiceNum'];

            foreach($allProduct as $product){
                $product->invoiceNum = $createdInv;
                $product->token = null;
                $product->status = '1';
                $product->update();

    /*After updating data to the 'sale' table it will also save the data to the 'view_sales' & 'payables' table*/
                $allPurchase->purchase_id = $product->id;
                $allPurchase->item_code = $product->item_code;
                $allPurchase->item_name = $product->item_name;
                $allPurchase->amountdue = $product->amountdue;
                $allPurchase->status = '1';
                $allPurchase->save();

                $allPayable->purchase_id = $product->id;
                $allPayable->amountdue = $product->amountdue;
                $allPayable->save();
            }
            $pdf->stream('invoice.pdf');
            Session::forget('session_id');
            return $pdf->stream('invoice.pdf');
        }catch(\Exception $e){
            return redirect('/purchase/product-purchase')->with('error', $e->getMessage());
        }
        return redirect('/purchase/product-purchase');
    }
    //End of product sell route

    public function stationeryPurchase(){
    	return view('user.pages.purchase.stationery.stationeryPurchase');
    }

    public function addStationery(Request $request){
        $request->validate([
            'item_name' => 'required',
            'supplier_name' => 'required',
            'price' => 'required'
        ]);
        try{
            $session_id = rand(40, 100);
            $data = $request->input();
            $request->session()->put('session_id', $data);
            $token = $request->input('_token');

            //random invoice number
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $invoiceNum = substr(str_shuffle($permitted_chars), 0, 8);

            $purchase = new StationaryPurchase();
            $purchase->invoiceNum = $invoiceNum;
            $purchase->item_name = $request->item_name;
            $purchase->supplier_name = $request->supplier_name;
            $purchase->quentity = $request->quentity;
            $purchase->price = $request->price;
            $purchase->description = $request->description;
            $purchase->reference = $request->reference;
            $purchase->total = $request->price * $request->quentity;
            $purchase->token = $token;
            $purchase->save();

        }catch(\Exception $e){
            return redirect('/purchase/stationery-purchase')->with('error', $e->getMessage());
        }

        return redirect('/purchase/stationery-purchase')->with('success', 'Purchase added successfully');
    }

    public function addStationeryQty(Request $request, $id){
        $purchase = StationaryPurchase::find($id);
        $oldQty = $purchase->quentity;
        $purchase->quentity ++;
        //calculation of the product, when adding a quentity
        $newTotal = $purchase->price * $purchase->quentity;
        $purchase->total = $newTotal - $purchase->amountdue;
        $purchase->save();

        return back();
    }

    public function reduceStationeryQty(Request $request, $id){
        $purchase = StationaryPurchase::find($id);
        $oldQty = $purchase->quentity;
       $purchase->quentity --;
       //calculation of the product, when reduce a quentity
        $newTotal = $purchase->price * $purchase->quentity;
        $purchase->total = $newTotal - $purchase->amountdue;
        $purchase->save();
        //when the quentity would be 0/< then the order would be deleted
        if($purchase->quentity <= 0){
            $purchase->delete();
        }
        return back();
    }

    /*checking the product quentity more than 1 or not if 1, then when delet it, it will also delet/forget the session*/
    public function deleteStationery($id){
        $allPurchase = StationaryPurchase::where('token', Session('_token'))->get();
        $purchase = StationaryPurchase::find($id);
        if(count($allPurchase) <= 1){
            $purchase->delete();
            Session::forget('session_id');
            return back();
        }
        $purchase->delete();
        return back();
    }

    public function stationeryPrintView(){
        $allPurchase = StationaryPurchase::orderBy('id', 'DESC')
                ->where('token', Session('_token'))->get();
        return view('user.pages.purchase.stationery.stationeryView', compact('allPurchase'));
    }

    public function stationeryPrint(Request $request){
        $allPurchase = StationaryPurchase::orderBy('id', 'DESC')
                ->where('token', Session('_token'))->get();
        $viewPurchase = new AllPurchase();
        try{
            $pdf = PDF::loadView('user.pages.purchase.stationery.invoice', compact('allPurchase'));
            $createdInv = $allPurchase['0']['invoiceNum'];

            foreach($allPurchase as $purchase){
                $purchase->invoiceNum = $createdInv;
                $purchase->token = null;
                $purchase->status = '1';
                $purchase->update();

    /*After updating data to the 'StationaryPurchase' table it will also save the data to the 'view_sales' table*/
                $viewPurchase->purchase_id = $purchase->id;
                $viewPurchase->item_name = $purchase->item_name;
                $viewPurchase->status = '1';
                $viewPurchase->save();
            }
            $pdf->stream('invoice.pdf');
            Session::forget('session_id');
            return $pdf->stream('invoice.pdf');
        }catch(\Exception $e){
            return redirect('/purchase/stationery-purchase')->with('error', $e->getMessage());
        }
        return redirect('/purchase/stationery-purchase');
    }
    //End of product sell route

    public function assetPurchase(){
    	return view('user.pages.purchase.asset.assetPurchase');
    }

    public function addAsset(Request $request){
        $request->validate([
            'item_name' => 'required',
            'supplier_name' => 'required',
            'price' => 'required'
        ]);
        try{
            $session_id = rand(40, 100);
            $data = $request->input();
            $request->session()->put('session_id', $data);
            $token = $request->input('_token');

            //random invoice number
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $invoiceNum = substr(str_shuffle($permitted_chars), 0, 8);

            $purchase = new AssetPurchase();
            $purchase->invoiceNum = $invoiceNum;
            $purchase->item_name = $request->item_name;
            $purchase->supplier_name = $request->supplier_name;
            $purchase->quentity = $request->quentity;
            $purchase->bank = $request->bank;
            $purchase->price = $request->price;
            $purchase->description = $request->description;
            $purchase->total = $request->price * $request->quentity;
            $purchase->token = $token;
            $purchase->save();

        }catch(\Exception $e){
            return redirect('/purchase/asset-purchase')->with('error', $e->getMessage());
        }

        return redirect('/purchase/asset-purchase')->with('success', 'Purchase added successfully');
    }

    public function addAssetQty(Request $request, $id){
        $purchase = AssetPurchase::find($id);
        $oldQty = $purchase->quentity;
        $purchase->quentity ++;
        //calculation of the product, when adding a quentity
        $newTotal = $purchase->price * $purchase->quentity;
        $purchase->total = $newTotal - $purchase->amountdue;
        $purchase->save();

        return back();
    }

    public function reduceAssetQty(Request $request, $id){
        $purchase = AssetPurchase::find($id);
        $oldQty = $purchase->quentity;
       $purchase->quentity --;
       //calculation of the product, when reduce a quentity
        $newTotal = $purchase->price * $purchase->quentity;
        $purchase->total = $newTotal - $purchase->amountdue;
        $purchase->save();
        //when the quentity would be 0/< then the order would be deleted
        if($purchase->quentity <= 0){
            $purchase->delete();
        }
        return back();
    }

    /*checking the product quentity more than 1 or not if 1, then when delet it, it will also delet/forget the session*/
    public function deleteAsset($id){
        $allPurchase = AssetPurchase::where('token', Session('_token'))->get();
        $purchase = AssetPurchase::find($id);
        if(count($allPurchase) <= 1){
            $purchase->delete();
            Session::forget('session_id');
            return back();
        }
        $purchase->delete();
        return back();
    }

    public function assetPrintView(){
        $allPurchase = AssetPurchase::orderBy('id', 'DESC')
                ->where('token', Session('_token'))->get();
        return view('user.pages.purchase.asset.assetView', compact('allPurchase'));
    }

    public function assetPrint(Request $request){
        $allPurchase = AssetPurchase::orderBy('id', 'DESC')
                ->where('token', Session('_token'))->get();
        $viewPurchase = new AllPurchase();
        $allDepreciations = new Depreciation();

        try{
            $pdf = PDF::loadView('user.pages.purchase.asset.invoice', compact('allPurchase'));
            $createdInv = $allPurchase['0']['invoiceNum'];

            foreach($allPurchase as $purchase){
                $purchase->invoiceNum = $createdInv;
                $purchase->token = null;
                $purchase->status = '1';
                $purchase->update();

    /*After updating data to the 'stationary_purchases' table it will also save the data to the 'view_sales' and 'depreciations' table*/
                $viewPurchase->purchase_id = $purchase->id;
                $viewPurchase->item_name = $purchase->item_name;
                $viewPurchase->status = '1';
                $viewPurchase->save();

                $allDepreciations->asset_id = $purchase->id;
                $allDepreciations->asset_name = $purchase->item_name;
                $allDepreciations->purchase_price = $purchase->total;
                $allDepreciations->present_value = $purchase->total;
                $allDepreciations->purchase_date = $purchase->created_at;
                $allDepreciations->status = '1';
                $allDepreciations->save();
            }

            $pdf->stream('invoice.pdf');
            Session::forget('session_id');
            return $pdf->stream('invoice.pdf');
        }catch(\Exception $e){
            return redirect('/purchase/asset-purchase')->with('error', $e->getMessage());
        }
        return redirect('/purchase/asset-purchase');
    }
    //End of product sell route

    public function viewProductPurchase(){
        $allPurchase = DB::table('all_purchases')->orderBy('id', 'DESC')
                ->join('product_purchases', 'all_purchases.purchase_id', '=', 'product_purchases.id')
                ->select('all_purchases.*', 'product_purchases.invoiceNum', 'product_purchases.supplier_name', 'product_purchases.supplier_phone', 'product_purchases.price', 'product_purchases.quentity', 'product_purchases.discount', 'product_purchases.total')
                ->where('all_purchases.status', 1)
                ->get();

    	return view('user.pages.purchase.product.allPurchase', compact('allPurchase'));
    }

    public function viewStationeryPurchase(){
        $allPurchase = DB::table('all_purchases')->orderBy('id', 'DESC')
                ->join('stationary_purchases', 'all_purchases.purchase_id', '=', 'stationary_purchases.id')
                ->select('all_purchases.*', 'stationary_purchases.invoiceNum', 'stationary_purchases.supplier_name', 'stationary_purchases.price', 'stationary_purchases.quentity', 'stationary_purchases.total', 'stationary_purchases.reference')
                ->where('all_purchases.status', 1)
                ->get();
        return view('user.pages.purchase.stationery.allPurchase', compact('allPurchase'));
    }

    public function viewAssetPurchase(){
        $allPurchase = DB::table('all_purchases')->orderBy('id', 'DESC')
                ->join('asset_purchases', 'all_purchases.purchase_id', '=', 'asset_purchases.id')
                ->select('all_purchases.*', 'asset_purchases.invoiceNum', 'asset_purchases.supplier_name', 'asset_purchases.price', 'asset_purchases.quentity', 'asset_purchases.total')
                ->where('all_purchases.status', 1)
                ->get();
        return view('user.pages.purchase.asset.allPurchase', compact('allPurchase'));
    }
}
