@extends('user.layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
   <div class="header-icon">
      <i class="fa fa-shopping-basket"></i>
   </div>
   <div class="header-title">
      <h1>Withdrawal</h1>
      <small>Withdrawal list & new Withdrawal</small>
   </div>
</section>

 <!-- Main content -->
<section class="content">
   <div class="row">
      <div class="col-sm-10">
         <div class="panel lobidisable panel-bd">
            <div class="panel-heading">
               <div class="panel-title">
                  <h4>Add Withdrawal</h4>
               </div>
            </div>
            <div class="panel-body">
               <div class="col-md-6">
                  @include('user.inc.message')
               </div>
               <form method="post" action="{{ route('add.withdrawal') }}">
                  @csrf
                  <div class="form-group">
                     <label style="width:100%;float:left;">Select Bank / Account</label>
                     <select class="form-control" name="bank" required>
                        <option value="">Choose...</option>
                        @foreach($bankAc as $account)
                        <option value="{{ $account->id }}">{{ $account->bank_name }} - {{ $account->account_number }}</option>
                        @endforeach
                     </select>
                  </div>
                  <div class="form-group col-sm-6">
                     <label>Reference</label>
                     <input type="text" name="reference" value="{{ old('reference') }}" class="form-control" placeholder="Enter Amount" required>
                  </div>
                  <div class="col-sm-12">
                     <div class="form-group col-sm-6">
                        <label>Date</label>
                        <div class=" input-group date">
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
                     <button type="submit" class="btn btn-add w-md m-b-5">Submit</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
      <div class="col-sm-12">
         <div class="panel lobidisable panel-bd">
            @php
               use App\Model\User\Bank\Withdrawal;
               $allWithdrawal = Withdrawal::orderBy('id', 'DESC')
                     ->where('token', Session('_token'))->get();
            @endphp
            @if(Session::has('session_id'))
            <div class="panel-heading">
               <div class="btn-group">
                  <a href="{{ route('save.withdrawal') }}" class="btn btn-exp btn-sm"> Click to save transaction</a>
               </div>
            </div>
            <div class="panel-body">
               <div class="table-responsive">
                  <table class="table table-bordered table-hover">
                     <thead>
                        <tr class="info">
                           <th>Recent Deposit</th>
                           <th>Date</th>
                           <th>Amount</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($allWithdrawal as $withdrawal)
                        <tr>
                           <td>{{ $withdrawal->bank}}</td>
                           <td>{{ $withdrawal->date}}</td>
                           <td>{{ $withdrawal->amount}}</td>
                           <td>
                              <a href="{{ route('delete.withdrawal', $withdrawal->id) }}" type="button" class="btn btn-danger btn-sm" id="delete"><i class="fa fa-trash-o"></i> </a>
                           </td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
            </div>
            @else
            <h2>No withdrawal is added</h2>
            @endif
         </div>
      </div>
   </div>
</section>
<!-- /.content -->
@endsection