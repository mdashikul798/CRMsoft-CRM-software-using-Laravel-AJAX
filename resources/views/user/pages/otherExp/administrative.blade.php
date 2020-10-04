@extends('user.layouts.app')
@section('content')
<section class="content-header">
   <div class="header-icon">
      <i class="fa fa-sticky-note-o"></i>
   </div>
   <div class="header-title">
      <h1>Administrative Expenses</h1>
      <small>All administrative expense</small>
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
                  <a class="btn btn-add " href="{{ route('view.admin') }}"> 
                  <i class="fa fa-list"></i> View Expenses</a>  
               </div>
            </div>
            <div class="panel-body">
              <div class="col-md-12 col-xl-6 col-sm-12">
               <form action="{{ route('add.admin.exp') }}" method="post">
                @csrf
                  <div class="col-md-6 col-xl-6 col-sm-12">
                    <div class="form-group">
  				            <label for="category">Select Expense</label>
  				            <select class="form-control chosen" name="expense_name" required>
                      <option value="">Choose...</option>
  	                  <option value="Advertise">Advertise</option>
  	                  <option value="Canteen Subsidy">Canteen Subsidy</option>
  	                  <option value="Deprecation">Deprecation</option>
  	                  <option value="Entertainment">Entertainment</option>
  	                  <option value="Honourarium Expense">Honourarium Expense</option>
  	                  <option value="Legal & Processing Fee">Legal & Processing Fee</option>
  	                  <option value="Liveries & Uniform">Liveries & Uniform</option>
  	                  <option value="Medical Expences">Medical Expences</option>
  	                  <option value="Meeting Expense">Meeting Expense</option>
  	                  <option value="News Paper & Magazine">News Paper & Magazine</option>
  	                  
  	                  <option value="Printing & Stationery">Printing & Stationery</option>
  	                  <option value="Repair & Maintanence Expenses">Repair & Maintanence Expenses</option>
  	                  <option value="Rent, Rates & Taxes">Rent, Rates & Taxes</option>
  	                  <option value="Telephone Bill">Telephone Bill</option>
  	                  <option value="Traning Expenses">Traning Expenses</option>
  	                  <option value="Travelling Expenses">Travelling Expenses</option>
  	                  <option value="Vehicle Repairing & Maintenance">Vehicle Repairing & Maintenance</option>
  	                </select>
  				        </div>

        				  <div class="form-group">
        				    <label for="category">Amount</label>
        				    <input type="number" name="amount" class="form-control" id="category" aria-describedby="category" placeholder="Enter Amount">
        				  </div>
        				  <div class="form-group">
        				    <label for="category">Reference Number</label>
        				    <input type="text" name="reference" class="form-control" id="category" aria-describedby="category" placeholder="Enter Reference">
        				  </div>
                </div>
                <div class="col-md-6 col-xl-6 col-sm-12">
                	<div class="form-group">
                        <div class="col-md-3 col-xl-3 col-sm-3 col-xs-6 form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" checked>
                          <label class="form-check-label" for="inlineRadio1"> Cash</label>
                        </div>
                        <div class="col-md-3 col-xl-3 col-sm-3 col-xs-6 form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2" data-toggle="collapse" data-target="#bank">
                          <label class="form-check-label" for="inlineRadio2">Bank</label>
                        </div>
                     </div>
                      <div id="bank" class="panel-collapse collapse" style="clear:both;">
                        <div class="form-group">
                          <label>Select Bank</label>
                          <select class="form-control" name="bank">
                               <option value="">Choose...</option>
                               @php
                                  use App\Model\User\Bank\AddBank;
                                  $allBank = AddBank::orderBy('bank_name', 'ASC')->where('status', '1')->get();
                                @endphp
                                @foreach($allBank as $bank)
                               <option value="{{ $bank->id}}">{{ $bank->bank_name}}</option>
                               @endforeach
                            </select>
                       </div>
                      </div>

                      <div class="form-group" style="clear:both;">
          				    	<label for="textarea">Description</label>
          				    	<textarea name="description" class="form-control" cols="6" rows="7"></textarea>
          				  	</div>
                      <div class="reset-button">
                          <button type="submit" class="btn btn-add pull-right w-md m-b-5">Add</button>
                      </div>
                  </div>
                </form>
               </div>
            </div>

            <div class="panel-body">
              <div class="panel-body col-md-12 col-xl-6 col-sm-12">
                <form>
                <h4>Expense Details</h4>
                  @php
                    use App\Model\User\OtherExp\AdminExpense;
                    $allexp = AdminExpense::orderBy('id', 'DESC')
                        ->where('token', Session('_token'))
                        ->get();
                  @endphp
                  @if(Session::has('session_id'))
                  <a href="{{ route('save.admin.exp') }}" class="btn btn-add w-md m-b-5">Save Expenses</a>
                   <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                      <thead>
                         <tr>
                            <th>SL No.</th>
                            <th>Expanse Name</th>
                            <th>Description</th>
                            <th>Amount</th>
                            <th>Action</th>
                         </tr>
                      </thead>
                      <tbody>
                        @foreach($allexp as $exp)
                         <tr>
                            <td>{{ $loop->index +1 }}</td>
                            <td>{{ $exp->expense_name }}</td>
                            <td>{{ $exp->description }}</td>
                            <td>{{ $exp->amount }}</td>
                            <td>
                               <a href="{{ route('delete.admin.exp', $exp->id) }}" class="btn btn-danger btn-sm" id="delete"><i class="fa fa-trash-o"></i> </a>
                            </td>
                         </tr>
                         @endforeach
                      </tbody>
                   </table>
                   @else
                   <h2 style="text-align:center;">No expense is added</h2>
                   @endif
                </form>
              </div>
               </div>

         </div>
      </div>
   </div>
</section>
@endsection
