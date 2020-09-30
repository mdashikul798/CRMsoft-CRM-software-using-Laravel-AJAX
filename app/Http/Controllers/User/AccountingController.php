<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\User\Components\Depreciation;
use DB;

class AccountingController extends Controller
{
    public function viewBalanceSheet(){
    	return view('user.pages.accounting.balance');
    }

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
                ->select('receivables.*', 'sales.customer_name', 'sales.phone', 'sales.item_name', 'sales.item_code', 'sales.invoiceNum')
                ->where('receivables.status', 1)
                ->get();
    	return view('user.pages.accounting.receivable', compact('allReceiveables'));
    }

    public function viewPayable(){
    	$allPayable = DB::table('payables')->orderBy('id', 'ASC')
                ->leftjoin('product_purchases', 'payables.purchase_id', '=', 'product_purchases.id')
                ->select('payables.*', 'product_purchases.supplier_name', 'product_purchases.supplier_phone', 'product_purchases.item_name', 'product_purchases.item_code', 'product_purchases.invoiceNum')
                ->where('payables.status', 1)
                ->get();
    	return view('user.pages.accounting.payable', compact('allPayable'));
    }
}
