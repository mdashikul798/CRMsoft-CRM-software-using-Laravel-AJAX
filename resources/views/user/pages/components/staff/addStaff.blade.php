@extends('user.layouts.app')
@section('content')
<section class="content-header">
   <div class="header-icon">
      <i class="fa fa-sticky-note-o"></i>
   </div>
   <div class="header-title">
      <h1>Office Staff</h1>
      <small>Add other goods, which is purchased</small>
   </div>
   <div class="btn-group" id="buttonlist" style="float:right;top:-45px;"> 
      <a class="btn btn-add " data-toggle="modal" data-target="#addcustom" href="#"> 
      <i class="fa fa-list"></i> All office staff</a>  
   </div>
</section>

<!-- Main content -->
<section class="content">
   <div class="row">
      <!-- Form controls -->
      <div class="col-sm-12">
         <div class="panel lobidisable panel-bd">
            <div class="panel-heading">
               <div class="btn-group" id="buttonlist"> 
                  <a class="btn btn-add " href="#"> 
                  <i class="fa fa-list"></i> Add office staff</a>  
               </div>
            </div>
            <div class="panel-body">
               <div class="col-md-6">
                  @include('user.inc.message')
               </div>
               <div class="col-md-12 col-xl-6 col-sm-12">
               <form method="post" action="{{ route('save.office.staff') }}">
	          	@csrf
				  <div class="form-group">
				    <label for="category">Person Name</label>
				    <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="category" aria-describedby="category" placeholder="Enter staff name" required>
				  </div>
				  <div class="form-group">
				    <label for="category">Designation / Post</label>
				    <input type="text" name="designation" value="{{ old('designation') }}" class="form-control" id="category" aria-describedby="category" placeholder="Enter designation" required>
				  </div>
				  <div class="form-group">
				    <label for="category">Phone</label>
				    <input type="number" name="phone" value="{{ old('phone') }}" class="form-control" id="category" aria-describedby="category" placeholder="Enter staff phone" required>
				  </div>
				  <div class="form-group">
                <label for="category">NID Number</label>
                <input type="number" name="nid_number" class="form-control" id="category" aria-describedby="category" placeholder="Enter national ID number" required>
              </div>
              <div class="form-group">
                <label for="category">Address</label>
                <input type="text" name="address" value="{{ old('address') }}" class="form-control" id="category" aria-describedby="category" placeholder="Enter address" required>
              </div>
              <div class="form-group">
                <label for="category">Address - 2 (optional)</label>
                <input type="text" name="address_2" value="{{ old('address_2') }}" class="form-control" id="category" aria-describedby="category" placeholder="Enter address">
              </div>
				  <div class="form-check">
				  	<button type="submit" class="btn btn-add pull-right w-md m-b-5">Save Staff</button>
				  </div>
				</form>
               </div>
            </div>
         </div>
      </div>
   </div>
   {{-- Model for all bank --}}
   <div class="modal fade" id="addcustom" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" style="width:80%;">
         <div class="modal-content">
            <div class="modal-header modal-header-primary">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               <h3><i class="fa fa-user m-r-5"></i> All Bank</h3>
            </div>
            <div class="modal-body">
               <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12 col-xl-10">
                     <div class="table-responsive">
	                  <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
	                     <thead>
	                        <tr>
	                           <th>SL No.</th>
	                           <th>Staff Name</th>
                             <th>Designation</th>
	                           <th>Staff Phone</th>
	                           <th>Staff NID</th>
	                           <th>Status</th>
	                           <th>Action</th>
	                        </tr>
	                     </thead>
	                     <tbody>
	                     	@php
	                     		use App\Model\User\Components\Staff;
	                     		$allStaff = Staff::orderBy('name', 'ASC')->get();
	                     	@endphp
	                        @foreach($allStaff as $staff)
	                        <tr>
	                           <td>{{ $loop->index +1 }}</td>
	                           <td>{{ $staff->name }}</td>
                             <td>{{ $staff->designation }}</td>
	                           <td>{{ $staff->phone }}</td>
	                           <td>{{ $staff->nid_number }}</td>
	                           <td>
	                              <input {{ $staff->status ==1 ? 'checked':''}} id="officeStaffStatus" data-id="{{ $staff->id}}" type="checkbox" data-toggle="toggle" data-on="Active" data-off="Inactive">
	                           </td>
	                           <td>
	                              <a href="{{ route('deleteOfficeStaff', $staff->id) }}" class="btn btn-danger btn-sm" id="delete"><i class="fa fa-trash-o"></i> </a>
	                           </td>
	                        </tr>
	                        @endforeach
	                     </tbody>
	                  </table>
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
</section>
<!-- /.content -->
@endsection