@extends('master')
@section('body')

    <div class="app-title">
      <div>
        <h1><i class="fa fa-dashboard"></i> Manage Category</h1>
      </div>
      <ul class="app-breadcrumb breadcrumb">
          <a href="{{ route('category.create') }}" class="btn btn-info" style="color: white;">Add Category</a>
        </div>
      </ul>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <div class="tile-body">
            <div class="table-responsive">
              <div id="sampleTable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer"><div class="row"><div class="col-sm-12 col-md-6"><div class="dataTables_length" id="sampleTable_length"><label>Show <select name="sampleTable_length" aria-controls="sampleTable" class="form-control form-control-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div></div><div class="col-sm-12 col-md-6"><div id="sampleTable_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="sampleTable"></label></div></div></div><div class="row"><div class="col-sm-12"><table class="table table-hover table-bordered dataTable no-footer" id="sampleTable" role="grid" aria-describedby="sampleTable_info">
                <thead>
                  <tr role="row">
                    <th>SL</th>
                    <th>Category Name</th>
                    <th>Action</th>
                  </tr>
                </thead>
                {{-- @dd($suppliers); --}}
                <tbody>
                  @foreach($categories as $key=>$category)
                  <tr role="row" class="odd">
                      <td>{{ $key +1  }}</td>
                      <td>{{ $category->name }}</td>
                      @php
                         $count_category = App\Product::where('category_id',$category->id)->count(); 
                      @endphp
                      <td>
                        <a href="{{ route('category.edit', $category->id) }}" class="btn btn-success btn-sm">
                            <span class="fa fa-pencil-square-o fa-3x"></span>
                        </a>
                        @if($count_category<1)
                        <a href="" onclick="return confirm('Are You Sure Delete This !')" class="btn btn-danger btn-sm">
                                <span class="fa fa-trash-o"></span>
                        </a>
                        @endif
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
              </table></div></div><div class="row"><div class="col-sm-12 col-md-5"><div class="dataTables_info" id="sampleTable_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div></div><div class="col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers" id="sampleTable_paginate"><ul class="pagination"><li class="paginate_button page-item previous disabled" id="sampleTable_previous"><a href="#" aria-controls="sampleTable" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li><li class="paginate_button page-item active"><a href="#" aria-controls="sampleTable" data-dt-idx="1" tabindex="0" class="page-link">1</a></li><li class="paginate_button page-item "><a href="#" aria-controls="sampleTable" data-dt-idx="2" tabindex="0" class="page-link">2</a></li><li class="paginate_button page-item "><a href="#" aria-controls="sampleTable" data-dt-idx="3" tabindex="0" class="page-link">3</a></li><li class="paginate_button page-item "><a href="#" aria-controls="sampleTable" data-dt-idx="4" tabindex="0" class="page-link">4</a></li><li class="paginate_button page-item "><a href="#" aria-controls="sampleTable" data-dt-idx="5" tabindex="0" class="page-link">5</a></li><li class="paginate_button page-item "><a href="#" aria-controls="sampleTable" data-dt-idx="6" tabindex="0" class="page-link">6</a></li><li class="paginate_button page-item next" id="sampleTable_next"><a href="#" aria-controls="sampleTable" data-dt-idx="7" tabindex="0" class="page-link">Next</a></li></ul></div></div></div></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  
    
@endsection
