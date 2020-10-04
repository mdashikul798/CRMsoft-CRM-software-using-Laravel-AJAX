@extends('user.layouts.app')
@section('content')
<section class="content-header">
   <div class="header-icon">
      <i class="fa fa-clock-o"></i>
   </div>
   <div class="header-title">
      <h1>Product Return from Customer</h1>
      <small>Product return form customer</small>
   </div>
</section>

<!-- Main content -->
<section class="content">
   <div class="col-md-6">
      @include('user.inc.message')
   </div>
   <div class="row">
      <!-- Form controls -->
      <div class="col-sm-12">
         <div class="panel lobidisable panel-bd">
            <div class="panel-heading">
               <div class="btn-group" id="buttonlist"> 
                  <a class="btn btn-add " href="#">
                  <i class="fa fa-list"></i> View Return</a>  
               </div>
            </div>
            <div class="panel-body">
               <div class="col-md-12 col-xl-6 col-sm-12">
               <form action="{{ route('save.customer.return') }}" method="post">
                  @csrf
                  <div class="col-md-6 col-xl-6 col-sm-12">
                    <input type="hidden" id="purchase_id" name="purchase_id">
                     <div class="form-group">
                        <label>Voucher Number</label>
                        <input type="text" id="invoiceNum" name="invoice_number" class="form-control" placeholder="Enter voucher number" required>
                     </div>
                     <div class="form-group">
                        <label>Item Name</label>
                        <input type="text" id="item_name" name="item_name" class="form-control" placeholder="Enter Item Name" required>
                     </div>
                     <div class="form-group">
                        <label>Customer Name</label>
                        <input type="text" id="customer_name" name="customer_name" class="form-control" readonly>
                     </div>
                     <div class="form-group">
                        <label>Customer Phone</label>
                        <input type="number" id="phone" name="phone" class="form-control" readonly>
                     </div>
                     
                    <div class="form-group col-md-12 col-sm-12 col-xl-12 col-xs-12" style="clear:both;">
                     <div class="col-md-6 col-sm-12 col-xl-6 col-xs-12">
                        <label>Sales Price</label>
                        <input type="number" id="price" name="price" class="form-control" readonly>
                     </div>
                     <div class="col-md-6 col-sm-12 col-xl-6 col-xs-12">
                        <label>Sales Quentity</label>
                        <input type="number" id="quentity" name="quentity" class="form-control" readonly>
                     </div>
                     </div>
                     <div class="form-group col-md-12 col-sm-12 col-xl-12 col-xs-12" style="clear:both;">
                     <div class="col-md-6 col-sm-12 col-xl-6 col-xs-12">
                        <label>Sales Discount</label>
                        <input type="number" id="discount" name="discount" class="form-control" readonly>
                     </div>
                     <div class="col-md-6 col-sm-12 col-xl-6 col-xs-12">
                        <label>Sales Total</label>
                        <input type="number" id="total" name="sales_total" class="form-control" readonly>
                     </div>
                     </div>
                  </div>
                  <div class="col-md-6 col-xl-6 col-sm-12">
                     <div class="form-group" style="clear:both;">
                        <label>Sales Date</label>
                        <input type="text" id="date" name="sales_date" class="form-control" readonly>
                     </div>
                     <div class="form-group" style="clear:both;">
                        <label>Return Reason</label>
                        <select name="return_reason" id="return_reason" class="form-control" required>
                           <option value="">Select option...</option>
                           <option value="Damage product">Damage product</option>
                           <option value="Excess of requirement">Excess of requirement</option>
                           <option value="Quality is not good">Quality is not good</option>
                           <option value="Other">Other</option>
                        </select>
                     </div>
                     <div class="form-group">
                        <label>Return Quentity</label>
                        <input type="number" id="return_quentity" name="return_quentity" oninput="customerReturnQty()" class="form-control" placeholder="Enter Price" required>
                     </div>
                     <div class="form-group" style="clear:both;">
                        <label>Description</label>
                        <textarea name="description" class="form-control" cols="30" rows="6"></textarea>
                     </div>
                     <div class="form-group">
                        <label>Return Amount</label>
                        <input type="number" id="return_amount" name="return_amount" class="form-control" readonly>
                     </div>
                     <div class="reset-button">
                        <button type="submit" class="btn btn-add pull-right w-md m-b-5">Save Return</button>
                     </div>
                  </div>
               </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
@endsection