@extends('user.layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
   <div class="header-icon">
      <i class="fa fa-bank"></i>
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
               <form action="{{ route('add.deposit') }}" method="post">
                  @csrf
                  <div class="form-group">
                     <label style="width:100%;float:left;">Select Bank / Account</label>
                     <select name="bank" class="form-control" required>
                        <option value="">Choose...</option>
                        @foreach($bankAc as $account)
                        <option value="{{ $account->id }}">{{ $account->bank_name }} - {{ $account->account_number }}</option>
                        @endforeach
                     </select>
                  </div>
                  <div class="form-group col-sm-6">
                     <label>Reference Number</label>
                     <input type="text" name="reference" value="{{ old('reference') }}" class="form-control" placeholder="Enter Reference Number">
                  </div>
                  <div class="col-sm-12">
                     <div class="form-group col-sm-6">
                        <label>Date</label>
                        <div class=" input-group date form_date">
                           <input type="date" name="date">
                        </div>
                     </div>
                     <div class="form-group col-sm-6">
                        <label>Amount</label>
                        <input type="number" name="amount" value="{{ old('amount') }}" class="form-control" placeholder="Enter Amount" required>
                     </div>
                  </div>
                  <div class="form-group" style="clear:both;">
                     <label>Description</label>
                     <textarea name="description" class="form-control" cols="55" rows="6"></textarea>
                  </div>
                  <div class="form-group">
                     <button type="submit" class="btn btn-add w-md m-b-5">Add</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
      <div class="col-sm-12">
         <div class="panel lobidisable panel-bd">
            @php
               use App\Model\User\Bank\Deposit;
               $allDeposit = DB::table('deposits')->orderBy('id', 'DESC')
                  ->leftjoin('add_banks', 'deposits.bank', 'add_banks.id')
                  ->select('deposits.*', 'add_banks.bank_name', 'add_banks.account_number')
                  ->where('token', Session('_token'))->get();
            @endphp
            @if(Session::has('session_id'))
            <div class="panel-heading">
               <div class="btn-group">
                  <a href="{{ route('save.deposit') }}" class="btn btn-exp m-b-5">Save transaction</a>
               </div>
            </div>
            <div class="panel-body">
               <div class="table-responsive">
                  <table class="table table-bordered table-hover">
                     <thead>
                        <tr class="info">
                           <th>Bank Details</th>
                           <th>Date</th>
                           <th>Amount</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($allDeposit as $deposit)
                        <tr>
                           <td>{{ $deposit->bank_name }} - {{ $deposit->account_number }}</td>
                           <td>{{ $deposit->date }}</td>
                           <td>{{ $deposit->amount }}</td>
                           <td>
                              <a href="{{ route('delete.deposit', $deposit->id) }}" type="button" class="btn btn-danger btn-sm" id="delete"><i class="fa fa-trash-o"></i> </a>
                           </td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
            </div>
            @else
            <h2>No transaction is added</h2>
            @endif
         </div>
      </div>
   </div>
</section>
<!-- /.content -->
@endsection