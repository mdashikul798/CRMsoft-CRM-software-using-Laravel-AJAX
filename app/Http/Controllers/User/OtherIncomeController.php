<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\User\Sale\ViewSale;
use App\Model\User\OtherIncome\OtherIncome;
use Session;
use PDF;

class OtherIncomeController extends Controller
{
    public function addOtherIncome(){
    	return view('user.pages.otherIncome.addIncome');
    }

    public function saveOtherIncome(Request $request){
        $request->validate([
            'income_name' => 'required',
            'customer_name' => 'required',
            'price' => 'required',
            'total' => 'required'
        ]);
        try{
            $session_id = rand(40, 100);
            $data = $request->input();
            $request->session()->put('session_id', $data);
            $token = $request->input('_token');

            //random invoice number
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $invoiceNum = substr(str_shuffle($permitted_chars), 0, 8);

            $income = new OtherIncome();
            $income->income_name = $request->income_name;
            $income->invoiceNum = $invoiceNum;
            $income->customer_name = $request->customer_name;
            $income->phone = $request->phone;
            $income->bank_name = $request->bank_name;
            $income->price = $request->price;
            $income->due = $request->due;
            $income->description = $request->description;
            $income->total = $request->total;
            $income->token = $token;
            $income->save();

        }catch(\Exception $e){
            return redirect('/income/add-other-income')->with('error', $e->getMessage());
        }
        return redirect('/income/add-other-income')->with('success', 'Other-Income added successfully');
    }


    /*checking the product quentity more than 1 or not if 1, then when delet it, it will also delet/forget the session*/

    public function deleteOtherIncome($id){
        $allIncome = OtherIncome::where('token', Session('_token'))->get();
        $income = OtherIncome::find($id);
        if(count($allIncome) <= 1){
            $income->delete();
            Session::forget('session_id');
            return back();
        }
        $income->delete();
        return back();
    }

    public function otherIncomePrintView(){
        $allIncome = OtherIncome::orderBy('id', 'DESC')
                ->where('token', Session('_token'))->get();
        return view('user.pages.otherIncome.incomeview', compact('allIncome'));
    }

    /*After pressing the print button it will update the 'other_incomes' table & also parse/save data to the 'view_sales' table*/
    
    public function otherIncomePrint(Request $request){
        $allIncome = OtherIncome::orderBy('id', 'DESC')
                ->where('token', Session('_token'))->get();
        $viewSale = new ViewSale();
        try{
            $pdf = PDF::loadView('user.pages.otherIncome.invoice', compact('allIncome'));
            $createdInv = $allIncome['0']['invoiceNum'];

            foreach($allIncome as $income){
                $income->invoiceNum = $createdInv;
                $income->token = null;
                $income->status = '1';
                $income->update();

    /*After updating data to the 'sale' table it will also save the data to the 'view_sales' table*/
                $viewSale->sales_id = $income->id;
                $viewSale->item_name = $income->income_name;
                $viewSale->status = '1';
                $viewSale->save();
            }
            $pdf->stream('invoice.pdf');
            Session::forget('session_id');
            return $pdf->stream('invoice.pdf');
        }catch(\Exception $e){
            return redirect('/income/add-other-income')->with('error', $e->getMessage());
        }
        return redirect('/income/add-other-income');
    }
    //End of product sell route



    public function viewOtherIncome(){
    	$allIncome = OtherIncome::orderBy('id', 'DESC')->get();
    	return view('user.pages.otherIncome.view', compact('allIncome'));
    }
}
