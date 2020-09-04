<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Purchase;
use App\Supplier;
use App\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class PurchaseController extends Controller
{
    public function index(){
        $purchases = Purchase::orderBy('date','desc')->orderBy('id','desc')->get();
        return view('purchase.index',compact('purchases'));
    }

    public function create(){
        $suppliers = Supplier::all();
        $units = Unit::all();
        $categories = Category::all();
        $products = Product::all();
        return view('purchase.create',compact('suppliers', 'units', 'categories', 'products'));
    }


    public function store(Request $request){
        // dd($request->category_id);
        // dd($request->all());
        if($request->category_id == null){
            return redirect()->back()->with('error','Sorry| you do not select any item');
        }else{
            $count_category = count($request->category_id);
            for($i=0; $i<$count_category; $i++){
                $purchase = new Purchase();
                $purchase->date = date('Y-m-d',strtotime($request->date[$i]));
                // $purchase->date = $request->date[$i];
                $purchase->purchase_no = $request->purchase_no[$i];
                $purchase->supplier_id = $request->supplier_id[$i];
                $purchase->category_id = $request->category_id[$i];
                $purchase->product_id = $request->product_id[$i];
                $purchase->buying_qty = $request->buying_qty[$i];
                $purchase->unit_price = $request->unit_price[$i];
                $purchase->buying_price = $request->buying_price[$i];
                $purchase->description = $request->description[$i];
                $purchase->created_by = Auth::user()->id;
                $purchase->status = '0';
                $purchase->save();
            }
        }

        return redirect()->back();
    }


    public function pendingPurchase(){
        $purchases = Purchase::orderBy('date','desc')->orderBy('id','desc')->where('status','0')->get();
        return view('purchase.pending',compact('purchases'));
    }

    public function approvePurchase($id){
        $purchase = Purchase::find($id);
        $product = Product::where('id',$purchase->product_id)->first();
        $purchase_qty = ((float)($purchase->buying_qty)+(float)($product->quantity));
        $product->quantity = $purchase_qty;
        if($product->save()){
            DB::table('purchases')
                ->where('id',$id)
                ->update(['status' => 1]);
        }
        return redirect()->back();
    }

    public function delete($id){
        $purchase = Purchase::where('id',$id);
        $purchase->delete();
        return redirect()->back();
    }
}
