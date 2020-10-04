@extends('user.layouts.app')
@section('content')
<section class="content-header">
   <div class="header-icon">
      <i class="fa fa-sticky-note-o"></i>
   </div>
   <div class="header-title">
      <h1>Other Purchase</h1>
      <small>Add other goods, which is purchased</small>
   </div>
   <div class="btn-group" id="buttonlist" style="float:right;top:-45px;"> 
      <a class="btn btn-add " data-toggle="modal" data-target="#addcustom" href="#"> 
      <i class="fa fa-list"></i> All bank account</a>  
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
                  <i class="fa fa-list"></i> Add bank account</a>  
               </div>
            </div>
            <div class="panel-body">
               <div class="col-md-6">
                  @include('user.inc.message')
               </div>
               <div class="col-md-12 col-xl-6 col-sm-12">
               <form method="post" action="{{ route('save.bank.account') }}">
	          	@csrf
				  <div class="form-group">
				    <label for="category">Bank Name</label>
				    <input type="text" name="bank_name" value="{{ old('bank_name') }}" class="form-control" id="category" aria-describedby="category" placeholder="Enter Bank Name" required>
				  </div>
				  <div class="form-group">
				    <label for="category">Bank A/C Name</label>
				    <input type="text" name="account_name" value="{{ old('account_name') }}" class="form-control" id="category" aria-describedby="category" placeholder="Enter Account Holder Name" required>
				  </div>
				  <div class="form-group">
				    <label for="category">Bank A/C Number</label>
				    <input type="number" name="account_number" class="form-control" id="category" aria-describedby="category" placeholder="Enter Account Number" required>
				  </div>
				  <div class="form-group">
				    <label for="textarea">Description</label>
				    <textarea name="description" class="form-control" cols="8" rows="6"></textarea>
				  </div>
				  <div class="form-check">
				  	<button type="submit" class="btn btn-add pull-right w-md m-b-5">Save Bank</button>
				  </div>
				</form>
               </div>
            </div>
         </div>
      </div>
   </div>
   {{-- Model for all bank --}}
   <div class="modal fade" id="addcustom" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" style="width:65%;">
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
	                           <th>Bank Name</th>
	                           <th>Bank A/C Name</th>
	                           <th>Bank Number</th>
	                           <th>Status</th>
	                           <th>Action</th>
	                        </tr>
	                     </thead>
	                     <tbody>
	                     	@php
	                     		use App\Model\User\Bank\AddBank;
	                     		$allBank = AddBank::orderBy('bank_name', 'ASC')->get();
	                     	@endphp
	                        @foreach($allBank as $bank)
	                        <tr>
	                           <td>{{ $loop->index +1 }}</td>
	                           <td>{{ $bank->bank_name }}</td>
	                           <td>{{ $bank->account_name }}</td>
	                           <td>{{ $bank->account_number }}</td>
	                           <td>
	                              <input {{ $bank->status ==1 ? 'checked':''}} id="bankStatus" data-id="{{ $bank->id}}" type="checkbox" data-toggle="toggle" data-on="Active" data-size="mini" data-off="Inactive">
	                           </td>
	                           <td>
	                              <a href="{{ route('deleteBankAccount', $bank->id) }}" class="btn btn-danger btn-sm" id="delete"><i class="fa fa-trash-o"></i> </a>
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