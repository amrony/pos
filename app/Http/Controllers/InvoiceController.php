<?php

namespace App\Http\Controllers;

use App\Category;
use DB;
use App\Customer;
use App\Invoice;
use App\InvoiceDetail;
use App\Payment;
use App\PaymentDetail;
use App\Product;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Framework\Constraint\Count;

class InvoiceController extends Controller
{
    public function index(){
        $purchases = Invoice::orderBy('date','desc')->orderBy('id','desc')->where('status','1')->get();
        return view('invoice.index',compact('purchases'));
    }

    public function create(){
        $categories = Category::all();
        $invoice_data = Invoice::orderBy('id', 'desc')->first();
        if($invoice_data == null){
            $firstReg = '0';
            $invoice_no = $firstReg+1;
        }else{
            $invoice_data = Invoice::orderBy('id', 'desc')->first()->invoice_no;
            $invoice_no = $invoice_data+1;
        }
        $customers = Customer::all();
        $date = date('Y-d-m');
        return view('invoice.create',compact( 'categories', 'invoice_no','customers','date'));
    }

    public function store(Request $request){
        // dd($request->all());
        if($request->category_id == null){
            return redirect()->back()->with('message','Sorry! you do not select any product');
        }else{
            if($request->paid_amount > $request->estimated_amount){
                return redirect()->back()->with('message','Sorry! paid amount is maximum than total price');
            }else{
                $invoice = new Invoice();
                $invoice->invoice_no = $request->invoice_no;
                $invoice->date = date('Y-m-d', strtotime($request->date));
                $invoice->description = $request->description;
                $invoice->status = '0';
                $invoice->created_by = Auth::user()->id; 
                // dd($invoice);
                DB::transaction(function () use($request,$invoice) {
                    if($invoice->save()){
                        $count_category = Count($request->category_id);
                        // dd($count_category);
                        for($i = 0; $i <$count_category; $i++){
                            $invoice_details = new InvoiceDetail();
                            $invoice_details->date = date('Y-m-d', strtotime($request->date));
                            $invoice_details->invoice_id = $invoice->id;
                            $invoice_details->category_id = $request->category_id[$i];
                            $invoice_details->product_id = $request->product_id[$i];
                            $invoice_details->selling_qty = $request->selling_qty[$i];
                            $invoice_details->unit_price = $request->unit_price[$i];
                            $invoice_details->seeling_price = $request->selling_price[$i];
                            $invoice_details->status = '1';
                            
                            // dd($invoice_details);
                            $invoice_details->save();

                        }
                        if($request->customer_id == '0'){
                            $customer = new Customer();
                            $customer->name = $request->name;
                            $customer->mobile_no = $request->mobile_no;
                            $customer->address = $request->address;
                            $customer->save();
                            $customer_id = $customer->id;
                        }else{
                            $customer_id = $request->customer_id;
                        }

                        $payment = new Payment();
                        $payment_details = new PaymentDetail();
                        $payment->invoice_id = $invoice->id;
                        $payment->customer_id = $customer_id;
                        $payment->paid_status = $request->paid_status;
                        $payment->discount_amount = $request->discount_amount;
                        $payment->total_amount = $request->estimated_amount;
                        if($request->paid_status == 'full_paid'){
                            $payment->paid_amount = $request->estimated_amount;
                            $payment->due_amount = '0';
                            $payment_details->current_paid_amount = $request->estimated_amount;
                        }elseif($request->paid_status == 'full_due'){
                            $payment->paid_amount = '0';
                            $payment->due_amount = $request->estimated_amount;
                            $payment_details->current_paid_amount = '0';
                        }elseif($request->paid_status == 'partial_paid'){
                            $payment->paid_amount = $request->paid_amount;
                            $payment->due_amount = $request->estimated_amount - $request->paid_amount;
                            $payment_details->current_paid_amount = $request->paid_amount;
                        }
                        // dd($payment_details);
                        $payment->save();
                        $payment_details->invoice_id = $invoice->id;	
                        $payment_details->date = date('Y-m-d', strtotime($request->date));
                        
                       
                        $payment_details->save();

                    }
                });

            }
        }
        return redirect('/invoice/pending-list')->with('message', 'Insert Successfully');

    }

    public function pendingList(){
        $invoices = Invoice::orderBy('date','desc')->orderBy('id','desc')->where('status','0')->get();
       
        return view('invoice.pending-invoice-list',compact('invoices'));
    }

    public function approveInvoice($id){
        $invoice = Invoice::with('invoice_details')->find($id);
        // dd($invoice);
        return view('invoice.invoice-approve',compact('invoice'));
    }

    public function approvalStore(Request $request, $id){
        foreach($request->selling_qty as $key => $val){
            $invoice_details = InvoiceDetail::where('id',$key)->first();
            $product = Product::where('id', $invoice_details->product_id)->first();
            if($product->quantity < $request->selling_qty[$key]){
                return redirect()->back()->with('message','Sorry! You approve maximum value');
            }
        }

        $invoice = Invoice::find($id);
        $invoice->approved_by = Auth::user()->id;
        $invoice->status = '1';

        DB::transaction(function () use($request, $invoice, $id) {
            foreach($request->selling_qty as $key => $val){
                $invoice_details = InvoiceDetail::where('id',$key)->first();
                $product = Product::where('id',$invoice_details->product_id)->first();
                $product->quantity = ((float)$product->quantity)-((float)$request->selling_qty[$key]);
                $product->save();
            }
            $invoice->save();
        });

        return redirect()->back()->with('message','Invoice Successfully Approved!');
       
    }

    public function printInvoiceList(){
        $purchases = Invoice::orderBy('date','desc')->orderBy('id','desc')->where('status','1')->get();
        return view('invoice.pos-invoice-list',compact('purchases'));
    }


    public function printInvoice($id){
        $data['invoice'] = Invoice::with('invoice_details')->find($id);
        $pdf = PDF::loadView('pdf.invoice-pdf', $data);
        return $pdf->stream('document.pdf');
    }

    public function dailyReport(){
        return view('invoice.daily-invoice-report');
    }

    public function dailyReportPdf(Request $request){
        $sdate = date('Y-m-d', strtotime($request->start_date));
        $edate = date('Y-m-d', strtotime($request->end_date));
        // dd($sdate);
        $data['allData'] = Invoice::whereBetween('date', [$sdate, $edate])->where('status','1')->get();
        $data['start_date'] = date('Y-m-d', strtotime($request->start_date));
        $data['end_date'] = date('Y-m-d', strtotime($request->end_date));


        $pdf = PDF::loadView('pdf.daily-invoice-report-pdf', $data);
        return $pdf->stream('document.pdf');
    }

    

    public function delete($id){
        $invoice = Invoice::find($id);
        $invoice->delete();
        InvoiceDetail::where('invoice_id',$invoice->id)->delete();
        Payment::where('invoice_id', $invoice->id)->delete();
        PaymentDetail::where('invoice_id', $invoice->id)->delete();

        
        return redirect()->back();
    }


   
}
