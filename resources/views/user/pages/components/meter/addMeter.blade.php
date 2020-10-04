@extends('user.layouts.app')
@section('content')
<section class="content-header">
   <div class="header-icon">
      <i class="fa fa-sticky-note-o"></i>
   </div>
   <div class="header-title">
      <h1>Electricity Meter</h1>
      <small>Add other goods, which is purchased</small>
   </div>
   <div class="btn-group" id="buttonlist" style="float:right;top:-45px;"> 
      <a class="btn btn-add " data-toggle="modal" data-target="#addcustom" href="#"> 
      <i class="fa fa-list"></i> View Meter</a>  
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
                  <i class="fa fa-list"></i> Add Meter</a>  
               </div>
            </div>
            <div class="panel-body">
               <div class="col-md-6">
                  @include('user.inc.message')
               </div>
               <div class="col-md-12 col-xl-6 col-sm-12">
               <form method="post" action="{{ route('save.meter') }}">
	          	@csrf
  				  <div class="form-group">
  				    <label for="category">Meter Name</label>
  				    <input type="text" name="meter_name" value="{{ old('meter_name') }}" class="form-control" id="category" aria-describedby="category" placeholder="Enter meter name" required>
  				  </div>
  				  <div class="form-group">
  				    <label for="category">Meter Number</label>
  				    <input type="text" name="meter_number" value="{{ old('meter_number') }}" class="form-control" id="category" aria-describedby="category" placeholder="Enter meter number" required>
  				  </div>
            <div class="form-group">
              <label for="category">Description (optional)</label>
              <textarea name="description" cols='8' rows="6" class="form-control"></textarea>
            </div>
  				  <div class="form-check">
  				  	<button type="submit" class="btn btn-add pull-right w-md m-b-5">Save Meter</button>
  				  </div>
  				</form>
               </div>
            </div>
         </div>
      </div>
   </div>
   {{-- Model for all bank --}}
   <div class="modal fade" id="addcustom" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" style="width:60%;">
         <div class="modal-content">
            <div class="modal-header modal-header-primary">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               <h3><i class="fa fa-user m-r-5"></i> View Meter</h3>
            </div>
            <div class="modal-body">
               <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12 col-xl-10">
                     <div class="table-responsive">
	                  <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
	                     <thead>
	                        <tr>
	                           <th>SL No.</th>
	                           <th>Meter Name</th>
                             <th>Meter Number</th>
	                           <th>Description</th>
	                           <th>Status</th>
	                           <th>Action</th>
	                        </tr>
	                     </thead>
	                     <tbody>
	                     	@php
	                     		use App\Model\User\Components\Meter;
	                     		$allMeter = Meter::orderBy('id', 'ASC')->get();
	                     	@endphp
	                        @foreach($allMeter as $meter)
	                        <tr>
	                           <td>{{ $loop->index +1 }}</td>
	                           <td>{{ $meter->meter_name }}</td>
                             <td>{{ $meter->meter_number }}</td>
	                           <td>{{ $meter->description }}</td>
	                           <td>
	                              <input {{ $meter->status ==1 ? 'checked':''}} id="changeMeterStatus" data-id="{{ $meter->id}}" type="checkbox" data-toggle="toggle" data-on="Active" data-off="Inactive" data-size="mini">
	                           </td>
	                           <td>
	                              <a href="{{ route('deleteMeter', $meter->id) }}" class="btn btn-danger btn-sm" id="delete"><i class="fa fa-trash-o"></i> </a>
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