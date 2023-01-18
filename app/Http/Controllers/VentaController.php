<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVentaRequest;
use App\Http\Requests\UpdateVentaRequest;
use App\Models\Articulos;
use App\Models\DetalleVenta;
use App\Models\Venta;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index()
    {
        return view('venta.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreVentaRequest $request
     * @return RedirectResponse|void
     */
    public function store(StoreVentaRequest $request)
    {
        ;

        $venta = new Venta();
        $cliente = auth()->user()->id;
        $total = $request->total;
        $venta->cliente = $cliente;
        $venta->total = $total;
        $venta->fecha = Carbon::now();
        $venta->save();

        for ($i = 0; $i < sizeof($request->inventario); $i++){
            print $request->inventario[$i];
            $detalle_venta = new DetalleVenta();
            $detalle_venta->id_venta = $venta->id;
            $detalle_venta->id_articulo = $request->inventario[$i];
            $detalle_venta->cantidad = $request->existencia[$i];
            $detalle_venta->subtotal = $request->total_p[$i];
            $detalle_venta->precio = $request->precio_venta[$i];
            $detalle_venta->save();
            $articulo = Articulos::find($request->inventario[$i]);
            $articulo->cantidad = $articulo->cantidad - $request->inventario[$i];
            $articulo->save();
        }

        $venta = $venta->toArray();
        return redirect()->route('Venta.index')
            ->with('success',compact('venta'));
    }

    /**
     * Display the specified resource.
     *
     * @param Venta $venta
     * @return Response
     */
    public function show(Venta $venta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Venta $venta
     * @return Response
     */
    public function edit(Venta $venta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateVentaRequest $request
     * @param Venta $venta
     * @return Response
     */
    public function update(UpdateVentaRequest $request, Venta $venta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Venta $venta
     * @return Response
     */
    public function destroy(Venta $venta)
    {
        //
    }

    public function list_inventario(){

            $producto = Articulos::where('cantidad','>',0)->get();
        $productos = [];
        foreach ($producto as $item) {
            $productos[] = [
                'id' =>  $item->id,
                'nombre'=>$item->nombre,
                'precio_venta' =>$item->precio,
                'stock' => $item->cantidad,
                'imagen'=> $item->imagen,
                'descripcion'=>$item->descripcion
            ];
            }

        return Response()->json($productos);
    }

    public function getTicket($id){

        $venta = Venta::find($id);

        $cliente = auth()->user();

        $Ticket = '
       <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div class="container-fluid">
    <div class="row text-center">Tienda La Esquina</div>
    <div class="row text-center" >Ticket de Venta</div>

    <div style="margin: 0 auto">
        Folio: FOLIO
    </div>
    <div style="margin: 0 auto">
       Cliente: CLIENTE
    </div>
    <div style="margin: 0 auto">
       Fecha:  FECHA_HORA
    </div>
    <div style="margin: 0 auto">
        -----------------------
        <table>
       <thead>
       <tr>
       <th>
       Producto
</th>
  <th>
       Cantidad
</th>
  <th>
       Precio
</th>
  <th>
       Total
</th>
</tr>
</thead>
<tbody>
PRODUCTOS
</tbody>

        </table>
        -----------------------
    </div>
    <div style="margin: 0 auto">
        Total: $ TOTAL
    </div>

</div>
</body>
</html>

        ';
        $Ticket = str_replace(['FOLIO','CLIENTE','FECHA_HORA','TOTAL'],
            [$venta->id,$cliente->name,$venta->fecha,$venta->total],
            $Ticket);

        $detalle = DetalleVenta::where('id_venta','=',$venta->id)->get();
        $Productos = '';
        foreach ($detalle as $item) {
            $TAGS = [
                Articulos::find($item->id_articulo)->nombre,
                $item->cantidad,
                $item->precio,
                $item->subtotal
            ];

            $Productos .= str_replace(
                ['NOMBRE','CANTIDAD','PRECIO','TOTAL'],$TAGS,'
        <tr>
        <td>NOMBRE</td>
        <td>CANTIDAD</td>
        <td>PRECIO</td>
        <td>TOTAL</td>
</tr>');
        }
        $Ticket = str_replace('PRODUCTOS',$Productos,$Ticket);

        return Response()->json(['ticket'=>$Ticket]);
    }

}