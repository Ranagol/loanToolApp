<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Invoiceitem;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Invoice::all();
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
        $invoice = new Invoice();
        $invoice->customer_id = $request->input('invoice.customer_id');
        $invoice->save();

        $invoice_items = $request->input(['invoice_items']);
        foreach ($invoice_items as $item) {
            $invoiceitem = new Invoiceitem();
            $invoiceitem->invoice_id = $invoice->id;
            $invoiceitem->tool_id = $item['tool_id'];
            $invoiceitem->price = $item['price'];//because $item is an associative array now... 'price' is the key, and example 2200 is the value
            $invoiceitem->save();
            return response()->json($invoiceitem);
        }
        
        



         
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
    public function update(Request $request, Invoice $invoice)
    {
        $invoice->update($request->all());
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
