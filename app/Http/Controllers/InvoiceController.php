<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Invoiceitem;
use App\Tool;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Carbon\Carbon;
class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shops = Invoice::with('invoiceitems')->get();
        return $shops;
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //invoice handling
        $invoice = new Invoice();
        $invoice->customer_id = $request->input('customer_id');
        $invoice->customer_name = $request->input('customer_name');
        $invoice->save();

        //invoice items (tool handling)
        $invoiceitems = $request->input(['invoiceitems']);
        $itemsToReturn = [];//this will be used simply to return all items to the frontend, as part of the OK response
        foreach ($invoiceitems as $tool) {
            $invoiceitem = new Invoiceitem();
            $invoiceitem->invoice_id = $invoice->id;
            $invoiceitem->customer_name = $request->input('customer_name');
            $invoiceitem->model = $tool['model'];
            $invoiceitem->tool_id = $tool['id'];
            $invoiceitem->price = $tool['price'];//because $item is an associative array now... 'price' is the key, and example 2200 is the value
            $invoiceitem->taken = Carbon::now();
            $invoiceitem->save();
            $itemsToReturn[] = $invoiceitem;
            //setting tools onStock to false
            $tool = Tool::find($invoiceitem->tool_id);
            $tool->onStock = false;
            $tool->save();
            $tools[] = $tool;
        }
        return response()->json([
            0 => $invoice, 
            1 => $itemsToReturn,
            2 => $tools
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        return $invoice;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        //INVOICE
        $invoice = Invoice::find($id);
        $invoice->customer_name = $request->customer_name;
        $invoice->sum_for_paying = $request->sum_for_paying;
        $invoice->invoice_closed = true;
        $invoice->closing_date = $request->closing_date;
        $invoice->save();

        //INVOICE ITEM(s)
        $invoiceitems = $request->input(['invoiceitems']);
        $invoiceitems = $request->invoiceitems;
        foreach ($invoiceitems as $invoiceitemx) {
            $invoiceitem = Invoiceitem::find($invoiceitemx['id']);//this gives the id, it works
            $invoiceitem->returned = $invoiceitemx['returned'];
            $invoiceitem->time_on_field = $invoiceitemx['time_on_field'];
            $invoiceitem->to_pay = $invoiceitemx['to_pay'];
            $invoiceitem->invoice_line_closed = true;
            $invoiceitem->save();
        }

        //SET TOOLS TO ONSTOCK AGAIN


        return $invoice;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return new JsonResponse(true);
    }
}
