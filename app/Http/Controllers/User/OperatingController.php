<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\User\OtherExp\Operating;
use Session;
use DB;


class OperatingController extends Controller
{

/***
    *
    * operatingExp route
    *
    * There is some route under the 'operating expenses', that are
    * 'addSalary', 'addOfficeRent', 'addElectricityBill'
    * 'addNightGuardBill', 'addInternetBill', 'addOtherExpense'
    *
    * This routes is first adding data to the 'operatings' table
    * with 'token' & 'status=0', after adding the data
    * when press 'save' button it will change the 'status=1'
    * and the 'token' will be 'null' through the
    *
    * saveOperatingExp route
    *
    * @importent
    * value of 'expense_category', is defined in a 'hidden input field'
    * and all the 'Operating expenses name' is defined as 'expense_name'
    *
**/

    public function operatingExp(){
    	return view('user.pages.otherExp.operating');
    }

    public function addSalary(Request $request){
    	$operating = new Operating();
    	$request->validate([
    		'staff' => 'required',
    		'date' => 'required',
    		'salary' => 'required'
    	]);

    	// Token generating
    	$session_id = rand(40, 100);
    	$data = $request->input();
    	$request->session()->put('session_id', $data);
    	$token = $request->input('_token');

    	$date = date_create($request->date);

    	$operating->expense_category = $request->expense_category;
    	$operating->expense_name = $request->staff;
    	$operating->date = date_format($date, 'y-m-d');
    	$operating->amount = $request->salary;
    	$operating->bank = $request->bank;
    	$operating->description = $request->description;
    	$operating->token = $token;
    	$operating->save();

    	return redirect('expense/operating-exp');
    }

    public function addOfficeRent(Request $request){
    	$operating = new Operating();
    	$request->validate([
    		'office_name' => 'required',
    		'date' => 'required',
    		'amount' => 'required'
    	]);

    	// Token generating
    	$session_id = rand(40, 100);
    	$data = $request->input();
    	$request->session()->put('session_id', $data);
    	$token = $request->input('_token');

    	$date = date_create($request->date);

    	$operating->expense_category = $request->expense_category;
    	$operating->expense_name = $request->office_name;
    	$operating->date = date_format($date, 'y-m-d');
    	$operating->amount = $request->amount;
    	$operating->bank = $request->bank;
    	$operating->description = $request->description;
    	$operating->token = $token;
    	$operating->save();

    	return redirect('expense/operating-exp');
    }

    public function addElectricityBill(Request $request){
    	$operating = new Operating();
    	$request->validate([
    		'meter_name' => 'required',
    		'date' => 'required',
    		'amount' => 'required'
    	]);

    	// Token generating
    	$session_id = rand(40, 100);
    	$data = $request->input();
    	$request->session()->put('session_id', $data);
    	$token = $request->input('_token');

    	$date = date_create($request->date);

    	$operating->expense_category = $request->expense_category;
    	$operating->expense_name = $request->meter_name;
    	$operating->date = date_format($date, 'y-m-d');
    	$operating->amount = $request->amount;
    	$operating->bank = $request->bank;
    	$operating->description = $request->description;
    	$operating->token = $token;
    	$operating->save();

    	return redirect('expense/operating-exp');
    }

    public function addNightGuardBill(Request $request){
    	$operating = new Operating();
    	$request->validate([
    		'area_name' => 'required',
    		'date' => 'required',
    		'amount' => 'required'
    	]);

    	// Token generating
    	$session_id = rand(40, 100);
    	$data = $request->input();
    	$request->session()->put('session_id', $data);
    	$token = $request->input('_token');

    	$date = date_create($request->date);

    	$operating->expense_category = $request->expense_category;
    	$operating->expense_name = $request->area_name;
    	$operating->date = date_format($date, 'y-m-d');
    	$operating->amount = $request->amount;
    	$operating->bank = $request->bank;
    	$operating->description = $request->description;
    	$operating->token = $token;
    	$operating->save();

    	return redirect('expense/operating-exp');
    }

    public function addInternetBill(Request $request){
    	$operating = new Operating();
    	$request->validate([
    		'receipt_number' => 'required',
    		'date' => 'required',
    		'amount' => 'required'
    	]);

    	// Token generating
    	$session_id = rand(40, 100);
    	$data = $request->input();
    	$request->session()->put('session_id', $data);
    	$token = $request->input('_token');

    	$date = date_create($request->date);

    	$operating->expense_category = $request->expense_category;
    	$operating->expense_name = $request->receipt_number;
    	$operating->date = date_format($date, 'y-m-d');
    	$operating->amount = $request->amount;
    	$operating->bank = $request->bank;
    	$operating->description = $request->description;
    	$operating->token = $token;
    	$operating->save();

    	return redirect('expense/operating-exp')->with('success', 'Internet bill added successfully');
    }

    public function addOtherExpense(Request $request){
    	$operating = new Operating();
    	$request->validate([
    		'other_expense' => 'required',
    		'date' => 'required',
    		'amount' => 'required'
    	]);

    	// Token generating
    	$session_id = rand(40, 100);
    	$data = $request->input();
    	$request->session()->put('session_id', $data);
    	$token = $request->input('_token');

    	$date = date_create($request->date);

    	$operating->expense_category = $request->expense_category;
    	$operating->expense_name = $request->other_expense;
    	$operating->date = date_format($date, 'y-m-d');
    	$operating->amount = $request->amount;
    	$operating->bank = $request->bank;
    	$operating->bank = $request->reference;
    	$operating->description = $request->description;
    	$operating->token = $token;
    	$operating->save();

    	return redirect('expense/operating-exp');
    }

    public function deleteOperatingExp($id){
    	$allExp = Operating::where('token', Session('_token'))->get();
        $expense = Operating::find($id);
        if(count($allExp) <= 1){
            $expense->delete();
            Session::forget('session_id');
            return back();
        }
        $expense->delete();
        return back();
    }

    public function saveOperatingExp(){
    	$allExpense = Operating::orderBy('id', 'DESC')
                ->where('token', Session('_token'))->get();
        
        try{
            foreach($allExpense as $expense){
                $expense->token = null;
                $expense->status = '1';
                $expense->update();
            }
            
        }catch(\Exception $e){
            return redirect('/expense/operating-exp')->with('error', $e->getMessage());
        }
        Session::forget('session_id');
        return redirect('/expense/operating-exp');
    }

    public function viewOperating(){
    	$allExp = Operating::orderBy('date', 'DESC')
    			->where('status', 1)
    			->get();

    	return view('user.pages.otherExp.viewOperating', compact('allExp'));
    }

    
}
