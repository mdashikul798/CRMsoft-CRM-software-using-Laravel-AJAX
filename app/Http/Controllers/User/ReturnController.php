<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\User\Returns\CustomerReturn;
use App\Model\User\Returns\SupplierReturn;
use Session;

class ReturnController extends Controller
{
    public function customerReturn(){
    	return view('user.pages.return.customerReturn');
    }

    public function customerReturnSearchByInv($invoiceNum){
    	if (empty($invoiceNum)) {
            return [];
        }
        $employees = DB::table('view_sales')
            ->join('sales', 'view_sales.sales_id', '=', 'sales.id')
            ->select('view_sales.*', 'sales.customer_name', 'sales.item_code', 'sales.phone', 'sales.price', 'sales.quentity', 'sales.discount', 'sales.total')
            ->where('view_sales.invoiceNum', 'LIKE', "$invoiceNum%")
            ->limit(25)
            ->get();

        return $employees;
    }

    public function customerReturnSearchByItem($itemName){
        if (empty($itemName)) {
            return [];
        }
        $employees = DB::table('view_sales')
            ->join('sales', 'view_sales.sales_id', '=', 'sales.id')
            ->select('view_sales.*', 'sales.invoiceNum', 'sales.item_code', 'sales.customer_name', 'sales.phone', 'sales.price', 'sales.quentity', 'sales.discount', 'sales.total')
            ->where('view_sales.item_name', 'LIKE', "$itemName%")
            ->limit(25)
            ->get();

        return $employees;
    }

    public function addCustomerReturn(Request $request){
        $request->validate([
            'invoice_number' => 'required',
            'item_name' => 'required',
            'customer_name' => 'required',
            'sales_total' => 'required',
            'return_reason' => 'required',
            'return_amount' => 'required'
        ]);
        $session_id = rand(40, 100);
        $data = $request->input();
        $request->session()->put('session_id', $data);
        $token = $request->input('_token');

        $return = new CustomerReturn();
        $return->voucherNum = $request->invoice_number;
        $return->item_name = $request->item_name;
        $return->customer_name = $request->customer_name;
        $return->sales_total = $request->sales_total;
        $return->sales_date = $request->sales_date;
        $return->reason = $request->return_reason;
        $return->description = $request->description;
        $return->return_amount = $request->return_amount;
        $return->token = $token;
        $return->save();

        return redirect('return/customer-return')->with('success', 'Return added successfully');
    }

    public function saveCustomerReturn(Request $request){
        $allreturn = CustomerReturn::orderBy('id', 'DESC')
                ->where('token', Session('_token'))->get();
        try{
            
            foreach($allreturn as $return){
                $return->status = '1';
                $return->token = null;
                $return->update();
            }
           
        }catch(\Exception $e){
            return redirect('return/customer-return')->with('error', $e->getMessage());
        }
        Session::forget('session_id');
        return redirect('return/customer-return')->with('success', 'Return saved successfully');
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
        $employees = DB::table('all_purchases')
            ->join('product_purchases', 'all_purchases.purchase_id', '=', 'product_purchases.id')
            ->select('all_purchases.*', 'product_purchases.item_name', 'product_purchases.supplier_name', 'product_purchases.supplier_phone', 'product_purchases.price', 'product_purchases.quentity', 'product_purchases.discount', 'product_purchases.total')
            ->where('all_purchases.item_code', 'LIKE', "$model%")
            ->limit(25)
            ->get();

        return $employees;
    }

    public function supplierReturnSearchByName($itemName){
        if (empty($itemName)) {
            return [];
        }
        $employees = DB::table('all_purchases')
            ->join('product_purchases', 'all_purchases.purchase_id', '=', 'product_purchases.id')
            ->select('all_purchases.*', 'product_purchases.item_code', 'product_purchases.supplier_name', 'product_purchases.supplier_phone', 'product_purchases.price', 'product_purchases.quentity', 'product_purchases.discount', 'product_purchases.total')
            ->where('all_purchases.item_name', 'LIKE', "$itemName%")
            ->limit(25)
            ->get();

        return $employees;
    }

    public function addSupplierReturn(Request $request){
        $request->validate([
            'item_code' => 'required',
            'item_name' => 'required',
            'reason' => 'required',
            'return_amount' => 'required'
        ]);
        $session_id = rand(40, 100);
        $data = $request->input();
        $request->session()->put('session_id', $data);
        $token = $request->input('_token');

        $return = new SupplierReturn();
        $return->item_code = $request->item_code;
        $return->item_name = $request->item_name;
        $return->supplier_name = $request->supplier_name;
        $return->purchase_total = $request->purchase_total;
        $return->purchase_date = $request->date;
        $return->reason = $request->reason;
        $return->description = $request->description;
        $return->return_amount = $request->return_amount;
        $return->token = $token;
        $return->save();

        return redirect('return/supplier-return')->with('success', 'Return added successfully');
    }

    public function saveSupplierReturn(Request $request){
        $allreturn = SupplierReturn::orderBy('id', 'DESC')
                ->where('token', Session('_token'))->get();
        try{
            
            foreach($allreturn as $return){
                $return->status = '1';
                $return->token = null;
                $return->update();
            }
           
        }catch(\Exception $e){
            return redirect('return/supplier-return')->with('error', $e->getMessage());
        }
        Session::forget('session_id');
        return redirect('return/supplier-return')->with('success', 'Return saved successfully');
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
        $customerReturn = CustomerReturn::orderBy('created_at', 'DESC')
                        ->where('status', '1')->get();
    	return view('user.pages.return.view', compact('customerReturn'));
    }
}
