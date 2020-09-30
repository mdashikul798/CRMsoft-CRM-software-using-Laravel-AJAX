@extends('user.layouts.app')
@section('content')
<section class="content-header">
   <div class="header-icon">
      <i class="fa fa-list"></i>
   </div>
   <div class="header-title">
      <h1>All Category</h1>
      <small>Below categories are available</small>
   </div>
</section>

<!-- Main content -->
<section class="content">
   <div class="row">
      <div class="col-sm-6">
         @include('user.inc.message')
      </div>
      <div class="col-sm-12">
         <div class="panel lobidisable panel-bd">
		    <div class="panel-heading">
		       <div class="panel-title">
		          <h4>Category</h4>
		       </div>
		    </div>
            <div class="panel-body">
            <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
               <div class="btn-group">
               <div class="buttonexport" id="buttonlist"> 
                  <a class="btn btn-add" href="#" data-toggle="modal" data-target="#addcustom"> <i class="fa fa-plus"></i> Add new category
                  </a>  
               </div>
               </div>
               <!-- ./Plugin content:powerpoint,txt,pdf,png,word,xl -->
               <div class="table-responsive">
                  <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                     <thead>
                        <tr>
                           <th>SL No.</th>
                           <th>Category Name</th>
                           <th>Status</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($allCategory as $category)
                        <tr>
                           <td>{{ $loop->index +1 }}</td>
                           <td>{{ $category->category_name }}</td>
                           <td>
                              <input {{ $category->status ==1 ? 'checked':''}}  data-size="mini" id="cateStatus" data-id="{{ $category->id}}" type="checkbox" data-toggle="toggle" data-on="Active" data-off="Inactive">
                           </td>
                           <td>
                              <a href="{{ route('delete.category', $category->id) }}" class="btn btn-danger btn-sm" id="delete"><i class="fa fa-trash-o"></i> </a>
                           </td>
                        </tr>
                        @endforeach
                     </tbody>
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
               <h3><i class="fa fa-user m-r-5"></i> Add New Category</h3>
            </div>
            <div class="modal-body">
               <div class="row">
                  <div class="col-md-12">
                     <form class="form-horizontal" method="post" action="{{ route('save.category') }}">
                        @csrf
                        <fieldset>
                           <!-- Text input-->
                           <div class="col-md-12 form-group">
                              <label class="control-label">Category Name:</label>
                              <input type="text" name="category_name" placeholder="Category Name" class="form-control">
                           </div>
                           <div class="col-md-12 form-group">
                              <label class="control-label">Description</label>
                              <textarea name="description" class="form-control" cols="55" rows="6"></textarea>
                           </div>
                           
                           
                           <div class="col-md-12 form-group user-form-group">
                              <div class="pull-right">
                                 <button type="button" data-dismiss="modal" class="btn btn-danger btn-sm">Cancel</button>
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
   <!-- Customer Modal2 -->
   <div class="modal fade" id="customer2" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header modal-header-primary">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               <h3><i class="fa fa-user m-r-5"></i> Delete Category</h3>
            </div>
            <div class="modal-body">
               <div class="row">
                  <div class="col-md-12">
                     <form class="form-horizontal">
                        <fieldset>
                           <div class="col-md-12 form-group user-form-group">
                              <label class="control-label">Do you want to delete category permanently</label>
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