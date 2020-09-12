<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daily Invoice Report PDF</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <table width="100%">
                    <tbody>
                        <tr>
                            <td></td>
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
                            <td style="width: 25%"></td>
                            <td>
                                <u><strong><span style="font-size: 20px">Daily Invoice Report({{ date('Y-m-d', strtotime($start_date)) }} - {{ date('Y-m-d', strtotime($end_date)) }})</span></strong></u>
                            </td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                      <div class="table-responsive">
                        <table border="1" width="100%"> 
                        {{-- id="sampleTable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer table-responsive"><div class="row"><div class="col-sm-12 col-md-6"><div class="dataTables_length" id="sampleTable_length"><label>Show <select name="sampleTable_length" aria-controls="sampleTable" class="form-control form-control-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div></div><div class="col-sm-12 col-md-6"><div id="sampleTable_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="sampleTable"></label></div></div></div><div class="row"><div class="col-sm-12"><table class="table table-hover table-bordered dataTable no-footer" id="sampleTable" role="grid" aria-describedby="sampleTable_info"> --}}
                          <thead>
                            <tr role="row">
                              <th>SL</th>
                              <th>Customer Name</th>
                              <th>Invoice No</th>
                              <th>Date</th>
                              <th>Description</th>
                              <th>Amount</th>
                            </tr>
                          </thead>
                          {{-- @dd($suppliers); --}}
                          <tbody>
                              @php
                                $total_sum = '0';  
                              @endphp
                            @foreach($allData as $key=>$invoice)
                            <tr role="row" class="odd">
                                <td>{{ $key +1  }}</td>
                                <td>
                                  {{ $invoice->payment->customer->name }}
                                  ({{ $invoice->payment->customer->mobile_no }}-{{ $invoice->payment->customer->address }})
                                </td>
                                <td>Invoice No #{{ $invoice->invoice_no }}</td>
                                <td>{{ date('d-m-Y', strtotime($invoice->date)) }}</td>
                                <td>{{ $invoice->description }}</td>
                                <td>{{ $invoice->payment->total_amount }}</td>
                                @php
                                    $total_sum += $invoice->payment->total_amount;
                                @endphp
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="5" style="text-align: right; margin-left: 20px;">Grand Total</td>
                                <td>{{ $total_sum }}</td>
                            </tr>
                            </tbody>
                        </table>
                    {{-- </div></div><div class="row"><div class="col-sm-12 col-md-5"><div class="dataTables_info" id="sampleTable_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div></div><div class="col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers" id="sampleTable_paginate"><ul class="pagination"><li class="paginate_button page-item previous disabled" id="sampleTable_previous"><a href="#" aria-controls="sampleTable" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li><li class="paginate_button page-item active"><a href="#" aria-controls="sampleTable" data-dt-idx="1" tabindex="0" class="page-link">1</a></li><li class="paginate_button page-item "><a href="#" aria-controls="sampleTable" data-dt-idx="2" tabindex="0" class="page-link">2</a></li><li class="paginate_button page-item "><a href="#" aria-controls="sampleTable" data-dt-idx="3" tabindex="0" class="page-link">3</a></li><li class="paginate_button page-item "><a href="#" aria-controls="sampleTable" data-dt-idx="4" tabindex="0" class="page-link">4</a></li><li class="paginate_button page-item "><a href="#" aria-controls="sampleTable" data-dt-idx="5" tabindex="0" class="page-link">5</a></li><li class="paginate_button page-item "><a href="#" aria-controls="sampleTable" data-dt-idx="6" tabindex="0" class="page-link">6</a></li><li class="paginate_button page-item next" id="sampleTable_next"><a href="#" aria-controls="sampleTable" data-dt-idx="7" tabindex="0" class="page-link">Next</a></li></ul></div></div></div></table> --}}
                      </div>
                    </div>
                  </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                {{-- <hr style="margin-bottom: 0px;"> --}}
                <table border="0" width="100%">
                    <tbody>
                        <tr>
                            <td style="width: 40%">
                            </td>
                            <td style="width: 20%; text-align: center;"></td>
                            <td style="width: 20%">
                                <p style="text-align: center; border-bottom: 1px solid gray">Owener Signature</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>