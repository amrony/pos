<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(){
        $customers = Customer::all();
        return view('customer.index', compact('customers'));
    }

    public function create(){
        return view('customer.create');
    }

    public function store(Request $request){

        $this->validate($request,[
            'name' => 'required',
            'mobile_no' => 'required',
            'email' => 'required|unique:customers,email',
            'address' => 'required'
        ]);
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->mobile_no = $request->mobile_no;
        $customer->email = $request->email;
        $customer->address = $request->address;
        $customer->save();

        if($customer){
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
        $customer = Customer::find($id);
        return view('customer.edit', compact('customer'));
    }

    public function update(Request $request){
        $customer = Customer::find($request->id);
        // dd($customer);
        $customer->name = $request->name;
        $customer->mobile_no = $request->mobile_no;
        $customer->email = $request->email;
        $customer->address = $request->address;
        $customer->update();

        if($customer){
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
