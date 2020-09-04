@extends('master')

@section('body')
<div class="app-title">
    <div>
      <h1><i class="fa fa-edit"></i> Add Invoice</h1>
      {{-- <h2 class="text-center" style="color: green">{{ Session::get('message') }}</h2> --}}
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <a href="{{ route('invoice.index') }}" class="btn btn-danger" style="color: white;">All Invoice</a>
    </ul>
  </div>

<div class="tile">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-1">
                <div class="form-group">
                    <label for="invoice_no">Invoice No</label>
                    <input class="form-control form-control-sm" type="text" value="{{ $invoice_no }}" id="invoice_no" name="invoice_no" readonly style="background-color: #D8FDBA">
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label for="date">Purchase Date</label>
                    <input class="form-control form-control-sm" value="{{ $date }}" type="date" id="date" name="date">
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label  for="category_id">Category Name</label>
                    <select class="form-control select2" id="category_id" name="category_id">
                        <option>-- Select Supplier --</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                        
                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="product_id">Product Name</label>
                    <select class="form-control form-control-sm select2" id="product_id" name="product_id">
                        <option>-- Select Product --</option>
                        
                    </select>
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label for="current_stock_qty">Stock(Pcs/Kg)</label>
                    <input class="form-control form-control-sm" type="text" name="current_stock_qty" id="current_stock_qty" readonly style="background-color: #D8FDBA">
                </div>
            </div>

            <div class="col-md-1" style="margin-top: 30px;">
                <div class="form-group">
                    <a type="btn" class="btn btn-primary btn-sm text-white addeventmore"><i class="fa fa-plus-circle"> Add </i></a>
                </div>
            </div>
        </div>
    </div>
</div>
        
     

      <div class="tile">
        <form method="POST" action="{{ route('invoice.store') }}" id="myForm">
          @csrf
          <table class="table-sm table-bordered" width="100%">
            <thead>
              <tr>
                <th>Category</th>
                <th>Product Name</th>
                <th width="7%">Pcs/Kg</th>
                <th width="10%">Unit Price</th>
                <th width="17%">Total Price</th>
                <th width=10%>Action</th>
              </tr>
            </thead>
            <tbody id="addRow" class="addRow">
              
            </tbody>

            <tbody>
              <tr>
                <td colspan="4" class="text-right">Discount</td>
                <td>
                  <input type="text" name="discount_amount" id="discount_amount" class="form-control form-control-sm text-right" placeholder="Enter Discount Amount">
                </td>
              </tr>
              <tr>
                <td colspan="4" class="text-right">Grand Amount</td>
                <td>
                  <input type="text" name="estimated_amount" value="0" id="estimated_amount" class="form-control form-control-sm text-right estimated_amount" readonly style="background-color: #D8FDBA">
                </td>
                <td></td>
              </tr>
            </tbody>
          </table><br>
          <div class="form-row">
            <div class="form-group col-md-12">
              <textarea class="form-control" name="description" id="description" placeholder="Write description here"></textarea>
            </div>
          </div>


          <div class="form-row">
            <div class="form-group col-md-3">
              <label>Paid Status</label>
              <select name="paid_status" id="paid_status" class="form-control form-control-sm">
                <option value="">--Select Status--</option>
                <option value="full_paid">Full Paid</option>
                <option value="full_due">Full Due</option>
                <option value="partial_paid">Partial Paid</option>
              </select>
              <input type="text" name="paid_amount" class="form-control form-control-sm paid_amount" style="display: none;">
            </div>

            <div class="form-group col-md-9">
              <label>Customer Name</label>
                <select name="customer_id" id="customer_id" class="form-control form-control-sm select2">
                  <option value="">--Select Customer--</option>
                  @foreach($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->name }} ({{ $customer->mobile_no }} - {{ $customer->address }})</option>
                  @endforeach
                  <option value="0">New Customer</option>
                </select>
            </div>
          </div>

          <div class="form-row new_customer" style="display: none;">
            <div class="form-group col-md-4">
              <input type="text" name="name" id="name" class="form-control form-control-sm" placeholder="Write Customer Name">
            </div>
            <div class="form-group col-md-4">
              <input type="text" name="mobile_no" id="mobile_no" class="form-control form-control-sm" placeholder="Write Customer Mobile Number">
            </div>
            <div class="form-group col-md-4">
              <input type="text" name="address" id="address" class="form-control form-control-sm" placeholder="Write Customer Address">
            </div>
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-primary">Invoice Store</button>
          </div>
        </form>
      </div>
    </div>
  </div>


