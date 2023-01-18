<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDetalleVentaRequest;
use App\Http\Requests\UpdateDetalleVentaRequest;
use App\Models\DetalleVenta;

class DetalleVentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreDetalleVentaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDetalleVentaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DetalleVenta  $detalleVenta
     * @return \Illuminate\Http\Response
     */
    public function show(DetalleVenta $detalleVenta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DetalleVenta  $detalleVenta
     * @return \Illuminate\Http\Response
     */
    public function edit(DetalleVenta $detalleVenta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDetalleVentaRequest  $request
     * @param  \App\Models\DetalleVenta  $detalleVenta
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDetalleVentaRequest $request, DetalleVenta $detalleVenta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DetalleVenta  $detalleVenta
     * @return \Illuminate\Http\Response
     */
    public function destroy(DetalleVenta $detalleVenta)
    {
        //
    }
}
