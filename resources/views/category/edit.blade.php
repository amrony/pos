@extends('master')
@section('body')
<div class="app-title">
    <div>
      <h1><i class="fa fa-edit"></i> Add Category</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <a href="{{ route('category.index') }}" class="btn btn-danger" style="color: white;">All Category</a>
    </ul>
  </div>

  <div class="tile">
      <div class="col-lg-8">
        <form action="{{ route('category.update') }}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{ $category->id }}">
                <div class="form-group"  style="margin-left: 101px;">
                <label for="name">Category Name</label>
                <input class="form-control" id="name"  type="text" name="name" value="{{ $category->name }}">
                </div>
                <div class="tile-footer">
                    <button class="btn btn-primary pull-right" type="submit">Update</button>
                </div><br><br>
        </form>
      </div>
    </div>
    
  </div>

@endsection