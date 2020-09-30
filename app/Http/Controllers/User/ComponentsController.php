<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\User\Bank\AddBank;
use App\Model\User\Components\Staff;
use App\Model\User\Components\Meter;
use App\Model\User\Components\Branch;
use App\Model\User\Components\Depreciation;

class ComponentsController extends Controller
{
    public function addBankAccount(){
        return view('user.pages.components.bank.addBank');
    }

    public function saveBankAccount(Request $request){
        $request->validate([
            'bank_name' => 'required',
            'account_name' => 'required',
            'account_number' => 'required'
        ]);

        $addBank = new AddBank();
        $addBank->bank_name = $request->bank_name;
        $addBank->account_name = $request->account_name;
        $addBank->account_number = $request->account_number;
        $addBank->description = $request->description;
        $addBank->save();
        return redirect('/component/add-bank-account')->with('success', 'Bank added successfully');
    }

    public function allBankAccount(){
        return view('user.pages.components.bank.allBank');
    }

    public function bankStatus($id, $status){
        $bank = AddBank::find($id);
        $bank->status = $status;
        $bank->save();

        return back();
    }

    public function deleteBankAccount($id){
        $bank = AddBank::find($id);
        $bank->delete();

        return redirect('/component/add-bank-account')->with('success', 'Bank account deleteed successfully');
    }

    // Staff function
    public function addOfficeStaff(){
    	return view('user.pages.components.staff.addStaff');
    }

    public function saveOfficeStaff(Request $request){
    	$request->validate([
    		'name' => 'required',
    		'designation' => 'required',
    		'phone' => 'required',
    		'nid_number' => 'required',
    		'address' => 'required',
    	]);

    	$staff = new Staff();
    	$staff->name = $request->name;
    	$staff->designation = $request->designation;
    	$staff->phone = $request->phone;
    	$staff->nid_number = $request->nid_number;
    	$staff->address = $request->address;
    	$staff->address_2 = $request->address_2;
    	$staff->save();
    	return redirect('component/add-office-staff')->with('success', 'Staff added successfully');
    }

    public function officeStaffStatus($id, $status){
        $bank = Staff::find($id);
        $bank->status = $status;
        $bank->save();

        return back();
    }

    public function deleteOfficeStaff($id){
        $bank = Staff::find($id);
        $bank->delete();

        return back();
    }

    // Branch function
    public function addBranch(){
    	return view('user.pages.components.branch.addBranch');
    }

    public function saveBranch(Request $request){
    	$request->validate([
    		'branch_name' => 'required',
    		'branch_address' => 'required'
    	]);

    	$staff = new Branch();
    	$staff->branch_name = $request->branch_name;
    	$staff->branch_address = $request->branch_address;
    	$staff->description = $request->description;
    	$staff->save();
    	return redirect('component/add-office-branch')->with('success', 'Branch added successfully');
    }

    public function changeBranchStatus($id, $status){
        $bank = Branch::find($id);
        $bank->status = $status;
        $bank->save();

        return back();
    }

    public function deleteBranch($id){
        $bank = Branch::find($id);
        $bank->delete();

        return back();
    }

    // Meter function
    public function addMeter(){
    	return view('user.pages.components.meter.addMeter');
    }

    public function saveMeter(Request $request){
    	$request->validate([
    		'meter_name' => 'required',
    		'meter_number' => 'required'
    	]);

    	$staff = new Meter();
    	$staff->meter_name = $request->meter_name;
    	$staff->meter_number = $request->meter_number;
    	$staff->description = $request->description;
    	$staff->save();
    	return redirect('component/add-meter')->with('success', 'Meter added successfully');
    }

    public function changeMeterStatus($id, $status){
        $bank = Meter::find($id);
        $bank->status = $status;
        $bank->save();

        return back();
    }

    public function deleteMeter($id){
        $bank = Meter::find($id);
        $bank->delete();

        return back();
    }

    public function addDepreciation(){
        $allAsset = Depreciation::orderBy('asset_name', 'ASC')
                    ->where('status', 1)->get();
        return view('user.pages.components.depreciation.depreciation', compact('allAsset'));
    }

    public function searchDepreciationByItem($assetName){
        if (empty($assetName)) {
            return [];
        }
        /*$itemName = DB::table('depreciations')
            ->select('depreciations.*', 'depreciations.purchase_price', 'depreciations.accumulated', 'depreciations.present_value')
            ->where('depreciations.asset_name', 'LIKE', "$itemName%")
            ->limit(25)
            ->get();

        return $itemName;*/
        $itemName = Depreciation::where('depreciations.asset_name', 'LIKE', "$assetName%")
            ->limit(25)
            ->get();

        return $itemName;
            
    }

    public function saveDepreciation(Request $request, $id){
        $request->validate([
            'percent' => 'required'
                ]);
    }
}
