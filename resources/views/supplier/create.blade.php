@extends('master')
@section('body')
<div class="app-title">
    <div>
      <h1><i class="fa fa-edit"></i> Add Supplier</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <a href="{{ route('supplier.index') }}" class="btn btn-danger" style="color: white;">All Supplier</a>
    </ul>
  </div>

  <div class="tile">
      <div class="col-lg-12">
        <form action="{{ route('supplier.add') }}" method="post">
            @csrf
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Supplier Name</label>
                            <input class="form-control" id="name"  type="text" name="name"  placeholder="Enter Name">
                          </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="mobile_no">Mobile Number</label>
                            <input class="form-control" id="mobile_no" name="mobile_no" placeholder="Enter Mobile Number">
                          </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input class="form-control" id="email"  type="email" name="email"  placeholder="Enter Email">
                          </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label >Address</label>
                            <input class="form-control" name="address" type="text" placeholder="Enter Address">
                          </div>
                    </div>
                </div>
                <div class="tile-footer">
                    <button class="btn btn-primary pull-right" type="submit">Submit</button>
                  </div><br><br>
            </div>
          
        </form>
      </div>
    </div>
    
  </div>

@endsection