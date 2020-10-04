@extends('user.layouts.app')
@section('content')
<section class="content-header">
   <div class="header-icon">
      <i class="fa fa-users"></i>
   </div>
   <div class="header-title">
      <h1>View Stock</h1>
      <small>Stock List</small>
   </div>
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
                  <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                     <thead>
                        <tr class="info">
                           <th>SL No.</th>
                           <th>Product Name</th>
                           <th>Supplier Name</th>
                           <th>Entry Date</th>
                           <th>Exp. Date</th>
                           <th>Price</th>
                           <th>Qty</th>
                           <th>Total</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($allStock as $stock)
                        <tr>
                           <td>{{ $loop->index +1 }}</td>
                           <td>{{ $stock->item_name }} - {{ $stock->item_code }}</td>
                           <td>{{ $stock->supplier_name }}</td>
                           <td>{{ date_format($stock->created_at, 'd-m-y') }}</td>
                           <td>{{ date_format(new dateTime($stock->exp_date), 'd-m-y') }}</td>
                           <td>{{ number_format($stock->price) }}</td>
                           <td>{{ $stock->quentity }}</td>
                           <td>{{ number_format($stock->total) }}</td>
                        </tr>
                        @endforeach
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