@extends('user.layouts.app')
@section('content')
<div class="panel-body">
   <div class="col-md-12 col-xl-6 col-sm-12"> 
   <form>
      <h4>Sales Details</h4>
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
            @foreach($allSale as $sale)
            <tr>
               <td>{{ $loop->index +1 }}</td>
               <td>{{ $sale->item_name}}</td>
               <td>{{ $sale->price}}</td>
               <td>{{ $sale->quentity}}</td>
               <td>{{ $sale->discount}}</td>
               <td>{{ $sale->total}}</td>
               <td>
                  <button type="button" class="btn btn-add btn-sm" data-toggle="modal" data-target="#customer1"><i class="fa fa-pencil"></i></button>
                  <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#customer2"><i class="fa fa-trash-o"></i> </button>
               </td>
            </tr>
            @endforeach
         </tbody>
      </table>
   </form>
   </div>
</div>
@endsection