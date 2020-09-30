<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\User\OtherExp\AdminExpense;
use Session;

class AdminController extends Controller
{ 

    /***
    *
    * AdminController (administrative exp.)
    *
    * This route is first adding data to the 'admin_expenses' table
    * with 'token' & 'status=0', after adding the data
    * when press 'save' button it will change the 'status=1'
    * and the 'token' will be 'null' throuth the
    *
    * saveAdminExpHome route
    *
    *
    **/

    //Redirecting the administrative expense home page
    public function adminExpHome(){
    	return view('user.pages.otherExp.administrative');
    }

    

    public function addAdminExpHome(Request $request){
    	$request->validate([
    		'expense_name' => 'required',
    		'amount' => 'required',
    	]);
    	$session_id = rand(40, 100);
        $data = $request->input();
        $request->session()->put('session_id', $data);
        $token = $request->input('_token');

        //random invoice number
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $invoiceNum = substr(str_shuffle($permitted_chars), 0, 8);

    	$adminExp = new AdminExpense();
    	$adminExp->voucherNum = $invoiceNum ;
    	$adminExp->expense_name = $request->expense_name;
    	$adminExp->amount = $request->amount;
    	$adminExp->bank = $request->bank;
    	$adminExp->reference = $request->reference;
    	$adminExp->description = $request->description;
    	$adminExp->token = $token;
    	$adminExp->save();

    	return redirect('expense/admin-exp')->with('success', 'Administrative expense added successfully');

    }

    public function saveAdminExpHome(Request $request){
    	$allAdminExp = AdminExpense::orderBy('id', 'DESC')
    				->where('token', Session('_token'))
    				->get();
    	foreach($allAdminExp as $exp){
    		$exp->token = null;
    		$exp->status = '1';
    		$exp->update();
    	}
    	Session::forget('session_id');
    	return redirect('expense/admin-exp')->with('success', 'Administrative expense added successfully');
    }

    public function deleteAdminExpHome($id){
    	$allExp = AdminExpense::where('token', Session('_token'))->get();
        $expense = AdminExpense::find($id);
        if(count($allExp) <= 1){
            $expense->delete();
            Session::forget('session_id');
            return back();
        }
        $expense->delete();
        return back();
    }

    public function viewAdmin(){
    	$allExp = AdminExpense::orderBy('created_at', 'DESC')
    			->where('status', 1)
    			->get();
    	return view('user.pages.otherExp.viewAdmin', compact('allExp'));
    }
}
