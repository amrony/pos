@extends('master')
@section('body')
<div class="app-title">
    <div>
      <h1><i class="fa fa-edit"></i> Update Unit</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <a href="{{ route('unit.index') }}" class="btn btn-danger" style="color: white;">All Unit</a>
    </ul>
  </div>

  <div class="tile">
      <div class="col-lg-8">
        <form action="{{ route('unit.update') }}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{ $unit->id }}">
                <div class="form-group"  style="margin-left: 101px;">
                <label for="name">Unit Name</label>
                <input class="form-control" id="name"  type="text" name="name" value="{{ $unit->name }}">
                </div>
                <div class="tile-footer">
                    <button class="btn btn-primary pull-right" type="submit">Update</button>
                </div><br><br>
        </form>
      </div>
    </div>
    
  </div>

@endsection