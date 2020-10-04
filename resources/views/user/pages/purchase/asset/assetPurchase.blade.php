@extends('user.layouts.app')
@section('content')
<section class="content-header">
   <div class="header-icon">
      <i class="fa fa-shopping-basket"></i>
   </div>
   <div class="header-title">
      <h1>Asset Purchase</h1>
      <small>Add asset purchase</small>
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
                  <i class="fa fa-list"></i> Purchase Invoices</a>  
               </div>
            </div>
            <div class="panel-body">
               <div class="col-md-6">
                  @include('user.inc.message')
               </div>
               <div class="col-md-12 col-xl-6 col-sm-12">
               <form action="{{ route('add.asset') }}" method="post">
                  @csrf
                  <div class="col-md-6 col-xl-6 col-sm-12">
                     <div class="form-group">
                        <label>Item Name</label>
                        <input type="text" name="item_name" value="{{ old('item_name') }}" class="form-control" placeholder="Enter Item Name" required>
                        </div>
                        <div class="form-group">
                           <label>Supplier Name</label>
                           <input type="text" name="supplier_name" value="{{ old('supplier_name') }}" class="form-control" placeholder="Enter Supplier Name">
                        </div>
                        <div class="form-group">
                           <label>Item Description</label>
                           <textarea name="description" value="{{ old('description') }}" cors="55" rows="6" class="form-control"></textarea>
                        </div>
                     </div>
                  <div class="col-md-6 col-xl-6 col-sm-12">

                     <div class="form-group" style="clear:both;">
                        <label>Quantity</label>
                        <input type="number" name="quentity" id="quentity" oninput="stationary()" class="form-control" value="{{ old('quentity') }}" placeholder="Enter Quantity">
                     </div>
                     <div class="form-group">
                        <label>Price per usite</label>
                        <input type="number" name="price" id="price" oninput="stationary()" class="form-control" value="{{ old('price') }}" placeholder="Enter Price" required>
                     </div>
                     
                     <div class="form-group">
                        <div class="col-md-3 col-xl-3 col-sm-3 col-xs-6 form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" checked>
                          <label class="form-check-label" for="inlineRadio1"> Cash</label>
                        </div>
                        <div class="col-md-3 col-xl-3 col-sm-3 col-xs-6 form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2" data-toggle="collapse" data-target="#demo">
                          <label class="form-check-label" for="inlineRadio2">Bank</label>
                        </div>
                     </div>
                     @php
                        use App\Model\User\Bank\AddBank;
                        $allBank = AddBank::orderBy('bank_name', 'ASC')->where('status', '1')->get();
                     @endphp
                    <div id="demo" class="collapse" style="clear:both;">
                      <div class="form-group">
                        <label>Select Bank</label>
                        <select class="form-control" name="bank">
                           <option value="">Choose...</option>@foreach($allBank as $bank)
                              <option value="{{ $bank->id }}">{{ $bank->bank_name }}</option>
                           @endforeach
                        </select>
                     </div>
                    </div>
                     <div class="form-group" style="clear:both;">
                        <label>Total</label>
                        <input type="number" name="total" id="total" class="form-control" readonly>
                     </div>
                     <div class="reset-button">
                        <button type="submit" class="btn btn-add pull-right w-md m-b-5">Add</button>
                     </div>
                  </div>
               </form>
               </div>
               <div class="panel-body">
                  <form class="col-md-12 col-xl-6 col-sm-12">
                  <h4>Purchase Details</h4>
                  @php
                        use App\Model\User\Purchase\AssetPurchase;
                        $allPurchase = AssetPurchase::orderBy('id', 'DESC')->where('token', Session('_token'))->get();
                     @endphp
                     @if(Session::has('session_id'))
                     <a href="{{ route('asset.print.view') }}" class="btn btn-add w-md m-b-5">View & Print</a>
                     <a href="{{ route('asset.purchase.save') }}" class="btn btn-add w-md m-b-5">Save</a>

                     <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                        <thead>
                           <tr>
                              <th>SL No.</th>
                              <th>Product Name</th>
                              <th>Price</th>
                              <th>Quentity</th>
                              <th>Discount</th>
                              <th>Total</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach($allPurchase as $purchase) 
                           <tr>
                              <td>{{ $loop->index +1}}</td>
                              <td>{{ $purchase->item_name}}</td>
                              <td>{{ $purchase->price}}</td>
                              <td>{{ $purchase->quentity}}
                                 <a href="{{ route('add.asset.qty', $purchase->id) }}" class="btn btn-sm btn-warning pull-right" style="margin-left:3px;"><i class="fa fa-plus"></i></a>
                           <a href="{{ route('reduce.asset.qty', $purchase->id) }}" class="btn btn-sm btn-warning pull-right"><i class="fa fa-minus" style="margin-right:2px;"></i></a>
                              </td>
                              <td>{{ $purchase->total}}</td>
                              <td>
                                 <a href="{{ route('delete.asset', $purchase->id) }}" type="button" class="btn btn-danger btn-sm" id="delete"><i class="fa fa-trash-o"></i> </a>
                              </td>
                           </tr>
                           @endforeach
                        </tbody>
                     </table>
                     @else
                        <h4 style="text-align:center;">No stationery is added</h4>
                     @endif
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- /.content -->
@endsection