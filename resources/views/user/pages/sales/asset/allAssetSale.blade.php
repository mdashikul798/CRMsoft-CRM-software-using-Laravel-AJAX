@extends('user.layouts.app')
@section('content')
<section class="content-header">
   <div class="header-icon">
      <i class="fa fa-shopping-cart"></i>
   </div>
   <div class="header-title">
      <h1>All Asset Sale</h1>
      <small>Asset List</small>
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
                     <h4>Sales incorporation</h4>
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
                           <th>Voucher No.</th>
                           <th>Customer Name</th>
                           <th>Date</th>
                           <th>Product Name</th>
                           <th>Price</th>
                           <th>Total</th>
                           <th>Description</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($allSales as $sale)
                        <tr>
                           <td>{{ $loop->index +1 }}</td>
                           <td>{{ $sale->invoiceNum }}</td>
                           <td>{{ $sale->customer_name }}</td>
                           <td>{{ date_format(new dateTime($sale->created_at), 'd-m-y') }}</td>
                           <td>{{ $sale->item_name }}</td>
                           <td>{{ number_format($sale->price) }}</td>
                           <td>{{ number_format($sale->total) }}</td>
                           <td>{{ $sale->description }}</td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- customer Modal1 -->
   <div class="modal fade" id="customer1" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header modal-header-primary">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               <h3><i class="fa fa-user m-r-5"></i> Update Customer</h3>
            </div>
            <div class="modal-body">
               <div class="row">
                  <div class="col-md-12">
                     <form class="form-horizontal">
                        <fieldset>
                           <!-- Text input-->
                           <div class="col-md-4 form-group">
                              <label class="control-label">Customer Name:</label>
                              <input type="text" placeholder="Customer Name" class="form-control">
                           </div>
                           <!-- Text input-->
                           <div class="col-md-4 form-group">
                              <label class="control-label">Email:</label>
                              <input type="email" placeholder="Email" class="form-control">
                           </div>
                           <!-- Text input-->
                           <div class="col-md-4 form-group">
                              <label class="control-label">Mobile</label>
                              <input type="number" placeholder="Mobile" class="form-control">
                           </div>
                           <div class="col-md-6 form-group">
                              <label class="control-label">Address</label><br>
                              <textarea name="address" rows="3"></textarea>
                           </div>
                           <div class="col-md-6 form-group">
                              <label class="control-label">type</label>
                              <input type="text" placeholder="type" class="form-control">
                           </div>
                           <div class="col-md-12 form-group user-form-group">
                              <div class="pull-right">
                                 <button type="button" class="btn btn-danger btn-sm">Cancel</button>
                                 <button type="submit" class="btn btn-add btn-sm">Save</button>
                              </div>
                           </div>
                        </fieldset>
                     </form>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
            </div>
         </div>
         <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
   </div>
   <!-- /.modal -->
   <!-- Modal -->    
   <!-- Customer Modal2 -->
   <div class="modal fade" id="customer2" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header modal-header-primary">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               <h3><i class="fa fa-user m-r-5"></i> Delete Customer</h3>
            </div>
            <div class="modal-body">
               <div class="row">
                  <div class="col-md-12">
                     <form class="form-horizontal">
                        <fieldset>
                           <div class="col-md-12 form-group user-form-group">
                              <label class="control-label">Delete Customer</label>
                              <div class="pull-right">
                                 <button type="button" class="btn btn-danger btn-sm">NO</button>
                                 <button type="submit" class="btn btn-add btn-sm">YES</button>
                              </div>
                           </div>
                        </fieldset>
                     </form>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
            </div>
         </div>
         <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
   </div>
   <!-- /.modal -->
</section>
   <!-- customer Modal1 -->
@endsection