@section('js')
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}

<script id="document-template" type="text/x-handlebars-template">
  <tr class="delete_add_more_item" id="delete_add_more_item">
    <input type="hidden" name="date" value="@{{ date }}">
    <input type="hidden" name="invoice_no" value="@{{ invoice_no }}">
    <td>
      <input type="hidden" name="category_id[]" value="@{{ category_id }}">
      @{{ category_name }}
    </td>
    <td>
      <input type="hidden" name="product_id[]" value="@{{ product_id }}">
      @{{ product_name }}
    </td>
    <td>
      <input type="number" min="1" class="form-control form-control-sm text-right selling_qty" name="selling_qty[]" value="1">
    </td>
    <td>
      <input type="number" class="form-control form-control-sm text-right unit_price" name="unit_price[]" value="">
    </td>
    
    <td>
      <input class="form-control form-control-sm text-right selling_price" name="selling_price[]" value="0" readonly>
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
        var invoice_no = $('#invoice_no').val();
        var supplier_id = $('#supplier_id').val();
        var category_id = $('#category_id').val();
        var category_name = $('#category_id').find('option:selected').text();
        var product_id = $('#product_id').val();
        var product_name = $('#product_id').find('option:selected').text();

        
        // if(date==''){
        //   $.notify("Date id required", {globalPosition: 'top-right',className: 'error'});
        //   return false;
        // }
        // if(category_id==''){
        //   $.notify("Category is required", {globalPosition: 'top-right',className: 'error'});
        //   return false;
        // }
        // if(product_id==''){
        //   $.notify("Product is required", {globalPosition: 'top-right',className: 'error'});
        //   return false;
        // }



        var source = $("#document-template").html();
        var template = Handlebars.compile(source);
        var data={
          date:date,
          invoice_no:invoice_no,
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

      $(document).on('keyup click','.unit_price,.selling_qty',function(){
        var unit_price = $(this).closest("tr").find("input.unit_price").val();
        var qty = $(this).closest("tr").find("input.selling_qty").val();
        var total = unit_price*qty;
        $(this).closest("tr").find("input.selling_price").val(total);
        $('#discount_amount').trigger('keyup');
      });

      $(document).on('keyup','#discount_amount',function(){
        totalAmountPrice();
      });

      function totalAmountPrice(){
        var sum=0;
        $('.selling_price').each(function(){
          var value = $(this).val();
          if(!isNaN(value) && value.length != 0){
            sum += parseFloat(value);
          }
        });

        var discount_amount = parseFloat($('#discount_amount').val());
        if(!isNaN(discount_amount) && discount_amount.length != 0){
          sum -= parseFloat(discount_amount);
        }
        $('#estimated_amount').val(sum);
      }
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

<script text="text/javascript">
    $(function(){
        $(document).on('change','#product_id',function(){
            var product_id = $(this).val();
        $.ajax({
            url:"{{ route('check-product-stock') }}",
            type:"GET",
            data:{product_id:product_id},
            success:function(data){
                $('#current_stock_qty').val(data);
            }
        });
        });
    });
</script>

<script>
  $(document).on('change','#paid_status',function(){
    $paid_status = $(this).val();
    if($paid_status == 'partial_paid'){
      $('.paid_amount').show();
    }else{
      $('.paid_amount').hide();
    }
  });
</script>

<script>
  $(document).on('change','#customer_id',function(){
    $customer_id = $(this).val();
    if($customer_id == '0'){
      $('.new_customer').show();
    }else{
      $('.new_customer').hide();
    }
  });
</script>

<script>
  $(document).ready(function() {
    $('.select2').select2();
});
</script>



@endsection

  
@endsection


