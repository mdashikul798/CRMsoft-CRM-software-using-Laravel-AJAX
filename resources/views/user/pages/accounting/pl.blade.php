@extends('user.layouts.app')
@section('content')
  @php
  //Retriving data from the database table
  	$productSales = DB::table('sales')->select('sales.*')
        ->where('sales.status', 1)
        ->get();
    $salesReturn = DB::table('customer_returns')->select('customer_returns.*')
        ->where('customer_returns.status', 1)
        ->get();
    $productPurchases = DB::table('product_purchases')->select('product_purchases.*')
        ->where('product_purchases.status', 1)
        ->get();
    $purchasesReturn = DB::table('supplier_returns')->select('supplier_returns.*')
        ->where('supplier_returns.status', 1)
        ->get();
    $operatingExp = DB::table('operatings')->select('operatings.*')
        ->where('operatings.status', 1)
        ->get();
    $administrativeExp = DB::table('admin_expenses')->select('admin_expenses.*')
        ->where('admin_expenses.status', 1)
        ->get();
    $otherIncome = DB::table('other_incomes')->select('other_incomes.*')
        ->where('other_incomes.status', 1)
        ->get();
    $assetSales = DB::table('asset_sales')->select('asset_sales.*')
        ->where('status', 1)
        ->get();
    $depreciation = DB::table('depreciations')->select('depreciations.*')
        ->where('status', 1)
        ->get();

    $totalSales = collect($productSales)->sum('total') - collect($salesReturn)->sum('return_amount') + collect($productSales)->sum('amountdue');
    $stock = collect($productPurchases)->sum('total') - $totalSales;
    $totalPurchase = collect($productPurchases)->sum('total') - collect($purchasesReturn)->sum('return_amount') - $stock + collect($productPurchases)->sum('amountdue');

    $grossProfit = $totalSales - $totalPurchase;
    $opeProfit = $grossProfit - collect($operatingExp)->sum('amount') - collect($administrativeExp)->sum('amount') - collect($depreciation)->sum('depreciation');
    $otherInc = collect($otherIncome)->sum('total') + collect($assetSales)->sum('total');
    $netProfit = $opeProfit + $otherInc;
    @endphp
  {{-- <p>Total amount: {{ number_format(collect($allReceiveables)->sum('total')) }}</p> --}}

  <section class="content-header">
   <div class="header-icon">
      <i class="fa fa-bar-chart"></i>
   </div>
   <div class="header-title">
      <h1>All Product Sale</h1>
      <small>Customer List</small>
   </div>
   <div class="btn-group" id="buttonlist" style="float:right;top:-45px;">
      <input type="text" class="search form-control" placeholder="What you looking for?">
   </div>
   <span class="counter pull-right" style="margin-top:-38px;padding:5px;"></span>
</section>

<!-- Main content -->
<section class="content">
   <div class="row">
      <div class="col-sm-12">
         <div class="panel lobidisable panel-bd">
            <div class="panel-heading">
               <div class="btn-group" id="buttonexport">
                  <a href="#">
                     <h4>Sales incormation</h4>
                  </a>
               </div>
            </div>
            <div class="panel-body">
            <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
               <div class="btn-group">
                  <button class="btn btn-exp btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i> Export Table Data</button>
                  <ul class="dropdown-menu exp-drop" role="menu">
                     <li>
                        <a href="#"> 
                        <i class="fa fa-download" aria-hidden="true"></i> Download</a>
                     </li>
                     <li>
                        <a href="#"> 
                        <i class="fa fa-file-pdf-o"></i> PDF</a>
                     </li>
                     <li>
                        <a href="#"> <i class="fa fa-print"></i> Print</a>
                     </li>
                  </ul>
               </div>
               <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
               <div class="table-responsive">
                  <table id="dataTableExample1" class="table table-bordered table-striped table-hover results">
                     <thead>
                        <tr class="info">
                           	<th width="70%">Description</th>
	                        <th width="30%">Amount TK.</th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
	                    	  <td width="70%">Product Sales</td>
	                    	  <td width="30%">{{ number_format(collect($productSales)->sum('total')) }}</td>
                        </tr>
                        <tr>
	                       <td width="70%">(Less) Sales Return</td>
	                       <td width="30%">{{ number_format(collect($salesReturn)->sum('return_amount')) }}</td>
                        </tr>
                        <tr>
	                       <td width="70%" style="font-weight:bold;">(A) Total Sales</td>
	                       <td width="30%" style="font-weight:bold;">{{ number_format($totalSales) }}</td>
                        </tr>
                        <tr>
	                       <td width="70%">Product Purchase</td>
	                       <td width="30%">{{ number_format(collect($productPurchases)->sum('total')) }}</td>
                        </tr>
                        <tr>
	                       <td width="70%">(Less) Stock</td>
	                       <td width="30%">{{ number_format($stock) }}</td>
                        </tr>
                        <tr>
	                       <td width="70%">(Less) Purchase Return</td>
	                       <td width="30%">{{ number_format(collect($purchasesReturn)->sum('return_amount')) }}</td>
                        </tr>
                        <tr>
	                       <td width="70%" style="font-weight:bold;">(B) Total Purchase</td>
	                       <td width="30%" style="font-weight:bold;">{{ number_format($totalPurchase) }}</td>
                        </tr>
                        <tr>
	                       <td width="70%" style="font-weight:bold;">(C) Gross Profit / Loss (A-B)</td>
	                       <td width="30%" style="font-weight:bold;">{{ number_format($grossProfit) }}</td>
                        </tr>
                        <tr>
	                       <td width="70%">
                         (D) Operating Expense</td>
	                       <td width="30%">{{ number_format(collect($operatingExp)->sum('amount')) }}</td>
                        </tr>
                        <tr>
                         <td width="70%">
                         (E) Depreciation Expense</td>
                         <td width="30%">{{ number_format(collect($depreciation)->sum('depreciation')) }}</td>
                        </tr>
                        <tr>
	                       <td width="70%">
	                       (F) Administrative Expense</td>
	                       <td width="30%">{{ number_format(collect($administrativeExp)->sum('amount')) }}</td>
                        </tr>
                        <tr>
	                       <td width="70%" style="font-weight:bold;">
	                       (G) Operating Profit / Loss (C-D-E-F)</td>
	                       <td width="30%" style="font-weight:bold;">{{ number_format($opeProfit) }}</td>
                        </tr>
                        <tr>
	                       <td width="70%">
	                       (H) Other Income</td>
	                       <td width="30%">{{ number_format($otherInc) }}</td>
                        </tr>
                        <tr>
	                       <td width="70%" style="font-weight:bold;">
	                       (I) Net Profit / Loss (G+H)</td>
	                       <td width="30%" style="font-weight:bold;">{{ number_format($netProfit) }}</td>
                        </tr>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
   <!-- customer Modal1 -->
@endsection
