<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $suppliers = Supplier::all();
        return view('supplier.index', compact('suppliers'));
    }

    public function create(){
        return view('supplier.create');
    }

    public function store(Request $request){

        $supplier = new Supplier();
        $supplier->name = $request->name;
        $supplier->mobile_no = $request->mobile_no;
        $supplier->email = $request->email;
        $supplier->address = $request->address;
        $supplier->save();

        if($supplier){
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
        $supplier = Supplier::find($id);
        return view('supplier.edit', compact('supplier'));
    }


    public function update(Request $request){
        // dd($request->id);
        $supplier = Supplier::find($request->id);
        $supplier->name = $request->name;
        $supplier->mobile_no = $request->mobile_no;
        $supplier->email = $request->email;
        $supplier->address = $request->address;
        $supplier->update();

        if($supplier){
            $notification=array(
                'message' => 'Successfully  Updated',
                'alert_type' => 'success'
            );
            return Redirect()->route('supplier.index')->with($notification);
        }else{
            $notification=array(
                'message' => 'error',
                'alert-type' => 'success'
            );
        }
    }
}
