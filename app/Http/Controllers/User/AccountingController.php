<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\User\Components\Depreciation;
use App\Model\User\Accounting\Receivable;
use App\Model\User\Accounting\Payable;
use DB;

class AccountingController extends Controller
{
    
    public function viewProfitLoss(){
    	return view('user.pages.accounting.pl');
    }

    public function viewFixedAsset(){
        $allAsset = Depreciation::orderBy('asset_name', 'ASC')
                    ->where('status', '1')
                    ->get();
    	return view('user.pages.accounting.asset', compact('allAsset'));
    }

    public function viewReceivable(){
    	$allReceiveables = DB::table('receivables')->orderBy('id', 'ASC')
                ->leftjoin('sales', 'receivables.sales_id', '=', 'sales.id')
                ->leftjoin('product_purchases', 'receivables.purchase_id', '=', 'product_purchases.id')
                ->select('receivables.*', 'product_purchases.item_name', 'product_purchases.item_code', 'sales.invoiceNum', 'sales.customer_name', 'sales.phone')
                ->where('receivables.status', '1')
                ->get();
    	return view('user.pages.accounting.receivable', compact('allReceiveables'));
    }

    public function receivablePaid(Request $request, $id){
        $receivable = Receivable::find($id);

        if($receivable->amountdue < $request->receivedAmount){
            return back()->with('error', 'Receivable is exceed than received!');
            return response()->json(['error', 'Receivable is exceed than received!']);
        }else{
            $receivable->amountdue = $receivable->amountdue - $request->receivedAmount;
            $receivable->update();
        }
        if($receivable->amountdue < 1){
            $receivable->delete();
        }
        
        return back()->with('success', 'Receivable added successfully!');
    }

    public function viewPayable(){
    	$allPayable = DB::table('payables')->orderBy('id', 'ASC')
                ->leftjoin('product_purchases', 'payables.purchase_id', '=', 'product_purchases.id')
                ->select('payables.*', 'product_purchases.invoiceNum', 'product_purchases.supplier_name', 'product_purchases.supplier_phone', 'product_purchases.item_name', 'product_purchases.item_code')
                ->where('payables.status', '1')
                ->get();
    	return view('user.pages.accounting.payable', compact('allPayable'));
    }

    public function payablePaid(Request $request, $id){
        $payAble = Payable::find($id);

            $payable = $payAble->amountdue;
            $paid = $request->paidAmount;
            if($payable < $paid){
                return back()->with('error', 'Payable is exceed than paid!');
                return response()->json(['error', 'Payable is exceed than paid!']);
            }else{
                $payAble->amountdue = $payable - $paid;
                $payAble->update();
            }
            if($payable < 1){
                $payAble->delete();
            }
        
        
        
        return back()->with('success', 'Payable added successfully!');
    }
}
