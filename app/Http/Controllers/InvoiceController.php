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
    //TODO when something is not OK, Laravel will usually show us what is wrong, what line, we will receive an error message. But this not works with L+Vue. How to solve this?
    public function store(Request $request)
    {
        //invoice handling
        $invoice = new Invoice();
        $invoice->customer_id = $request->input('customer.id');
        $invoice->customer_name = $request->input('customer.name');
        $invoice->save();

        //invoice items (tool handling)
        $invoice_items = $request->input(['tools']);
        $itemsToReturn = [];//this will be used simply to return all items to the frontend, as part of the OK response
        foreach ($invoice_items as $tool) {
            $invoiceitem = new Invoiceitem();
            $invoiceitem->invoice_id = $invoice->id;
            $invoiceitem->customer_name = $request->input('customer.name');
            $invoiceitem->model = $tool['model'];
            $invoiceitem->tool_id = $tool['id'];
            $invoiceitem->price = $tool['price'];//because $item is an associative array now... 'price' is the key, and example 2200 is the value
            $invoiceitem->taken = Carbon::now();
            $invoiceitem->save();
            $invoiceitems[] = $invoiceitem;
            //setting tools onStock to false
            $tool = Tool::find($invoiceitem->tool_id);
            $tool->onStock = false;
            $tool->save();
            $tools[] = $tool;
        }
        return response()->json([
            0 => $invoice, 
            1 => $invoiceitems,
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
        $invoice->sum_for_paying = $request->sum_for_paying;
        $invoice->invoice_closed = true;
        $invoice->closing_date = $request->closing_date;
        $invoice->save();

        //INVOICE ITEM
        $invoiceitems = $request->input(['invoiceitems']);
        foreach ($invoiceitems as $invoiceitem) {
            //----------------------------------------
            $invoiceitem = Invoiceitem::find($invoiceitem['id']);
            $invoiceitem->returned = $invoiceitem['returned'];
            $invoiceitem->time_on_field = $invoiceitem['time_on_field'];
            $invoiceitem->to_pay = $invoiceitem['to_pay'];
            //------------------------------------------
            
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
