<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Supplier;
use App\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        return view('product.index', compact('products'));
    }

    public function create(){
        $suppliers = Supplier::all();
        $units = Unit::all();
        $categories = Category::all();
        return view('product.create',compact('categories','units','suppliers'));
    }

    public function store(Request $request){
        $product = new Product();
        $product->supplier_id = $request->supplier_id;
        $product->unit_id = $request->unit_id;
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->created_by = Auth::user()->id;
        $product->save();

        if($product){
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
        $product = Product::find($id);
        $suppliers = Supplier::all();
        $units = Unit::all();
        $categories = Category::all();
        return view('product.edit',compact('product','categories','units','suppliers'));
    }

    public function update(Request $request){
        $product = Product::find($request->id);
        $product->supplier_id = $request->supplier_id;
        $product->unit_id = $request->unit_id;
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->save();

        if($product){
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
