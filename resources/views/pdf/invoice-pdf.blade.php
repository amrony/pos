<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <table width="100%">
                    <tbody>
                        <tr>
                            <td><strong>Invoice No: #{{ $invoice->invoice_no }}</strong></td>
                            <td>
                                <span style="font-size: 20px">Shapla Shopping Mall</span><br/>Farmgate,Dhaka                              
                            </td>
                            <td>
                                <span>ShowRoom : 01840001670<br/>
                                    Owner Number : 01768062664
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
        <hr style="margin-bottom: 0px;">
                <table>
                    <tbody>
                        <tr>
                            <td style="width: 45%"></td>
                            <td>
                                <u><strong><span style="font-size: 20px">Customer Invoice</span></strong></u>
                            </td>
                            <td style="width: 30%"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                @php
                $payment = App\Payment::where('invoice_id',$invoice->id)->first();
            @endphp

            <table width="100%">
                <tbody>
                    <tr>
                        <td width="30%"><strong>Name : </strong>{{ $payment->customer->name }}</td>
                        <td width="30%"><strong>Mobile : </strong>{{ $payment->customer->mobile_no }}</td>
                        <td width="40%"><strong>Address : </strong>{{ $payment->customer->address }}</td>
                    </tr>
                </tbody>
            </table>

   
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table border="1" width=100% style="margin-bottom: 10px;">
                    <thead>
                        <tr class="text-center">
                            <th>SL</th>
                            <th>Category</th>
                            <th>Product Name</th>
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
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $details->category->name }}</td>
                            <td>{{ $details->product->name }}</td>
                            <td>{{ $details->selling_qty }}</td>
                            <td>{{ $details->unit_price }}</td>
                            <td>{{ $details->seeling_price }}</td>
                        </tr>
                        @php
                            $total_sum+=$details->seeling_price;
                        @endphp
                        @endforeach
                        <tr>
                            <td class="text-right" colspan="5"><strong>Sub Total</strong></td>
                            <td class="text-center"><strong>{{ $total_sum }}</strong></td>
                        </tr>
                        <tr>
                            <td class="text-right" colspan="5">Discount</td>
                            <td class="text-center">{{ $payment->discount_amount }}</td>
                        </tr>
                        <tr>
                            <td class="text-right" colspan="5">Paid Aount</td>
                            <td class="text-center">{{ $payment->paid_amount }}</td>
                        </tr>
                        <tr>
                            <td class="text-right" colspan="5">Due Aount</td>
                            <td class="text-center">{{ $payment->due_amount }}</td>
                        </tr>
                        <tr>
                            <td class="text-right" colspan="5"><strong>Grand Total</strong></td>
                            <td class="text-center"><strong>{{ $payment->total_amount }}</strong></td>
                        </tr>
                    </tbody>
                </table>
                @php
                    $date = new DateTime('now', new DateTimeZone('Asia/Dhaka'));
                @endphp
                <i>Printing time : {{ $date->format('F j,Y, g:i a') }}</i>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <hr style="margin-bottom: 0px;">
                <table border="0" width="100%">
                    <tbody>
                        <tr>
                            <td style="width: 40%">
                                <p style="text-align: center; margin-left: 20px;">Customer Signature</p>
                            </td>
                            <td style="width: 20%; text-align: center;"></td>
                            <td style="width: 40%">
                                <p style="text-align: center;">Seller Signature</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>