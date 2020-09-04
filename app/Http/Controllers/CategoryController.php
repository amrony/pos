<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('category.index',compact('categories'));
    }

    public function create(){
        return view('category.create');
    }

    public function store(Request $request){
        $category = new Category();
        $category->name = $request->name;
        $category->created_by = Auth::user()->id;
        $category->save();

        if($category){
            $notification=array(
                'message' => 'Successfully  Inserted',
                'alert_type' => 'success'
            );
            return Redirect()->back()->with($notification);
        }else{
            $notification=array(
                'message' => 'error',
                'alert-type' => 'success'
            );
        }
    }

    public function edit($id){
            $category = Category::find($id);
            return view('category.edit', compact('category'));
    }

    public function update(Request $request){
        $category = Category::find($request->id);
        $category->name = $request->name;
        $category->update();

        if($category){
            $notification=array(
                'message' => 'Successfully  Updated',
                'alert_type' => 'success'
            );
            return Redirect()->back()->with($notification);
        }else{
            $notification=array(
                'message' => 'error',
                'alert-type' => 'success'
            );
        }
    }
}
