@extends('master')
{{-- @section('invoice')
  is-expanded
@endsection
@section('invoice_pending_list')
  active
@endsection --}}
@section('body')

    <div class="app-title">
      <div>
        <h1><i class="fa fa-dashboard"></i> Pending Invoice List</h1>
      </div>
    </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <div class="tile-body">
            <div class=" p-1">
                <strong><i class="fa fa-check"></i> Invoice No #{{ $invoice->invoice_no }} ({{ date('m-d-Y',strtotime($invoice->date)) }})</strong>
                <a href="{{ route('invoice.pending.list') }}" class="btn btn-info pull-right" style="color: white;">Pending Invoice List</a>
            </div><hr>
            <div class="col-md-12">
                @php
                    $payment = App\Payment::where('invoice_id',$invoice->id)->first();

                @endphp
                <table width=100%>
                    <tbody>
                        <tr>
                            <td width=15%><p><strong>Customer Info</strong></p></td>
                            <td width=25%><p><strong>Name : </strong> {{ $payment->customer->name }}</p></td>
                            <td width=25%><p><strong>Mobile Number : </strong>{{ $payment->customer->mobile_no }}</p></td>
                            <td width=35%><p><strong>Address : </strong>{{ $payment->customer->address }}</p></td>
                        </tr>
                        <tr>
                            <td width=15%></td>
                            <td width=85% colspan="3"><p><strong>Description : </strong>{{ $invoice->description }}</p></td>
                        </tr>
                    </tbody>
                </table>

                <form action="{{ route('approval.store',$invoice->id) }}" method="post">
                    @csrf
                    <table border="1" width=100% style="margin-bottom: 10px;">
                        <thead>
                            <tr class="text-center">
                                <th>SL</th>
                                <th>Category</th>
                                <th>Product Name</th>
                                <th style="background: rgb(160, 153, 153); padding: 1px;">Current Stock</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                               $total_sum = '0'; 
                            @endphp
                            @foreach ($invoice->invoice_details as $key=>$details)
                            <tr class="text-center">
                                <input type="hidden" name="category_id[]" value="{{ $details->category_id }}">
                                <input type="hidden" name="product_id[]" value="{{ $details->product_id }}">
                                <input type="hidden" name="selling_qty[{{ $details->id }}]" value="{{ $details->selling_qty }}">
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $details->category->name }}</td>
                                <td>{{ $details->product->name }}</td>
                                <td style="background: rgb(160, 153, 153); padding: 1px;">{{ $details->product->quantity }}</td>
                                <td>{{ $details->selling_qty }}</td>
                                <td>{{ $details->unit_price }}</td>
                                <td>{{ $details->seeling_price }}</td>
                            </tr>
                            @php
                                $total_sum+=$details->seeling_price;
                            @endphp
                            @endforeach
                            <tr>
                                <td class="text-right" colspan="6"><strong>Sub Total</strong></td>
                                <td class="text-center"><strong>{{ $total_sum }}</strong></td>
                            </tr>
                            <tr>
                                <td class="text-right" colspan="6">Discount</td>
                                <td class="text-center">{{ $payment->discount_amount }}</td>
                            </tr>
                            <tr>
                                <td class="text-right" colspan="6">Paid Aount</td>
                                <td class="text-center">{{ $payment->paid_amount }}</td>
                            </tr>
                            <tr>
                                <td class="text-right" colspan="6">Due Aount</td>
                                <td class="text-center">{{ $payment->due_amount }}</td>
                            </tr>
                            <tr>
                                <td class="text-right" colspan="6"><strong>Grand Total</strong></td>
                                <td class="text-center"><strong>{{ $payment->total_amount }}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-success">Invoice Approve</button>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  
    
@endsection
