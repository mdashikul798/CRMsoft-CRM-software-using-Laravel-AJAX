@extends('user.layouts.app')
@section('content')
<section class="content-header">
   <div class="header-icon">
      <i class="fa fa-clock-o"></i>
   </div>
   <div class="header-title">
      <h1>Product Return to Supplier</h1>
      <small>Product return to supplier</small>
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
                  <form action="{{ route('save.supplier.return') }}" method="post">
                     @csrf
                     <div class="col-md-6 col-xl-6 col-sm-12">
                      <input type="hidden" id="invoiceNum" name="invoiceNum">
                        <div class="form-group">
                           <label>Item Code / Model</label>
                           <input type="text" id="item_code" name="item_code" class="form-control" placeholder="Enter Item Code" required>
                        </div>
                        <div class="form-group">
                           <label>Item Name</label>
                           <input type="text" id="product_name" name="item_name" class="form-control" placeholder="Enter Item Name" required>
                        </div>
                        <div class="form-group">
                           <label>Supplier Name</label>
                           <input type="text" id="supplier_name" name="supplier_name" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                           <label>Supplier Phone</label>
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
                          <label>Purchase Total</label>
                          <input type="number" id="total" name="purchase_total" class="form-control" readonly>
                       </div>
                       </div>
                    </div>
                     <div class="col-md-6 col-xl-6 col-sm-12">
                        <div class="form-group">
                           <label>Purchase Date</label>
                           <input type="text" id="date" name="date" class="form-control" readonly>
                        </div>
                        <div class="form-group" style="clear:both;">
                           <label>Return Reason</label>
                           <select name="reason" id="reason" class="form-control" required>
                              <option>Select option...</option>
                              <option value="Damage product">Damage product</option>
                              <option value="Excess of requirement">Excess of requirement</option>
                              <option value="Quality is not good">Quality is not good</option>
                              <option value="">Other</option>
                           </select>
                        </div>
                        <div class="form-group">
                          <label>Return Quentity</label>
                          <input type="number" id="return_quentity" name="return_quentity" oninput="customerReturnQty()" class="form-control" required>
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
                           <button type="submit" class="btn btn-add pull-right w-md m-b-5">Add</button>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>

   <!-- ADD Modal1 -->
   <div class="modal fade" id="addcustom" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header modal-header-primary">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               <h3><i class="fa fa-user m-r-5"></i> Add New Category</h3>
            </div>
            <div class="modal-body">
               <div class="row">
                  <div class="col-md-12">
                     <form class="form-horizontal">
                        <fieldset>
                           <!-- Text input-->
                           <div class="col-md-12 form-group">
                              <label class="control-label">Category Name:</label>
                              <input type="text" placeholder="Category Name" class="form-control">
                           </div>
                           <div class="col-md-12 form-group">
                              <label class="control-label">Description</label>
                              <textarea name="textarea" class="form-control" cols="55" rows="6"></textarea>
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
                           <div class="col-md-6 form-group">
                              <label class="control-label">Customer Name:</label>
                              <input type="text" placeholder="Customer Name" class="form-control">
                           </div>
                           <div class="col-md-6 form-group">
                              <label class="control-label">CID</label>
                              <input type="number" placeholder="CID" class="form-control">
                           </div>
                           <div class="col-md-6 form-group">
                              <label class="control-label">Price</label>
                              <input type="text" placeholder="priece" class="form-control">
                           </div>
                           <!-- Text input-->
                           <div class="col-md-6 form-group">
                              <label class="control-label">description:</label>
                              <input type="text" placeholder="details" class="form-control">
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
@endsection