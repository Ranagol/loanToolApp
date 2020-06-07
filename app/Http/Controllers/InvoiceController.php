<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Invoiceitem;
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
            $invoiceitem->price = $tool['price_for_24h'];//because $item is an associative array now... 'price' is the key, and example 2200 is the value
            $invoiceitem->taken = Carbon::now();
            $invoiceitem->save();
            $tools[] = $invoiceitem;
        }
        return response()->json([
            0 => $invoice, 
            1 => $tools,
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
