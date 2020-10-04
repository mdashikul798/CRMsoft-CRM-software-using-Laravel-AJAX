@extends('user.layouts.app')
@section('content')
<section class="content-header">
   <div class="header-icon">
      <i class="fa fa-sticky-note-o"></i>
   </div>
   <div class="header-title">
      <h1>Operating Expences</h1>
      <small>Invoices list</small>
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
                  Add your operating expences</a>  
               </div>
            </div>
            <div class="panel-body">
            	<div class="col-xs-12 col-sm-12 col-md-12 m-b-20">
            		<div class="content-fluid col-xs-12 col-sm-12 col-md-12">
	                 <!-- Nav tabs -->
	                 <ul class="nav nav-tabs">
	                    <li class="active"><button class="btn btn-primary btn-outline w-md m-b-5" href="#salary" data-toggle="tab" aria-expanded="true">Staff Salary</button></li>
	                    <li class=""><button class="btn btn-primary btn-outline w-md m-b-5" href="#rent" data-toggle="tab" aria-expanded="false">Office Rent</button></li>
	                    <li class=""><button class="btn btn-primary btn-outline w-md m-b-5" href="#electricity" data-toggle="tab" aria-expanded="false">Electricity Bill</button></li>
	                    <li class=""><button class="btn btn-primary btn-outline w-md m-b-5" href="#night_guard" data-toggle="tab" aria-expanded="false">Night Guard Bill</button></li>
	                    <li class=""><button class="btn btn-primary btn-outline w-md m-b-5" href="#internet" data-toggle="tab" aria-expanded="false">Internet Bill</button></li>
	                    <li class=""><button class="btn btn-primary btn-outline w-md m-b-5" href="#other" data-toggle="tab" aria-expanded="false">Other Expense</button></li>
	                 </ul>
                 </div>
                 <!-- Tab panels -->
                 <div class="tab-content">
                    <div class="tab-pane fade active in" id="salary">
                      <div class="panel-body col-md-12 col-xl-6 col-sm-12">
                      	
                      <form action="{{ route('operating.add.salary') }}" method="post">
                      	@csrf
                      	  <input type="hidden" value="Staff Salary" name="expense_category">
                      	  <div class="header-title">
			                  <h2>Staff Salary</h2><hr>
			                  @include('user.inc.message')
			               </div>
		                  <div class="col-md-6 col-xl-6 col-sm-12">
		                     <div class="form-group">
		                        <label>Select Staff</label>
		                        <select name="staff" class="form-control chosen" required>
	                              <option value="">Choose staff...</option>
	                              @php
	                              	use App\Model\User\Components\Staff;
	                              	$allStaff = Staff::orderBy('name', 'ASC')->where('status', '1')->get();
	                              @endphp
	                              @foreach($allStaff as $staff)
	                                 <option value="{{ $staff->name }}">{{ $staff->name }} - {{ $staff->designation }}</option>
	                              @endforeach
	                           </select>
		                     </div>
		                     <div class="form-group">
		                        <label>Select Date</label>
		                        <input type="date" name="date" class="form-control" required>
		                     </div>
		                     <div class="form-group" style="clear:both;">
		                        <label>Salary TK.</label>
		                        <input type="number" name="salary" class="form-control" placeholder="Enter Salary" required>
		                     </div>
		                     <div class="form-group">
		                        <div class="col-md-3 col-xl-3 col-sm-3 col-xs-6 form-check form-check-inline">
		                          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" checked>
		                          <label class="form-check-label" for="inlineRadio1"> Cash</label>
		                        </div>
		                        <div class="col-md-3 col-xl-3 col-sm-3 col-xs-6 form-check form-check-inline">
		                          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2" data-toggle="collapse" data-target="#staff_salary">
		                          <label class="form-check-label" for="inlineRadio2">Bank</label>
		                        </div>
		                     </div>
		                    <div id="staff_salary" class="panel-collapse collapse" style="clear:both;">
		                      <div class="form-group">
		                        <label>Select Bank</label>
		                        <select class="form-control" name="bank">
		                           <option value="">Choose...</option>
		                           @php
	                              	use App\Model\User\Bank\AddBank;
	                              	$allBank = AddBank::orderBy('bank_name', 'ASC')->where('status', '1')->get();
	                              @endphp
	                              @foreach($allBank as $bank)
		                           <option value="{{ $bank->bank_name}}">{{ $bank->bank_name}}</option>
		                           @endforeach
		                        </select>
		                     </div>
		                    </div>
		                  </div>
		                  <div class="col-md-6 col-xl-6 col-sm-12">
		                     <div class="form-group">
		                        <label>Description (optional)</label>
		                        <textarea name="description" class="form-control" cols="6" rows="8"></textarea>
		                     </div>
		                     <div class="reset-button">
		                        <button type="submit" class="btn btn-add pull-right w-md m-b-5">Add</button>
		                     </div>
		                  </div>
		               </form>
		               </div>
                    </div>
                    <div id="rent" class="tab-pane fade" style="clear:both;">
                    	<div class="panel-body col-md-12 col-xl-6 col-sm-12">
                      <form action="{{ route('operating.add.office.rent') }}" method="post">
                      	@csrf
                      	<input type="hidden" value="Office Rent" name="expense_category">
                      	<div class="header-title">
		                  <h2>Office Rent</h2>
		                  <hr>
		                </div>
		                  <div class="col-md-6 col-xl-6 col-sm-12">
		                     <div class="form-group">
		                        <label>Name of Office</label>
		                        @php
                                  use App\Model\User\Components\Branch;
                                  $allBranch = Branch::orderBy('branch_name', 'ASC')->where('status', '1')->get();
                                @endphp
		                        <select name="office_name" class="form-control" required>
		                        	<option value="">Choose office...</option>
		                        	@foreach($allBranch as $branch)
		                        	<option value="{{ $branch->branch_name }}">{{ $branch->branch_name }}</option>
		                        	@endforeach
		                        </select>
		                     </div>
		                     <div class="form-group">
		                        <label>Select Date</label>
		                        <input type="date" name="date" class="form-control" required>
		                     </div>
		                     <div class="form-group">
		                        <label>Amount Tk.</label>
		                        <input type="number" name="amount" class="form-control" placeholder="Enter amount" required>
		                     </div>

		                     <div class="form-group">
		                        <div class="col-md-3 col-xl-3 col-sm-3 col-xs-6 form-check form-check-inline">
		                          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" checked>
		                          <label class="form-check-label" for="inlineRadio1"> Cash</label>
		                        </div>
		                        <div class="col-md-3 col-xl-3 col-sm-3 col-xs-6 form-check form-check-inline">
		                          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2" data-toggle="collapse" data-target="#office_rent">
		                          <label class="form-check-label" for="inlineRadio2">Bank</label>
		                        </div>
		                     </div>
		                    <div id="office_rent" class="panel-collapse collapse" style="clear:both;">
		                      <div class="form-group">
		                        <label>Select Bank</label>
		                        <select class="form-control" name="bank">
		                           <option value="">Choose...</option>
	                                @foreach($allBank as $bank)
	                               <option value="{{ $bank->bank_name}}">{{ $bank->bank_name}}</option>
	                               @endforeach
		                        </select>
		                     </div>
		                    </div>

		                  </div>
		                  <div class="col-md-6 col-xl-6 col-sm-12">
		                     
		                     <div class="form-group">
		                        <label>Description (optional)</label>
		                        <textarea name="description" class="form-control" cols="6" rows="8"></textarea>
		                     </div>
		                     <div class="reset-button">
		                        <button type="submit" class="btn btn-add pull-right w-md m-b-5">Add</button>
		                     </div>
		                  </div>
		               </form>
		               </div>
                    </div>
                    <div id="electricity" class="tab-pane fade" style="clear:both;">
                    	<div class="panel-body col-md-12 col-xl-6 col-sm-12">
                      <form action="{{ route('operating.add.electricity.bill') }}" method="post">
                      	@csrf
                      	<input type="hidden" value="Electricity Bill" name="expense_category">
                      	<div class="header-title">
		                  <h2>Electricity Bill</h2><hr>
		                </div>
		                  <div class="col-md-6 col-xl-6 col-sm-12">
		                     <div class="form-group">
		                        <label>Meter name / number</label>
		                        @php
                                  use App\Model\User\Components\Meter;
                                  $allMeter = Meter::orderBy('meter_name', 'ASC')->where('status', '1')->get();
                                @endphp
		                        <select class="form-control" name="meter_name" required>
		                           <option value="">Choose meter...</option>
		                           @foreach($allMeter as $meter)
		                           <option value="{{ $meter->meter_name }}">{{ $meter->meter_name }}</option>
		                           @endforeach
		                        </select>
		                     </div>
		                     <div class="form-group">
		                        <label>Select date</label>
		                        <input type="date" name="date" class="form-control" required>
		                     </div>
		                     <div class="form-group">
		                        <label>Amount Tk.</label>
		                        <input type="number" name="amount" class="form-control" placeholder="Enter Amount" required>
		                     </div>

		                     <div class="form-group">
		                        <div class="col-md-3 col-xl-3 col-sm-3 col-xs-6 form-check form-check-inline">
		                          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" checked>
		                          <label class="form-check-label" for="inlineRadio1"> Cash</label>
		                        </div>
		                        <div class="col-md-3 col-xl-3 col-sm-3 col-xs-6 form-check form-check-inline">
		                          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2" data-toggle="collapse" data-target="#electricity_bill">
		                          <label class="form-check-label" for="inlineRadio2">Bank</label>
		                        </div>
		                     </div>
		                    <div id="electricity_bill" class="panel-collapse collapse" style="clear:both;">
		                      <div class="form-group">
		                        <label>Select Bank</label>
		                        <select class="form-control" name="bank">
		                           <option value="">Choose...</option>
		                           @foreach($allBank as $bank)
	                               <option value="{{ $bank->bank_name}}">{{ $bank->bank_name}}</option>
	                               @endforeach
		                        </select>
		                     </div>
		                    </div>

		                  </div>
		                  <div class="col-md-6 col-xl-6 col-sm-12">
		                     <div class="form-group" style="clear:both;">
		                        <label>Description (optional)</label>
		                        <textarea name="description" class="form-control" cols="6" rows="8"></textarea>
		                     </div>
		                     <div class="reset-button">
		                        <button type="submit" class="btn btn-add pull-right w-md m-b-5">Add</button>
		                     </div>
		                  </div>
		               </form>
		               </div>
                    </div>
                    <div id="night_guard" class="tab-pane fade" style="clear:both;">
                    	<div class="panel-body col-md-12 col-xl-6 col-sm-12">
                      <form action="{{ route('operating.add.night.guard.bill') }}" method="post">
                      	@csrf
                      	<input type="hidden" value="Night Guard Bill" name="expense_category">
                      	<div class="header-title">
		                  <h2>Night Guard Bill</h2><hr>
		                </div>
		                  <div class="col-md-6 col-xl-6 col-sm-12">
		                     <div class="form-group">
		                        <label>Area Name</label>
		                        <input type="text" name="area_name" class="form-control" placeholder="Enter Area Name" required>
		                     </div>
		                     <div class="form-group">
		                        <label>Select Date</label>
		                        <input type="date" name="date" class="form-control" required>
		                     </div>
		                     <div class="form-group">
		                        <label>Amount Tk.</label>
		                        <input type="number" name="amount" class="form-control" placeholder="Enter Amount" required>
		                     </div>

		                     <div class="form-group">
		                        <div class="col-md-3 col-xl-3 col-sm-3 col-xs-6 form-check form-check-inline">
		                          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" checked>
		                          <label class="form-check-label" for="inlineRadio1"> Cash</label>
		                        </div>
		                        <div class="col-md-3 col-xl-3 col-sm-3 col-xs-6 form-check form-check-inline">
		                          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2" data-toggle="collapse" data-target="#guard_bill">
		                          <label class="form-check-label" for="inlineRadio2">Bank</label>
		                        </div>
		                     </div>
		                    <div id="guard_bill" class="panel-collapse collapse" style="clear:both;">
		                      <div class="form-group">
		                        <label>Select Bank</label>
		                        <select class="form-control" name="bank">
		                           <option value="">Choose...</option>
		                           @foreach($allBank as $bank)
	                               <option value="{{ $bank->bank_name}}">{{ $bank->bank_name}}</option>
	                               @endforeach
		                        </select>
		                     </div>
		                    </div>

		                  </div>
		                  <div class="col-md-6 col-xl-6 col-sm-12">
		                     <div class="form-group" style="clear:both;">
		                        <label>Description</label>
		                        <textarea name="description" class="form-control" cols="6" rows="8"></textarea>
		                     </div>
		                     <div class="reset-button">
		                        <button type="submit" class="btn btn-add pull-right w-md m-b-5">Add</button>
		                     </div>
		                  </div>
		               </form>
		               </div>
                    </div>
                    <div id="internet" class="tab-pane fade" style="clear:both;">
                    	<div class="panel-body col-md-12 col-xl-6 col-sm-12">
                      <form action="{{ route('operating.add.internet.bill') }}" method="post">
                      	@csrf
                      	<input type="hidden" value="Internet Bill" name="expense_category">
                      	<div class="header-title">
		                  <h2>Internet Bill</h2><hr>
		                </div>
		                  <div class="col-md-6 col-xl-6 col-sm-12">
		                     <div class="form-group">
		                        <label>Receipt Number</label>
		                        <input type="text" name="receipt_number" class="form-control" placeholder="Enter Receipt Number" required>
		                     </div>
		                     <div class="form-group">
		                        <label>Select Date</label>
		                        <input type="date" name="date" class="form-control" required>
		                     </div>
		                     <div class="form-group">
		                        <label>Amount Tk.</label>
		                        <input type="number" name="amount" class="form-control" placeholder="Enter Amount" required>
		                     </div>

		                     <div class="form-group">
		                        <div class="col-md-3 col-xl-3 col-sm-3 col-xs-6 form-check form-check-inline">
		                          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" checked>
		                          <label class="form-check-label" for="inlineRadio1"> Cash</label>
		                        </div>
		                        <div class="col-md-3 col-xl-3 col-sm-3 col-xs-6 form-check form-check-inline">
		                          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2" data-toggle="collapse" data-target="#int_bill">
		                          <label class="form-check-label" for="inlineRadio2">Bank</label>
		                        </div>
		                     </div>
		                    <div id="int_bill" class="panel-collapse collapse" style="clear:both;">
		                      <div class="form-group">
		                        <label>Select Bank</label>
		                        <select class="form-control" name="bank">
		                           <option value="">Choose...</option>
		                           @foreach($allBank as $bank)
	                               <option value="{{ $bank->bank_name}}">{{ $bank->bank_name}}</option>
	                               @endforeach
		                        </select>
		                     </div>
		                    </div>

		                  </div>
		                  <div class="col-md-6 col-xl-6 col-sm-12">
		                     <div class="form-group" style="clear:both;">
		                        <label>Description</label>
		                        <textarea name="description" class="form-control" cols="6" rows="8"></textarea>
		                     </div>
		                     <div class="reset-button">
		                        <button type="submit" class="btn btn-add pull-right w-md m-b-5">Add</button>
		                     </div>
		                  </div>
		               </form>
		               </div>
                    </div>
                    <div id="other" class="tab-pane fade" style="clear:both;">
                    	<div class="panel-body col-md-12 col-xl-6 col-sm-12">
                      <form action="{{ route('operating.add.other.expense') }}" method="post">
                      	@csrf
                      	<input type="hidden" name="expense_category" value="Other Expense">
                      	<div class="header-title">
		                  <h2>Other Expense</h2><hr>
		                </div>
		                  <div class="col-md-6 col-xl-6 col-sm-12">
		                     <div class="form-group">
		                        <label>Expense name</label>
		                        <input type="text" name="other_expense" class="form-control" placeholder="Enter Expense" required>
		                     </div>
		                     <div class="form-group">
		                        <label>Select Date</label>
		                        <input type="date" name="date" class="form-control" required>
		                     </div>
		                     <div class="form-group">
		                        <label>Amount Tk.</label>
		                        <input type="number" name="amount" class="form-control" placeholder="Enter Amount" required>
		                     </div>

		                     <div class="form-group">
		                        <div class="col-md-3 col-xl-3 col-sm-3 col-xs-6 form-check form-check-inline">
		                          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" checked>
		                          <label class="form-check-label" for="inlineRadio1"> Cash</label>
		                        </div>
		                        <div class="col-md-3 col-xl-3 col-sm-3 col-xs-6 form-check form-check-inline">
		                          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2" data-toggle="collapse" data-target="#other_exp">
		                          <label class="form-check-label" for="inlineRadio2">Bank</label>
		                        </div>
		                     </div>
		                    <div id="other_exp" class="panel-collapse collapse" style="clear:both;">
		                      <div class="form-group">
		                        <label>Select Bank</label>
		                        <select class="form-control" name="bank">
		                           <option value="">Choose...</option>
		                           @foreach($allBank as $bank)
	                               <option value="{{ $bank->bank_name}}">{{ $bank->bank_name}}</option>
	                               @endforeach
		                        </select>
		                     </div>
		                    </div>

		                  </div>
		                  <div class="col-md-6 col-xl-6 col-sm-12">
		                  	<div class="form-group">
		                        <label>Reference (optional)</label>
		                        <input type="text" name="reference" class="form-control" placeholder="Enter Reference">
		                     </div>
		                     <div class="form-group" style="clear:both;">
		                        <label>Description (optional)</label>
		                        <textarea name="description" class="form-control" cols="6" rows="8"></textarea>
		                     </div>
		                     <div class="reset-button">
		                        <button type="submit" class="btn btn-add pull-right w-md m-b-5">Add</button>
		                     </div>
		                  </div>
		               </form>
		               </div>
                    </div>
                  </div>
               <div class="panel-body">
               	<div class="panel-body col-md-12 col-xl-6 col-sm-12">
                  <form>
                  <h4>Expense Details</h4>
	                  @php
	                  	use App\Model\User\OtherExp\Operating;
	                  	$allexp = Operating::orderBy('id', 'DESC')
	                  			->where('token', Session('_token'))
	                  			->get();
	                  @endphp
	                  @if(Session::has('session_id'))
	                  <a href="{{ route('save.operating.exp') }}" class="btn btn-add w-md m-b-5">Save Expenses</a>
                     <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                        <thead>
                           <tr>
                              <th>SL No.</th>
                              <th>Expanse Name</th>
                              <th>Expanse Description</th>
                              <th>Date</th>
                              <th>Amount</th>
                              <th>Description</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                        	@foreach($allexp as $exp)
                           <tr>
                              <td>{{ $loop->index +1 }}</td>
                              <td>{{ $exp->expense_category }}</td>
                              <td>{{ $exp->expense_name }}</td>
                              <td>{{ date_format(new DateTime($exp->date), 'd-m-Y') }}</td>
                              <td>{{ number_format($exp->amount) }}</td>
                              <td>{{ $exp->description }}</td>
                              <td>
                                 <a href="{{ route('delete.operating.exp', $exp->id) }}" class="btn btn-danger btn-sm" id="delete"><i class="fa fa-trash-o"></i> </a>
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
   </div>
</div>
   <!-- /.modal -->
</section>
<!-- /.content -->
@endsection

	
