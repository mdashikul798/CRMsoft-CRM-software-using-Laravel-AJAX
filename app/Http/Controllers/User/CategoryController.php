<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\User\Category;
use Session;

class CategoryController extends Controller
{

    public function addCategory(){
    	return view('user.pages.category.addCategory');
    }

    public function saveCategory(Request $request){
    	$request->validate([
    		'category_name' => 'required | unique:categories'
    	]);
    	$category = new Category();
    	$category->category_name = $request->category_name;
    	$category->description = $request->description;
    	$category->save();

    	Session::flash('success', 'Category added successfully');
    	return back();
    }

    public function allCategory(){
    	$allCategory = Category::orderBy('category_name', 'ASC')->get();
    	return view('user.pages.category.listCategory', compact('allCategory'));
    }

    public function cateStatus($id, $status){
    	$category = Category::find($id);
    	$category->status = $status;
    	$category->save();

    	return back();
    }


    public function editCate($id){
    	/*$editCate = Category::find($id);
    	return view('user.pages.category.listCategory', compact('editCate'));*/
    	return $id;
    }

    public function dleteCate($id){
    	$category = Category::find($id);
    	$category->delete();

    	Session::flash('success', 'Category delete! successfully');
    	return back();
    }
}
