<?php

namespace App\Http\Controllers;

use App\Invoiceline;
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
        return Invoiceline::all();
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
        $invoiceline = Invoiceline::create($request->all());
        return $invoiceline;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Invoiceline  $invoiceline
     * @return \Illuminate\Http\Response
     */
    public function show(Invoiceline $invoiceline)
    {
        return $invoiceline;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Invoiceline  $invoiceline
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoiceline $invoiceline)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invoiceline  $invoiceline
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoiceline $invoiceline)
    {
        $invoiceline->update($request->all());
        return $invoiceline;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invoiceline  $invoiceline
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoiceline $invoiceline)
    {
        $invoiceline->delete();
        return new JsonResponse(true);
    }
}
