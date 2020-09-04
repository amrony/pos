@extends('master')

@section('body')
<div class="app-title">
    <div>
      <h1><i class="fa fa-edit"></i> Add Purchase</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <a href="{{ route('purchase.index') }}" class="btn btn-danger" style="color: white;">All Purchase</a>
    </ul>
  </div>

  <div class="tile">
      <div class="col-lg-12">
        
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                          <label for="mobile_no">Purchase Date</label>
                            <input class="form-control form-control-sm" type="date" id="date" name="date">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                          <label for="mobile_no">Purchase No</label>
                          <input class="form-control form-control-sm" type="text" id="purchase_no" name="purchase_no">
                        </div>
                    </div>



                  <div class="col-md-4">
                    <div class="form-group">
                      <label  for="mobile_no">Supplier Name</label>
                        <select class="form-control select2" id="supplier_id" name="supplier_id">
                          <option>-- Select Supplier --</option>
                          @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                          @endforeach
                          
                        </select>
                    </div>
                  </div>

                </div>
            </div>

            <div class="col-md-12">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="mobile_no">Category Name</label>
                        <select class="form-control select2" id="category_id" name="category_id">
                          <option>-- Select Category --</option>
                          
                        </select>
                    </div>
                  </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Product Name</label>
                            <select class="form-control select2" id="product_id" name="product_id">
                                <option>-- Select Product --</option>
                               
                              </select>
                          </div>
                    </div>

                    <div class="col-md-2" style="padding: 30px;">
                        <div class="form-group">
                            <a type="btn" class="btn btn-primary btn-sm text-white addeventmore"><i class="fa fa-plus-circle"> Add Item</i></a>
                          </div>
                    </div>
                </div>
            </div>
          </div>
      </div>

      <div class="tile">
        <form method="POST" action="{{ route('purchase.store') }}" id="myForm">
          @csrf
          <table class="table-sm table-bordered" width="100%">
            <thead>
              <tr>
                <th>Category</th>
                <th>Product Name</th>
                <th width="7%">Pcs/Kg</th>
                <th width="10%">Unit Price</th>
                <th>Description</th>
                <th width="10%">Total Price</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody id="addRow" class="addRow">
              
            </tbody>

            <tbody>
              <tr>
                <td colspan="5"></td>
                <td>
                  <input type="text" name="estimated_amount" value="0" id="estimated_amount" class="form-control form-control-sm text-right estimated_amount" readonly style="background-color: #D8FDBA">
                </td>
                <td></td>
              </tr>
            </tbody>
          </table><br>
          <div class="form-group">
            <button type="submit" class="btn btn-primary" id="storeButton">Purchase Store</button>
          </div>
        </form>
      </div>
    </div>
  </div>


@section('js')
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}

<script id="document-template" type="text/x-handlebars-template">
  <tr class="delete_add_more_item" id="delete_add_more_item">
    <input type="hidden" name="date[]" value="@{{ date }}">
    <input type="hidden" name="purchase_no[]" value="@{{ purchase_no }}">
    <input type="hidden" name="supplier_id[]" value="@{{ supplier_id }}">
    <td>
      <input type="hidden" name="category_id[]" value="@{{ category_id }}">
      @{{ category_name }}
    </td>
    <td>
      <input type="hidden" name="product_id[]" value="@{{ product_id }}">
      @{{ product_name }}
    </td>
    <td>
      <input type="number" min="1" class="form-control form-control-sm text-right buying_qty" name="buying_qty[]" value="1">
    </td>
    <td>
      <input type="number" class="form-control form-control-sm text-right unit_price" name="unit_price[]" value="">
    </td>
    <td>
      <input type="text" name="description[]" class="form-control form-control-sm">
    </td>
    <td>
      <input class="form-control form-control-sm text-right buying_price" name="buying_price[]" value="0" readonly>
    </td>
    <td>
      <i class="btn btn-danger btn-sm fa fa-window-close removeeventmore"></i>
    </td>
  </tr>
</script>

<script type="text/javascript">
    $(document).ready(function(){
      $(document).on('click','.addeventmore',function(){
        var date = $('#date').val();
        var purchase_no = $('#purchase_no').val();
        var supplier_id = $('#supplier_id').val();
        var category_id = $('#category_id').val();
        var category_name = $('#category_id').find('option:selected').text();
        var product_id = $('#product_id').val();
        var product_name = $('#product_id').find('option:selected').text();

        
        

        var source = $("#document-template").html();
        var template = Handlebars.compile(source);
        var data={
          date:date,
          purchase_no:purchase_no,
          supplier_id:supplier_id,
          category_id:category_id,
          category_name:category_name,
          product_id:product_id,
          product_name:product_name,
        };

        var html= template(data);
        $("#addRow").append(html);
      });

      $(document).on("click",".removeeventmore",function(){
        $(this).closest(".delete_add_more_item").remove();
        totalAmountPrice();
      });

      $(document).on('keyup click','.unit_price,.buying_qty',function(){
        var unit_price = $(this).closest("tr").find("input.unit_price").val();
        var qty = $(this).closest("tr").find("input.buying_qty").val();
        var total = unit_price*qty;
        $(this).closest("tr").find("input.buying_price").val(total);
        totalAmountPrice();
      });

      function totalAmountPrice(){
        var sum=0;
        $('.buying_price').each(function(){
          var value = $(this).val();
          if(!isNaN(value) && value.length != 0){
            sum += parseFloat(value);
          }
        });
        $('#estimated_amount').val(sum);
      }
    });
</script>

<script type="text/javascript">
  $(function(){
    $(document).on('change','#supplier_id',function(){
      var supplier_id = $(this).val();
      $.ajax({
          url:"{{ route('get-category') }}",
          type:"GET",
          data:{supplier_id:supplier_id},
          success:function(data){
            var html = '<option value="">Select Category</option>';
            $.each(data,function(key,v){
            html += '<option value="'+v.category_id+'">'+v.category.name+'</option>';
          });
            $('#category_id').html(html);
          }
      });
    });
  });
</script>

<script type="text/javascript">
  $(function(){
    $(document).on('change','#category_id',function(){
      var category_id = $(this).val();
      $.ajax({
        url:"{{ route('get-product') }}",
        type:"GET",
        data:{category_id:category_id},
        success:function(data){
          var html = '<option value="">Select Product</option>';
          $.each(data,function(key,v){
            html += '<option value="'+v.id+'">'+v.name+'</option>'
          });
          $('#product_id').html(html);
        }
      });
    });
  });
</script>

<script>
  $(document).ready(function() {
    $('.select2').select2();
});
</script>



@endsection

  
@endsection


