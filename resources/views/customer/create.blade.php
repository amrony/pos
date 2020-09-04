@extends('master')
@section('body')
<div class="app-title">
    <div>
      <h1><i class="fa fa-edit"></i> Add Customer</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <a href="{{ route('customer.index') }}" class="btn btn-danger" style="color: white;">All Customer</a>
    </ul>
  </div>

  <div class="tile">
      <div class="col-lg-12">
        <form action="{{ route('customer.add') }}" method="post" id="myForm">
            @csrf
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Supplier Name</label>
                            <input class="form-control" id="name"  type="text" name="name"  placeholder="Enter Name">
                            <font style="color: red;">{{ ($errors->has('name'))?($errors->first('name')):'' }}</font>
                          </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="mobile_no">Mobile Number</label>
                            <input class="form-control" id="mobile_no" name="mobile_no" placeholder="Enter Mobile Number">
                            <font style="color: red;">{{ ($errors->has('mobile_no'))?($errors->first('mobile_no')):'' }}</font>
                          </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input class="form-control" id="email"  type="email" name="email"  placeholder="Enter Email">
                            <font style="color: red;">{{ ($errors->has('email'))?($errors->first('email')):'' }}</font>
                          </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label >Address</label>
                            <input class="form-control" name="address" type="text" placeholder="Enter Address">
                            <font style="color: red;">{{ ($errors->has('address'))?($errors->first('address')):'' }}</font>
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

@section('js')
<script src="{{ asset('/')  }}public/admin/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="{{ asset('/')  }}public/admin/plugins/jquery-validation/additional-methods.min.js"></script>
<script type="text/javascript">
  $(document).ready(function () {
    $('#myForm').validate({
      console.log("Hello");
      rules: {
        name: {
          required: true,
        },
        mobile_no: {
          required: true,
        },
        email: {
          required: true,
          email: true,
        },
        address: {
          required: true,
        },
        // password: {
        //   required: true,
        //   minlength: 6
        // },
        // password2: {
        //   required: true,
        //   equalTo: '#password'
        // }
      },
      messages: {
        name: {
          required: "Please enter supplier name",
        },
        mobile_no: {
          required: "Please enter mobile number",
        },
        email: {
          required: "Please enter a email address",
          email: "Please enter a <em>vaild</em> email address"
        },
        address: {
          required: "Please enter customer address",
        },
        // password: {
        //   required: "Please enter a password",
        //   minlength: "Password will be minimum 6 characters of numbers"
        // },
        // password2: {
        //   required: "Please enter a password",
        //   equalTo: "Confirm password does not match"
        // },
      },
      errorElement: 'span',
      errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
      },
      highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      }
    });
  });
  </script>
    
@endsection