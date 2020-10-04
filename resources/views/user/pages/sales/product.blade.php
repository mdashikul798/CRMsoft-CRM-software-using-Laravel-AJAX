@extends('user.layouts.app')
@section('content')
<section class="content-header">
   <div class="header-icon">
      <i class="fa fa-shopping-cart"></i>
   </div>
   <div class="header-title">
      <h1>Product Sale</h1>
      <small>Make a sales invoices from here</small>
   </div>
</section>

<!-- Main content -->
<section class="content">
   <div class="row">
      <div class="col-sm-12">
         <div class="panel lobidisable panel-bd">
            <div class="panel-heading">
               <div class="btn-group" id="buttonlist"> 
                  <a class="btn btn-add " href="#"> 
                  <i class="fa fa-list"></i> Add your sales</a>  
               </div>
            </div>
            <div class="panel-body">
               <div class="col-md-6">
                  @include('user.inc.message')
               </div>
               <div class="col-md-12 col-xl-6 col-sm-12">
               <form method="post" action="{{ route('add.sale') }}">
                  @csrf
                  <div class="col-md-6 col-xl-6 col-sm-12">
                     <div class="form-group">
                        <label>Select Product</label>
                        <select name="purchase_id" class="form-control chosen" required>
                           <option value="">Choose...</option>
                           @foreach($allPurchase as $product)
                              <option value="{{ $product->id }}">{{ $product->item_name }} - {{ $product->item_code }}</option>
                           @endforeach
                        </select>
                     </div>
                     <div class="form-group">
                        <label>Customer Name</label>
                        <input type="text" name="customer_name" class="form-control" value="{{ old('customer_name') }}" placeholder="Enter Customer Name" required>
                     </div>
                    <div class="form-group" style="clear:both;">
                        <label>Customer Phone</label>
                        <input type="text" name="customer_phone" class="form-control" value="{{ old('customer_phone') }}" placeholder="Enter Customer Phone">
                     </div>
                     <div class="form-group">
                        <div class="col-md-3 col-xl-3 col-sm-3 col-xs-6 form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" checked>
                          <label class="form-check-label" for="inlineRadio1"> Cash</label>
                        </div>
                        <div class="col-md-3 col-xl-3 col-sm-3 col-xs-6 form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2" data-toggle="collapse" data-target="#demo">
                          <label class="form-check-label" for="inlineRadio2"> Bank</label>
                        </div>
                     </div>
                     @php
                        use App\Model\User\Bank\AddBank;
                        $allBank = AddBank::orderBy('bank_name', 'ASC')->where('status', '1')->get();
                     @endphp
                    <div id="demo" class="collapse" style="clear:both;">
                      <div class="form-group">
                        <label>Select Bank</label>
                        <select class="form-control" name="bank_name">
                           <option value="">Choose...</option>
                           @foreach($allBank as $bank)
                              <option value="{{ $bank->id }}">{{ $bank->bank_name }}</option>
                           @endforeach
                        </select>
                     </div>
                    </div>
                    <div class="form-group" style="clear:both;">
                        <label>Quantity</label>
                        <input type="number" name="quentity" id="quentity" oninput="changeTotalSale()" class="form-control" value="{{ old('quentity') }}" placeholder="Enter Quantity">
                     </div>
                  </div>
                  <div class="col-md-6 col-xl-6 col-sm-12">
                     <div class="form-group">
                        <label>Discount (per unit)</label>
                        <input type="number" name="discount" id="discount" oninput="changeTotalSale()" class="form-control" value="{{ old('discount') }}" placeholder="Enter Discount">
                     </div>
                     <div class="form-group">
                        <label>Price per usit</label>
                        <input type="number" name="price" id="price" oninput="changeTotalSale()" class="form-control" value="{{ old('price') }}" placeholder="Enter Price" required>
                     </div>
                     <div class="form-group">
                        <label>Amount Due</label>
                        <input type="number" name="amountdue" id="amountDue" oninput="changeTotalSale()" class="form-control" value="{{ old('amountdue') }}" placeholder="Enter Due Amount">
                     </div>
                     <div class="form-group">
                        <label>Total</label>
                        <input type="number" name="total" id="total" class="form-control" placeholder="Enter total" readonly>
                     </div>
                     <div class="reset-button">
                        
                        <button type="submit" class="btn btn-add pull-right w-md m-b-5">Add</button>
                     </div>
                  </div>
               </form>
               </div>
            </div>
            <div class="panel-body">
               <div class="col-md-12 col-xl-6 col-sm-12"> 
               <form>
                  <h4>Sales Details</h4>
                  @php
                     $allSale = DB::table('sales')->orderBy('id', 'DESC')
                           ->leftjoin('product_purchases', 'sales.purchase_id', 'product_purchases.id')
                           ->select('sales.*', 'product_purchases.item_name', 'product_purchases.item_code')
                           ->where('sales.token', Session('_token'))
                           ->get();
                  @endphp
                  @if(Session::has('session_id'))

                  <a href="{{ route('product.print.view') }}" class="btn btn-add w-md m-b-5">View & Print</a>
                  <a href="{{ route('product.sale.save') }}" class="btn btn-add w-md m-b-5">Save</a>

                  <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                     <thead>
                        <tr>
                           <th>SL No.</th>
                           <th>Product Name</th>
                           <th>Price</th>
                           <th>Quentity</th>
                           <th>Discount</th>
                           <th>Amount Due</th>
                           <th>Total</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody id="productTable">
                        @foreach($allSale as $sale)
                        <tr>
                           <td>{{ $loop->index +1 }}</td>
                           <td>{{ $sale->item_name}} - {{ $sale->item_code}}</td>
                           <td>{{ number_format($sale->price) }}</td>
                           <td>{{ $sale->quentity}}
                              <a href="{{ route('add.sale.qty', $sale->id) }}" class="btn btn-sm btn-warning pull-right" style="margin-left:3px;"><i class="fa fa-plus"></i></a>
                              <a href="{{ route('reduce.sale.qty', $sale->id) }}" class="btn btn-sm btn-warning pull-right"><i class="fa fa-minus" style="margin-right:2px;"></i></a>
                           </td>
                           <td>{{ number_format($sale->discount) }}</td>
                           <td>{{ number_format($sale->amountdue) }}</td>
                           <td>{{ number_format($sale->total) }}</td>
                           <td>
                              <a href="{{ route('delete.product', $sale->id) }}" type="button" class="btn btn-danger btn-sm" id="delete"><i class="fa fa-trash-o"></i> </a>
                           </td>
                        </tr>
                     </tbody>
                     @endforeach
                  </table>
                  @else
                     <h3 style="text-align:center;">No item added</h3>
                  @endif
               </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
@endsection
