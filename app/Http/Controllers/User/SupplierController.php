<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\User\Supplier\Supplier;
use Session;

class SupplierController extends Controller
{
    public function addSupplier(){
    	return view('user.pages.supplier.add');
    }

    public function saveSupplier(Request $request){
    	$request->validate([
    		'name' => 'required',
    		'phone' => 'required'
    	]);
    	try{
    		$supplier = new Supplier();
	    	$supplier->name = $request->name;
	    	$supplier->phone = $request->phone;
	    	$supplier->email = $request->email;
	    	$supplier->address = $request->address;
	    	$supplier->address_2 = $request->address_2;
	    	$supplier->save();
	    	return back()->with('success', 'Supplier added successfully');
    	}catch(\Exception $e){
    		return back()->with('error', $e->getMessage());
    	}
    	
    }

    public function viewSupplier(){
    	$allSupplier = Supplier::orderBy('name', 'ASC')->get();
    	return view('user.pages.supplier.view', compact('allSupplier'));
    }

    public function supplierStatus($id, $status){
    	$supplier = Supplier::find($id);
    	$supplier->status = $status;
    	$supplier->update();
    	return back();
    }

    public function editSupplier(Request $request, $id){
    	$supplier = Supplier::find($id);
    	$supplier->phone = $request->phone;
    	$supplier->email = $request->email;
    	$supplier->address = $request->address;
    	$supplier->update();

    	return response()->json(['success', 'Supplier updated successfully']);
    }

    public function deleteSupplier($id){
    	$supplier = Supplier::find($id);
    	$supplier->delete();
    	return back();
    }
}
