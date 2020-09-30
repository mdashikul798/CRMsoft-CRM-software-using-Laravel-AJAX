@extends('user.layouts.app')
@section('content')
<section class="content-header">
   <div class="header-icon">
      <i class="fa fa-sticky-note-o"></i>
   </div>
   <div class="header-title">
      <h1>Supplier</h1>
      <small>Supplier list</small>
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
                  <a class="btn btn-add " href="{{ route('view.supplier') }}"> 
                  <i class="fa fa-list"></i> View Supplier</a>  
               </div>
            </div>

            <div class="panel-body">
               <div class="col-md-12 col-xl-6 col-sm-12">
                  <form action="{{ route('save.supplier') }}" method="post">
                     @csrf
                     <div class="col-md-6 col-xl-6 col-sm-12">
                        <div class="form-group">
                           <label>Supplier Name</label>
                           <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Enter Item code" required>
                        </div>
                        <div class="form-group">
                           <label>Supplier Phone</label>
                           <input type="text" name="phone" class="form-control" placeholder="Enter Item Name" required>
                        </div>
                        <div class="form-group">
                           <label>Email (optional)</label>
                           <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Enter Quantity">
                        </div>
                     </div>
                     <div class="col-md-6 col-xl-6 col-sm-12">
                        <div class="form-group" style="clear:both;">
                           <label>Supplier Address</label>
                           <input type="text" name="address" value="{{ old('address') }}" class="form-control" placeholder="Enter Quantity">
                        </div>
                        <div class="form-group">
                           <label>Address-2 (optional)</label>
                           <input type="text" name="address_2" value="{{ old('address_2') }}" class="form-control" placeholder="Enter Price">
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
</section>
@endsection