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
                           <th>Customer Name</th>
                           <th>Customer Phone</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($allCustomer as $customer)
                        <tr>
                           <td>{{ $loop->index +1}}</td>
                           <td>{{ $customer->customer_name}}</td>
                           <td>{{ $customer->phone}}</td>
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