<?php

namespace App\Http\Controllers;

use App\Invoice_line;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class InvoiceLineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Invoice_line::all();
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
        $invoice_line = Invoice_line::create($request->all());
        return $invoice_line;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Invoice_line  $invoice_line
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice_line $invoice_line)
    {
        return $invoice_line;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Invoice_line  $invoice_line
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice_line $invoice_line)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invoice_line  $invoice_line
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice_line $invoice_line)
    {
        $invoice_line->update($request->all());
        return $invoice_line;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invoice_line  $invoice_line
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice_line $invoice_line)
    {
        $invoice_line->delete();
        return new JsonResponse(true);
    }
}
