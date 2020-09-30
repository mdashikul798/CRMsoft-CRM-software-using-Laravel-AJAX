@extends('user.layouts.app')
@section('content')
<section class="content-header">
   <div class="header-icon">
      <i class="fa fa-sticky-note-o"></i>
   </div>
   <div class="header-title">
      <h1>Other Income</h1>
      <small>Other income list</small>
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
                  <a class="btn btn-add " href="#"> 
                  <i class="fa fa-list"></i> View Other Income</a>  
               </div>
            </div>
            <div class="panel-body">
               <div class="col-md-12 col-xl-6 col-sm-12">
                  <form action="{{ route('save.other.income') }}" method="post">
                     @csrf
                     <div class="col-md-6 col-xl-6 col-sm-12">
                        
                        <div class="form-group">
                           <label>Other Income Name</label>
                           <input type="text" name="income_name" value="{{ old('income_name') }}" class="form-control" placeholder="Enter Item Name" required>
                        </div>
                        <div class="form-group">
                           <label>Customer Name</label>
                           <input type="text" name="customer_name" value="{{ old('customer_name') }}" class="form-control" placeholder="Enter Quantity" required>
                        </div>
                        <div class="form-group" style="clear:both;">
                           <label>Customer Phone</label>
                           <input type="text" name="phone" value="{{ old('phone') }}" class="form-control" placeholder="Enter Quantity">
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
                        <div id="demo" class="collapse" style="clear:both;">
                         <div class="form-group">
                           <label>Select Bank</label>
                           <select class="form-control" name="bank_name">
                              <option>US dollar</option>
                              <option>Australian dollar</option>
                              <option>Bdt</option>
                              <option>Canadian dollar</option>
                              <option>Euro</option>
                              <option>Pound</option>
                           </select>
                        </div>
                       </div>
                       <div class="form-group" style="clear:both;">
                           <label>Email (optional)</label>
                           <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Enter Price">
                        </div>
                     </div>
                     <div class="col-md-6 col-xl-6 col-sm-12">
                        <div class="form-group" style="clear:both;">
                           <label>Price</label>
                           <input type="number" name="price" id="price" oninput="totalOtherIncome()" class="form-control" placeholder="Enter Price" required>
                        </div>
                        <div class="form-group" style="clear:both;">
                        <label>Amount Due</label>
                        <input type="number" id="due" name="due" oninput="totalOtherIncome()" class="form-control" placeholder="Enter Price">
                        </div>
                        <div class="form-group">
                           <label>Description (optional)</label>
                           <textarea name="description" class="form-control" cols="30" rows="5"></textarea>
                        </div>
                        
                        <div class="form-group">
                           <label>Total</label>
                           <input type="number" id="total" name="total" class="form-control" placeholder="Enter total" required>
                        </div>
                        <div class="reset-button">
                           <button type="submit" class="btn btn-add pull-right w-md m-b-5">Add</button>
                        </div>
                     </div>
                  </form>
               </div>
               <div class="panel-body">
                  <div class="col-md-12 col-xl-6 col-sm-12"> 
                  <form>
                     <h4>Sales Details</h4>
                     @php
                        use App\Model\User\OtherIncome\OtherIncome;
                        $allIncome = OtherIncome::orderBy('id', 'DESC')
                           ->where('token', Session('_token'))->get();
                     @endphp
                     @if(Session::has('session_id'))

                     <a href="{{ route('other.income.print.view') }}" class="btn btn-add w-md m-b-5">View & Print</a>

                     <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                        <thead>
                           <tr>
                              <th>SL No.</th>
                              <th>Income Name</th>
                              <th>Customer Name</th>
                              <th>Phone</th>
                              <th>Price</th>
                              <th>Amount Due</th>
                              <th>Total</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody id="productTable">
                           @foreach($allIncome as $income)
                           <tr>
                              <td>{{ $loop->index +1 }}</td>
                              <td>{{ $income->income_name}}</td>
                              <td>{{ $income->customer_name}}</td>
                              <td>{{ $income->phone}}</td>
                              <td>{{ number_format($income->price) }}</td>
                              <td>{{ number_format($income->due) }}</td>
                              <td>{{ number_format($income->total) }}</td>
                              <td>
                                 <a href="{{ route('delete.other.income', $income->id) }}" type="button" class="btn btn-danger btn-sm" id="delete"><i class="fa fa-trash-o"></i> </a>
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
                     <form class="form-horizontal">
                        <fieldset>
                           <!-- Text input-->
                           <div class="col-md-12 form-group">
                              <label class="control-label">Category Name:</label>
                              <input type="text" placeholder="Category Name" class="form-control">
                           </div>
                           <div class="col-md-12 form-group">
                              <label class="control-label">Description</label>
                              <textarea name="textarea" class="form-control" cols="55" rows="6"></textarea>
                           </div>
                           
                           
                           <div class="col-md-12 form-group user-form-group">
                              <div class="pull-right">
                                 <button type="button" class="btn btn-danger btn-sm">Cancel</button>
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
   <!-- Modal -->    
   <!-- customer Modal1 -->
   <div class="modal fade" id="customer1" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header modal-header-primary">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               <h3><i class="fa fa-user m-r-5"></i> Update Customer</h3>
            </div>
            <div class="modal-body">
               <div class="row">
                  <div class="col-md-12">
                     <form class="form-horizontal">
                        <fieldset>
                           <!-- Text input-->
                           <div class="col-md-6 form-group">
                              <label class="control-label">Customer Name:</label>
                              <input type="text" placeholder="Customer Name" class="form-control">
                           </div>
                           <div class="col-md-6 form-group">
                              <label class="control-label">CID</label>
                              <input type="number" placeholder="CID" class="form-control">
                           </div>
                           <div class="col-md-6 form-group">
                              <label class="control-label">Price</label>
                              <input type="text" placeholder="priece" class="form-control">
                           </div>
                           <!-- Text input-->
                           <div class="col-md-6 form-group">
                              <label class="control-label">description:</label>
                              <input type="text" placeholder="details" class="form-control">
                           </div>
                           <div class="col-md-12 form-group user-form-group">
                              <div class="pull-right">
                                 <button type="button" class="btn btn-danger btn-sm">Cancel</button>
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
   <!-- Modal -->    
   <!-- Customer Modal2 -->
   <div class="modal fade" id="customer2" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header modal-header-primary">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               <h3><i class="fa fa-user m-r-5"></i> Delete Customer</h3>
            </div>
            <div class="modal-body">
               <div class="row">
                  <div class="col-md-12">
                     <form class="form-horizontal">
                        <fieldset>
                           <div class="col-md-12 form-group user-form-group">
                              <label class="control-label">Delete Customer</label>
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
@endsection