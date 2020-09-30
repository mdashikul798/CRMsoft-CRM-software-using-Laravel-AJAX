@extends('user.layouts.app')
@section('content')
<section class="content-header">
   <div class="header-icon">
      <i class="fa fa-list"></i>
   </div>
   <div class="header-title">
      <h1>All Supplier</h1>
      <small>Below supplier are available</small>
   </div>
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
		       <div class="panel-title">
		          <h4>Suppliers</h4>
		       </div>
		    </div>
            <div class="panel-body">
            <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
               <div class="btn-group">
               <div class="buttonexport" id="buttonlist"> 
                  <a href="#" class="btn btn-add" data-toggle="modal" data-target="#addcustom"> <i class="fa fa-plus"></i> Add new supplier
                  </a>  
               </div>
               </div>
               
               <!-- ./Plugin content:powerpoint,txt,pdf,png,word,xl -->
               <div class="table-responsive">
                  <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                     <thead>
                        <tr>
                           <th>SL No.</th>
                           <th>Supplier Name</th>
                           <th>Phone</th>
                           <th>Email</th>
                           <th>Address</th>
                           <th>Status</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     @foreach($allSupplier as $supplier)
                     <tbody class="tbldata">
                        <tr>
                           <td>{{ $supplier->id }}</td>
                           <td>{{ $supplier->name }}</td>
                           <td>{{ $supplier->phone }}</td>
                           <td>{{ $supplier->email }}</td>
                           <td>{{ $supplier->address }}</td>
                           <td>
                              <input {{ $supplier->status == 1 ? 'checked' : ''}} id="supplierStatus" data-id="{{ $supplier->id }}" data-on="Active" data-off="Inactive" data-toggle="toggle" type="checkbox">
                           </td>
                           <td>
                              <a href="#" class="btn btn-add btn-sm edit_supplier"><i class="fa fa-pencil"></i></a>

                              <a href="{{ route('deleteSupplier', $supplier->id) }}" type="button" class="btn btn-danger btn-sm" id="delete"><i class="fa fa-trash-o"></i> </a>
                           </td>
                        </tr>
                     </tbody>
                     @endforeach
                  </table>
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
               <h3><i class="fa fa-user m-r-5"></i> Add New Supplier</h3>
            </div>
            <div class="modal-body">
               <div class="row">
                  <div class="col-md-12">
                     <form class="form-horizontal" id="sample_form">
                        <fieldset>
                           <!-- Text input-->
                           <div class="col-md-12 form-group">
                              <label class="control-label">Supplier Name:</label>
                              <input type="text" placeholder="Category Name" class="form-control">
                           </div>
                           <div class="col-md-12 form-group">
                              <label class="control-label">Supplier Phone</label>
                              <input type="text" placeholder="Category Name" class="form-control">
                           </div>
                           <div class="col-md-12 form-group">
                              <label class="control-label">Email (optional)</label>
                              <input type="text" placeholder="Category Name" class="form-control">
                           </div>
                           <div class="col-md-12 form-group">
                              <label class="control-label">Supplier Address</label>
                              <input type="text" placeholder="Category Name" class="form-control">
                           </div>
                           <div class="col-md-12 form-group">
                              <label class="control-label">Address-2 (optional)</label>
                              <input type="text" placeholder="Category Name" class="form-control">
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
   <div class="edit_modal modal fade" id="customer1" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header modal-header-primary">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               <h3><i class="fa fa-user m-r-5"></i> Update Supplier</h3>
            </div>
            <div class="modal-body">
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-horizontal">

                        <input type="hidden" name="id" id="id">
                        <input type="hidden" name="name" id="name">
                        <input type="hidden" name="address_2" id="address_2">
                        <input type="hidden" name="id" id="id">
                        
                        <form id="supplierId">
                           <fieldset>
                              <!-- Text input-->
                              <div class="col-md-6 form-group">
                                 <label class="control-label">Supplier Phone:</label>
                                 <input type="text" name="phone" id="phone" placeholder="Supplier phone" class="form-control">
                              </div>
                              <div class="col-md-6 form-group">
                                 <label class="control-label">Supplier Email</label>
                                 <input type="text" name="email" id="email" placeholder="Enter email" class="form-control">
                              </div>
                              <div class="col-md-12 form-group">
                                 <label class="control-label">Address</label>
                                 <input type="text" name="address" id="address" placeholder="Enter address" class="form-control">
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
<!-- /.content -->
@endsection