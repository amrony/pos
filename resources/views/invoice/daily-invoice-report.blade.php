@extends('master')
@section('invoice')
  is-expanded
@endsection
@section('invoice_daily_report')
  active
@endsection
@section('body')
<div class="app-title">
    <div>
      <h1><i class="fa fa-edit"></i> Select Criteria</h1>
      {{-- <h2 class="text-center" style="color: green">{{ Session::get('message') }}</h2> --}}
    </div>
    {{-- <ul class="app-breadcrumb breadcrumb">
        <a href="" class="btn btn-danger" style="color: white;">All Invoice</a>
    </ul> --}}
  </div>

    <div class="tile">
        <form method="GET" action="{{ route('invoice.daily.report.pdf') }}" target="_blank" id="myForm">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="date">Start Date</label>
                            <input class="form-control form-control-sm"  type="date" id="start_date" name="start_date" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="date">End Date</label>
                            <input class="form-control form-control-sm"  type="date" id="end_date" name="end_date" required>
                        </div>
                    </div>
    
                    <div class="col-md-1" style="margin-top: 30px;">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-sm">Search</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    </div>
  </div>


@section('js')



@endsection

  
@endsection


