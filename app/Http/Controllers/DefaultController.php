<?php

namespace App\Http\Controllers;

use App\Purchase;
use App\Product;
use DB;
use Illuminate\Http\Request;

class DefaultController extends Controller
{
    public function getCategory(Request $request){
        $supplier_id = $request->supplier_id;
        $allCategories = Product::with(['category'])->select('category_id')->where('supplier_id', $supplier_id)->groupBy('category_id')->get();
        // $allCategories = DB::table('products')->where('supplier_id', $supplier_id)
        //                 ->join('categories','products.category_id','categories.id')
        //                 ->selectRaw('products.category_id')
        //                 ->groupBy('products.category_id')
        //                 ->get();
                        // dd($allCategories);

                        return response()->json($allCategories);
    }


    public function getProduct(Request $request){
        $category_id = $request->category_id;
        $allProducts = Product::where('category_id',$category_id)->get();
        // dd($allProducts);
        return response()->json($allProducts);
    }

    public function getStock(Request $request){
        $product_id = $request->product_id;
        $stock = Product::where('id', $product_id)->first()->quantity;
        return response()->json($stock);
    }
}
