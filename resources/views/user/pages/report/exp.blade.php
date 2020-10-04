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
                           <th>Buyer Name</th>
                           <th>Sales ID</th>
                           <th>Date</th>
                           <th>Product Name</th>
                           <th>Price</th>
                           <th>Quentity</th>
                           <th>Discount</th>
                           <th>Total</th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <td><img src="assets/dist/img/w2.png" class="img-circle" alt="User Image" width="50" height="50"> </td>
                           <td>MD. Alrazy</td>
                           <td>+8801674688663</td>
                           <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="f2939e8093888bb2869a979f979f9b9c9b81869780dc919d9f">[email&#160;protected]</a></td>
                           <td>98 Green Rd, Dhaka 1215, Bangladesh</td>
                           <td>V.I.P</td>
                           <td>27th April,2017</td>
                           <td>27th April,2017</td>
                           <td>27th April,2017</td>
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