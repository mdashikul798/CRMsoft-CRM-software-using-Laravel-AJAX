<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\User\Bank\Deposit;
use App\Model\User\Bank\Withdrawal;
use App\Model\User\Bank\BankAct;
use App\Model\User\Bank\AddBank;
use Session;
use DB;

class BankController extends Controller
{
    /***
    *
    * addDeposit route
    *
    * This route is first adding data to the 'admin_expenses' table
    * with 'token' & 'status=0', after adding the data
    * when press 'save' button it will change the 'status=1'
    * and the 'token' will be 'null' through the
    *
    * saveDeposit route
    *
    * after saving the 'deposit' it will also add the data to the 
    *
    * bank_acts table
    *
    **/

    public function bankDeposit(){
        $bankAc = AddBank::where('status', 1)->get();
    	return view('user.pages.bank.deposit', compact('bankAc'));
    }

    public function addDeposit(Request $request){
    	$request->validate([
    		'bank' => 'required',
    		'date' => 'required',
    		'amount' => 'required'
    	]);

    	$session_id = rand(40, 100);
        $data = $request->input();
        $request->session()->put('session_id', $data);
        $token = $request->input('_token');

        //random invoice number
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $invoiceNum = substr(str_shuffle($permitted_chars), 0, 8);

    	$date = $request->date;
    	$createDate=date_create($date);
    	$formatDate = date_format($createDate,"Y/m/d");

    	$bankAct = new Deposit();
    	$bankAct->bank = $request->bank;
    	$bankAct->reference = $request->reference;
    	$bankAct->date = $formatDate;
    	$bankAct->amount = $request->amount;
    	$bankAct->description = $request->description;
    	$bankAct->token = $token;
    	$bankAct->invoiceNum = $invoiceNum;
    	$bankAct->save();

    	return redirect('/bank/bank-deposit');
    }

    
    public function saveDeposit(Request $request){
   	$allDeposit = Deposit::orderBy('id', 'DESC')
                ->where('token', Session('_token'))->get();
    $bankAct = new BankAct();
        try{
            $createdInv = $allDeposit['0']['invoiceNum'];

            foreach($allDeposit as $deposit){
                $deposit->invoiceNum = $createdInv;
                $deposit->token = null;
                $deposit->status = '1';
                $deposit->update();

                /*After updating data to the 'deposits' table it will also save the data to the 'bank_acts' table*/
                $bankAct->deposit_id = $deposit->id;
                $bankAct->bank = $deposit->bank;
                $bankAct->reference = $deposit->reference;
                $bankAct->date = $deposit->date;
                $bankAct->amount = $deposit->amount;
                $bankAct->invoiceNum = $createdInv;
                $bankAct->status = '1';
                $bankAct->save();
            }
            Session::forget('session_id');
            return redirect('/bank/bank-deposit')->with('success', 'Deposit saved successfully');
            
        }catch(\Exception $e){
            return redirect('/bank/add-withdrawal')->with('error', $e->getMessage());
        }
        return redirect('/bank/add-withdrawal');
   }

   public function deleteDeposit($id){
        $allDeposit = Deposit::where('token', Session('_token'))->get();
        $deposit = Deposit::find($id);

        if(count($allDeposit) <= 1){
            $deposit->delete();
            Session::forget('session_id');
            return back();
        }
        $deposit->delete();
        return back();
    }

    public function Withdrawal(){
        $bankAc = AddBank::where('status', 1)->get();
    	return view('user.pages.bank.withdrawal', compact('bankAc'));
    }

    public function addWithdrawal(Request $request){
    	$request->validate([
    		'bank' => 'required',
    		'date' => 'required|date',
    		'amount' => 'required'
    	]);

    	$session_id = rand(40, 100);
        $data = $request->input();
        $request->session()->put('session_id', $data);
        $token = $request->input('_token');

        //random invoice number
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $invoiceNum = substr(str_shuffle($permitted_chars), 0, 8);
        //date formating
    	$date = $request->date;
    	$createDate=date_create($date);
    	$formatDate = date_format($createDate,"Y/m/d");

    	$bankAct = new Withdrawal();
    	$bankAct->bank = $request->bank;
    	$bankAct->reference = $request->reference;
    	$bankAct->date = $formatDate;
    	$bankAct->amount = $request->amount;
    	$bankAct->description = $request->description;
    	$bankAct->token = $token;
    	$bankAct->invoiceNum = $invoiceNum;
    	$bankAct->save();

    	return redirect('bank/bank-withdrawal');
    }

    public function deleteWithdrawal($id){
    	$allWithdrawal = Withdrawal::where('token', Session('_token'))->get();
    	$withdrawal = Withdrawal::find($id);

    	if(count($allWithdrawal) <= 1){
            $withdrawal->delete();
            Session::forget('session_id');
            return back();
        }
        $withdrawal->delete();
        return back();
    }

   public function saveWithdrawal(Request $request){
   	$allWithdrawal = Withdrawal::orderBy('id', 'DESC')
                ->where('token', Session('_token'))->get();
    $bankAct = new BankAct();
        
        try{
            $createdInv = $allWithdrawal['0']['invoiceNum'];

            foreach($allWithdrawal as $withdrawal){
                $withdrawal->invoiceNum = $createdInv;
                $withdrawal->token = null;
                $withdrawal->status = '1';
                $withdrawal->update();

                /*After updating data to the 'withdrawals' table it will also save the data to the 'bank_acts' table*/
                $bankAct->withdrawal_id = $withdrawal->id;
                $bankAct->bank = $withdrawal->bank;
                $bankAct->reference = $withdrawal->reference;
                $bankAct->date = $withdrawal->date;
                $bankAct->amount = $withdrawal->amount;
                $bankAct->invoiceNum = $createdInv;
                $bankAct->status = '1';
                $bankAct->save();
            }
            Session::forget('session_id');
            return redirect('/bank/bank-withdrawal')->with('success', 'Withdrawal saved successfully');
            
        }catch(\Exception $e){
            return redirect('/bank/add-withdrawal')->with('error', $e->getMessage());
        }
        return redirect('/bank/add-withdrawal');
   }

   /***
   *
   * Bank statement
   * bank statement is geting data from three(3) tables,
   * the tables are 'deposits', 'withdrawals', 'add_banks'
   *
   * Statement is showing all the accounts closing balance
   * first of all it's showing all the accounts statement.
   *
   **/
    public function statement(){
        $alltrans = DB::table('bank_acts')->orderBy('date', 'ASC')
                ->leftjoin('deposits', 'bank_acts.deposit_id', '=', 'deposits.id')
                ->leftjoin('withdrawals', 'bank_acts.withdrawal_id', '=', 'withdrawals.id')
                ->leftjoin('add_banks', 'bank_acts.bank', '=', 'add_banks.id')
                ->select('bank_acts.*', 'deposits.amount as deposit', 'withdrawals.amount as withdrawal', 'add_banks.bank_name')
                ->where('bank_acts.status', 1)
                ->get();
    	return view('user.pages.bank.statement', compact('alltrans'));
    }

    
}
