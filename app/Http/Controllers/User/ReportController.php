<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\User\Purchase\ProductPurchase;
use App\Model\User\Sale\Sale;

class ReportController extends Controller
{
    public function viewStockReport(){
        $allStock = ProductPurchase::orderBy('item_name', 'ASC')
                ->where('status', '1')
                ->get();
    	return view('user.pages.report.stock', compact('allStock'));
    }

    public function viewCustomerReport(){
        $allCustomer = Sale::orderBy('customer_name', 'ASC')
                ->where('status', '1')
                ->get();
    	return view('user.pages.report.customer', compact('allCustomer'));
    }
}
