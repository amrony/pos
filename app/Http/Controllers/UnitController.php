<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Unit;

class UnitController extends Controller
{
    public function index(){
        $units = Unit::all();
        return view('unit.index', compact('units'));
    }

    public function create(){
        return view('unit.create');
    }

    public function store(Request $request){
        $unit = new Unit();
        $unit->name = $request->name;
        $unit->save();


        if($unit){
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
        $unit = Unit::find($id);
        return view('unit.edit', compact('unit'));
    }

    public function update(Request $request){
        $unit = Unit::find($request->id);

        $unit->name = $request->name;
        $unit->update();


        if($unit){
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
