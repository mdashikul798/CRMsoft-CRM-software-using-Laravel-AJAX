@extends('user.layouts.app')
@section('content')
<section class="content-header">
   <div class="header-icon">
      <i class="fa fa-clock-o"></i>
   </div>
   <div class="header-title">
      <h1>All Return</h1>
      <small>Customer List</small>
      <div class="btn-group" id="buttonlist" style="float:right;top:-31px;">
      <input type="text" class="search form-control" placeholder="What you looking for?">
      </div>
      <span class="counter pull-right" style="margin-top:-24px;padding:5px;"></span>
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
                     <h4>Sales Return</h4>
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
                           <th>SL No.</th>
                           <th>Voucher No.</th>
                           <th>Product Name</th>
                           <th>Person Name</th>
                           <th>Sales Amount</th>
                           <th>Return Amount</th>
                           <th>Difference</th>
                        </tr>
                        <tr class="warning no-result">
                           <td colspan="4"><i class="fa fa-warning"></i> No result matched</td>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($customerReturn as $return)
                        <tr>
                           <td>{{ $loop->index +1 }}</td>
                           <td>{{ $return->voucherNum }}</td>
                           <td>{{ $return->item_name }}</td>
                           <td>{{ $return->customer_name }}</td>
                           <td>{{ number_format($return->sales_total) }}</td>
                           <td>{{ number_format($return->return_amount) }}</td>
                           <td>{{ number_format($return->sales_total-$return->return_amount) }}</td>
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