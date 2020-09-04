@extends('master')
@section('body')
<div class="app-title">
    <div>
      <h1><i class="fa fa-edit"></i> Update Product</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <a href="{{ route('product.index') }}" class="btn btn-danger" style="color: white;">All Product</a>
    </ul>
  </div>

  <div class="tile">
      <div class="col-lg-12">
        <form action="{{ route('product.update') }}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{ $product->id }}">
            <div class="col-md-12">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="mobile_no">Supplier Name</label>
                        <select class="form-control" name="supplier_id">
                          <option>-- Select Supplier --</option>
                          @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}"{{ $supplier->id == $product->supplier_id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                          @endforeach
                          
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="mobile_no">Unit Name</label>
                      <select class="form-control" name="unit_id">
                        <option>-- Select Unit --</option>
                        @foreach($units as $unit)
                            <option value="{{ $unit->id }}"{{ $unit->id == $product->unit_id ? 'selected' : '' }}>{{ $unit->name }}</option>
                          @endforeach
                        
                      </select>
                  </div>
                </div>
              </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="mobile_no">Category Name</label>
                        <select class="form-control" name="category_id">
                          <option>-- Select Category --</option>
                          @foreach($categories as $category)
                            <option value="{{ $category->id }}"{{ $category->id == $product->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                          @endforeach
                        </select>
                    </div>
                  </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Product Name</label>
                            <input class="form-control" id="name"  type="text" name="name"  value="{{ $product->name }}">
                          </div>
                    </div>
                </div>
                <div class="tile-footer">
                    <button class="btn btn-primary pull-right" type="submit">Update</button>
                  </div><br><br>
            </div>
          
        </form>
      </div>
    </div>
    
  </div>

@endsection