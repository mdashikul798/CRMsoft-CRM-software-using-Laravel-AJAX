@extends('user.layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
   <div class="header-icon">
      <i class="fa fa-sticky-note-o"></i>
   </div>
   <div class="header-title">
      <h1>Deposit</h1>
      <small>Deposite list & new Deposits</small>
   </div>
</section>

 <!-- Main content -->
<section class="content">
   <div class="row">
      <div class="col-sm-10">
         <div class="panel lobidisable panel-bd">
            <div class="panel-heading">
               <div class="panel-title">
                  <h4>Add Deposit</h4>
               </div>
            </div>
            <div class="panel-body">
               <div class="col-md-6">
                  @include('user.inc.message')
               </div>
               <form action="{{ route('save.depreciation') }}" method="post">
                  @csrf
                  <div class="form-group">
                     <input type="hidden" name="id" id="id">
                     <label style="width:100%;float:left;">Enter Asset Name</label>
                     <input type="text" name="asset_name" id="asset_name" class="form-control" required>
                  </div>
                  <div class="col-sm-12">
                     <div class="form-group col-sm-6 col-md-6">
                        <label>Purchased Price</label>
                           <input type="number" name="purchase_price" id="purchase_price" class="form-control" readonly>
                     </div>
                     <div class="form-group col-sm-6 col-md-6">
                        <label>Depreciation (%)<span style="color:red;"> *</span></label>
                           <input type="number" id="depPercent" name="percent" oninput="depreciation()" class="form-control" placeholder="Enter percent" required>
                     </div>
                  </div>
                  <div class="col-sm-12">
                     <div class="form-group col-md-6">
                        <label>Accumulated Depreciation</label>
                        <input type="number" name="accumulated" id="accumulated" class="form-control" readonly>
                     </div>
                     <div class="form-group col-md-6">
                        <label>Present Value of Asset</label>
                        <input type="number" name="present_value" id="present_value" class="form-control" readonly>
                     </div>
                  </div>
                  <div class="col-sm-12">
                     <div class="form-group col-md-6">
                        <label>Current Year Depreciation</label>
                        <input type="number" name="current_year" id="current_year" class="form-control" readonly>
                     </div>
                  </div>
                  <div class="form-group">
                     <button type="submit" class="btn btn-add w-md m-b-5 pull-right">Save</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- /.content -->
@endsection
