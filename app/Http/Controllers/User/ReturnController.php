<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\User\Returns\CustomerReturn;
use App\Model\User\Returns\SupplierReturn;
use App\Model\User\Returns\AllReturn;
use App\Model\User\Purchase\ProductPurchase;
use App\Model\User\Sale\ViewSale;
use App\Model\User\Sale\Sale;
use Session;

class ReturnController extends Controller
{
    public function customerReturn(){
    	return view('user.pages.return.customerReturn');
    }

    //Retriving data from 'view_sales', 'sales', 'product_purchases', 'all_purchases' table to view the 'customerReturn'
    public function customerReturnSearchByInv($invoiceNum){
    	if (empty($invoiceNum)) {
            return [];
        }
        $return = DB::table('sales')
            ->leftjoin('all_purchases', 'sales.purchase_id', '=', 'all_purchases.purchase_id')
            ->select('sales.*', 'all_purchases.item_name', 'all_purchases.item_code', 'all_purchases.supplier_name','all_purchases.supplier_phone', 'all_purchases.supplier_name', 'all_purchases.category_id')
            ->where('sales.invoiceNum', 'LIKE', "$invoiceNum%")
            ->limit(25)
            ->get();

        return $return;
    }

    public function customerReturnSearchByItem($itemName){
        if (empty($itemName)) {
            return [];
        }
        $employees = DB::table('sales')
            ->leftjoin('all_purchases', 'sales.purchase_id', '=', 'all_purchases.purchase_id')
            ->select('sales.*', 'all_purchases.item_code', 'all_purchases.item_name', 'all_purchases.category_id', 'all_purchases.supplier_name','all_purchases.supplier_phone')
            ->where('all_purchases.item_name', 'LIKE', "$itemName%")
            ->limit(25)
            ->get();

        return $employees;
    }

    public function saveCustomerReturn(Request $request){
        $request->validate([
            'invoice_number' => 'required',
            'item_name' => 'required',
            'customer_name' => 'required',
            'sales_total' => 'required',
            'return_reason' => 'required',
            'return_amount' => 'required'
        ]);
        try{
            $return = new CustomerReturn();
            $return->purchase_id = $request->purchase_id;
            $return->voucherNum = $request->invoice_number;
            $return->item_name = $request->item_name;
            $return->customer_name = $request->customer_name;
            $return->sales_total = $request->sales_total;
            $return->sales_date = $request->sales_date;
            $return->reason = $request->return_reason;
            $return->return_quentity = $request->return_quentity;
            $return->description = $request->description;
            $return->return_amount = $request->return_amount;
            $return->save();

            //Changing the 'sales' table's 'quentity, total and discount'
            $allProduct = Sale::where('invoiceNum', $return->voucherNum)->get();
            foreach ($allProduct as $product) {
                $oldDis = $product->discount / $product->quentity;
                $qty = $product->quentity - $return->return_quentity;
                $product->quentity = $qty;
                $product->discount = $oldDis * $qty;
                $product->total = $product->price * $qty;
                $product->update();

                if($product->quentity < 1){
                    $product->delete();
                }
            }

            //Return also save in 'all_returns' table
            $allRetunt = new AllReturn();
            $allRetunt->customer_ret_id = $return->id;
            $allRetunt->save();

        }catch(\Exception $e){
            return redirect('return/customer-return')->with('error', $e->getMessage());
        }
        return redirect('return/customer-return')->with('success', 'Return added successfully');
        Session::forget('session_id');
    }


    public function deleteCustomerReturn($id){
        $allreturn = CustomerReturn::where('token', Session('_token'))->get();
        $return = CustomerReturn::find($id);
        if(count($allreturn) <= 1){
            $return->delete();
            Session::forget('session_id');
            return back();
        }
        $return->delete();
        return back();
    }

    public function supplierReturn(){
    	return view('user.pages.return.supplierReturn');

    }

    public function supplierReturnSearchByModel($model){
        if (empty($model)) {
            return [];
        }
        $employees = DB::table('product_purchases')
            ->select('product_purchases.*')
            ->where('product_purchases.item_code', 'LIKE', "$model%")
            ->limit(25)
            ->get();

        return $employees;
    }

    public function supplierReturnSearchByName($itemName){
        if (empty($itemName)) {
            return [];
        }
        $employees = DB::table('product_purchases')
            ->select('product_purchases.*')
            ->where('product_purchases.item_name', 'LIKE', "$itemName%")
            ->limit(25)
            ->get();

        return $employees;
    }

    public function saveSupplierReturn(Request $request){
        $request->validate([
            'item_code' => 'required',
            'item_name' => 'required',
            'reason' => 'required',
            'return_amount' => 'required'
        ]);
        try{
        $return = new SupplierReturn();
        $return->invoiceNum = $request->invoiceNum;
        $return->item_code = $request->item_code;
        $return->item_name = $request->item_name;
        $return->supplier_name = $request->supplier_name;
        $return->return_quentity = $request->return_quentity;
        $return->purchase_total = $request->purchase_total;
        $return->purchase_date = $request->date;
        $return->reason = $request->reason;
        $return->description = $request->description;
        $return->return_amount = $request->return_amount;
        $return->status = '1';
        $return->save();

        $allProduct = ProductPurchase::where('invoiceNum', $return->invoiceNum)->get();
            foreach ($allProduct as $product) {
                $oldDis = $product->discount / $product->quentity;
                $qty = $product->quentity - $return->return_quentity;
                
                $product->quentity = $qty;
                $product->discount = $oldDis * $qty;
                $product->total = $product->price * $qty;
                $product->update();

                if($product->quentity < 1){
                    $product->delete();
                }
            }

        //Return also save in 'all_returns' table
        $allRetunt = new AllReturn();
        $allRetunt->supplier_ret_id = $return->id;
        $allRetunt->save();

        }catch(\Exception $e){
            return redirect('return/supplier-return')->with('error', $e->getMessage());
        }
        return redirect('return/supplier-return')->with('success', 'Return added successfully');
        Session::forget('session_id');
    }

    public function deleteSupplierReturn($id){
        $allreturn = SupplierReturn::where('token', Session('_token'))->get();
        $return = SupplierReturn::find($id);
        if(count($allreturn) <= 1){
            $return->delete();
            Session::forget('session_id');
            return back();
        }
        $return->delete();
        return back();
    }

    public function viewReturn(){
        $customerReturn = DB::table('customer_returns')
                ->select('customer_returns.*')
                ->where('status', '1')
                ->get();
    	return view('user.pages.return.view', compact('customerReturn'));
    }
}
