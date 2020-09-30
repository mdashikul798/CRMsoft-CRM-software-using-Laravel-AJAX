@extends('user.layouts.app')
@section('content')
<section class="content-header">
   <div class="header-icon">
      <i class="fa fa-sticky-note-o"></i>
   </div>
   <div class="header-title">
      <h1>Asset Sale</h1>
      <small>Invoices list</small>
   </div>
</section>

<!-- Main content -->
<section class="content">
   <div class="row">
      <!-- Form controls -->
      <div class="col-md-12 col-xl-12 col-sm-12">
         <div class="panel lobidisable panel-bd">
            <div class="panel-heading">
               <div class="btn-group" id="buttonlist"> 
                  <a class="btn btn-add " href="#"> 
                  <i class="fa fa-list"></i> Sales Invoices</a>  
               </div>
            </div>
            <div class="row">
               <div class="col-md-6 col-xl-6 col-sm-12">
                  <div class="panel-body">
                  <form action="{{ route('add.asset.sale') }}" method="post">
                     @csrf
                     <div class="form-group">
                        <label>Item Name</label>
                        <input type="text" name="item_name" value="{{ old('item_name') }}" class="form-control" placeholder="Enter Item Name" required>
                     </div>
                     <div class="form-group">
                        <label>Customer Name</label>
                        <input type="text" name="customer_name" value="{{ old('customer_name') }}" class="form-control" placeholder="Enter Discount">
                     </div>
                     <div class="form-group">
                        <label>Customer Phone</label>
                        <input type="number" name="phone" value="{{ old('phone') }}" class="form-control" placeholder="Enter Discount">
                     </div>
                     <div class="form-group">
                        <label>Price</label>
                        <input type="number" name="price" id="otherPrice" oninput="totalOtherSale()" class="form-control" placeholder="Enter Price">
                     </div>
                     <div class="form-group">
                        <label>Due Amount</label>
                        <input type="number" name="amountDue" id="amountDue" oninput="totalOtherSale()" class="form-control" placeholder="Enter Due">
                     </div>
                     <div class="form-group">
                        <label>Description</label>
                        <textarea name="textarea" name="description" class="form-control" cols="55" rows="6"></textarea>
                     </div>
                     <div class="form-group">
                        <label>Total</label>
                        <input type="number" name="total" id="otherTotal" class="form-control" placeholder="Enter total" readonly>
                     </div>
                     <div class="reset-button">
                        <button type="submit" class="btn btn-add pull-right w-md m-b-5">Add</button>
                     </div>
                  </form>
                  </div>
               </div>
                  <div class="col-md-6 col-xl-6 col-sm-12"> 
                     
                     <div class="panel-body">
                        @include('user.inc.message')
                     
                     <form method="post">
                        
                        @php
                        use App\Model\User\Sale\AssetSale;
                        $allSale = AssetSale::orderBy('id', 'DESC')
                              ->where('token', Session('_token'))->get();
                        @endphp
                        @if(Session::has('session_id'))
                        <a href="{{ route('asset.sale.view') }}" class="btn btn-add w-md m-b-5">View & Print</a>

                        <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                           <thead>
                              <tr>
                                 <th>SL No.</th>
                                 <th>Product Name</th>
                                 <th>Customer Name</th>
                                 <th>Total</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           
                           <tbody id="productTable">
                              @foreach($allSale as $sale)
                              <tr>
                                 <td>{{ $loop->index +1 }}</td>
                                 <td>{{ $sale->item_name}}</td>
                                 <td>{{ $sale->customer_name}}</td>
                                 <td>{{ number_format($sale->total) }}</td>
                                 <td>
                                    <a href="{{ route('delete.asset.sale', $sale->id) }}" type="button" class="btn btn-danger btn-sm" id="delete"><i class="fa fa-trash-o"></i> </a>
                                 </td>
                              </tr>
                              @endforeach
                              
                           </tbody>
                        </table>
                        @else
                           <h4>No other sales added</h4>
                        @endif
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- /.content -->
@endsection