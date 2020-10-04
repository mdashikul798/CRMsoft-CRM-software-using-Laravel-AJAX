<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\User\Bank\AddBank;
use App\Model\User\Components\Staff;
use App\Model\User\Components\Meter;
use App\Model\User\Components\Branch;
use App\Model\User\Components\Depreciation;
use DB;

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
        $itemName = Depreciation::where('depreciations.asset_name', 'LIKE', "$assetName%")
            ->limit(25)
            ->get();

        return $itemName;
            
    }

    public function saveDepreciation(Request $request){
        $request->validate([
            'asset_name' => 'required',
            'percent' => 'required'
                ]);
        $id = $request->input('id');
        $depreciation = Depreciation::where('id', $id)->get();
        try{
            foreach ($depreciation as $dep) {
                $dep->percent = $request->percent;
                $dep->accumulated = $request->accumulated;
                $dep->present_value = $request->present_value;
                $dep->depreciation = $request->current_year;
                $dep->save();
            }
            
            return redirect('/component/add-depreciation')->with('success', 'Depreciation addedd successfully');
        }catch(\Exception $e){
            return redirect('/component/add-depreciation')->with('error', $e->getMessage());
        }
    }

    public function customerLottery(){
        $allCustomer = DB::table('sales')->orderBy('total', 'DESC')
             ->leftjoin('product_purchases', 'sales.purchase_id', 'product_purchases.id')
             ->select('sales.*', 'product_purchases.item_name', 'product_purchases.item_code')
             ->where('sales.status', '1')
             ->limit('20')
             ->get();
        return view('user.pages.components.lottery', compact('allCustomer'));
    }

    function fetch_data(Request $request){
     if($request->ajax()){
      if($request->from_date != '' && $request->to_date != ''){
       $data = DB::table('sales')
         ->whereBetween('created_at', array($request->from_date, $request->to_date))
         ->get();
      }else{
       $data = DB::table('sales')->orderBy('total', 'desc')
            ->join('product_purchases', 'sales.purchase_id', 'product_purchases.id')
            ->select('sales.*', 'product_purchases.item_name', 'product_purchases.item_code')
             ->where('sales.status', '1')
            ->get();
      }
      echo json_encode($data);
     }
    }
}
