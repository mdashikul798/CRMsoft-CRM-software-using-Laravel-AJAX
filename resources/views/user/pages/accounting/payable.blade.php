@extends('user.layouts.app')
@section('content')
<section class="content-header">
   <div class="header-icon">
      <i class="fa fa-bar-chart"></i>
   </div>
   <div class="header-title">
      <h1>All Payable</h1>
      <small>Customer List</small>
   </div>
   <div class="btn-group" id="buttonlist" style="float:right;top:-45px;">
      <input type="text" class="search form-control" placeholder="What you looking for?">
   </div>
   <span class="counter pull-right" style="margin-top:-38px;padding:5px;"></span>
</section>

<!-- Main content -->
<section class="content">
   <div class="col-md-6">
      @include('user.inc.message')
   </div>
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
                           <th>S.L No.</th>
                           <th>Voucher No.</th>
                           <th>Supplier Name</th>
                           <th>Supplier Phone</th>
                           <th>Product Name</th>
                           <th>Purchase Date</th>
                           <th>Payable</th>
                           <th>action</th>
                        </tr>
                        <tr class="warning no-result">
                           <td colspan="4"><i class="fa fa-warning"></i> No result matched</td>
                        </tr>
                     </thead>
                     <tbody>
                     	@php
                     		$totalPay = 0;
                     	@endphp
                        @foreach($allPayable as $payable)
                        <tr>
                        	<td>{{ $loop->index +1 }}</td>
                        	<td>{{ $payable->invoiceNum }}</td>
                        	<td>{{ $payable->supplier_name }}</td>
                           <td>{{ $payable->supplier_phone }}</td>
                           <td>{{ $payable->item_name }} - {{ $payable->item_code }}</td>
                           <td>{{ date_format(new dateTime($payable->created_at), 'd-m-y') }}</td>
                           <td class="warning">{{ number_format($payable->amountdue) }}</td>
                           <td><a href="#" class="btn btn-primary btn-xs make_payment">Paid</a></td>

                        </tr>
                        @php
                     		$totalPay += $payable->amountdue;
                     	@endphp
                        @endforeach
                        <tr>
                        	<td colspan="6" style="text-align:right;font-weight:bold;">Total payable</td>
                        	<td style="font-weight:bold;">{{ number_format($totalPay) }}</td>
                        </tr>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- customer Modal1 -->
   <div class="payable_modal modal fade" id="customer1" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header modal-header-primary">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               <h3><i class="fa fa-user m-r-5"></i> Update Payable</h3>
            </div>
            <div class="modal-body">
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-horizontal">
                        <form id="payablePaid">
                           <fieldset>
                              {{-- Hidden field to get the 'id' --}}
                              <input type="hidden" id="payable_id" name="id">
                              <!-- Text input-->
                              <div class="col-md-6 form-group">
                                 <label class="control-label">Voucher Number</label>
                                 <input type="text" id="voucher" name="voucher" class="form-control" readonly>
                              </div>
                              <div class="col-md-6 form-group">
                                 <label class="control-label">Supplier Name</label>
                                 <input type="text" id="supplier_name" class="form-control" readonly>
                              </div>
                              <div class="col-md-6 form-group">
                                 <label class="control-label">Amount Due</label>
                                 <input type="text" id="amountDue" class="form-control" readonly>
                              </div>
                              <div class="col-md-6 form-group">
                                 <label class="control-label">Amount Paid <span style="color:red;">*</span></label>
                                 <input type="number" name="paidAmount" placeholder="Enter paid amount" class="form-control">
                              </div>

                              <div class="col-md-12 form-group user-form-group">
                                 <div class="pull-right">
                                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-add btn-sm">Save</button>
                                 </div>
                              </div>
                           </fieldset>
                        </form>
                     </div>
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