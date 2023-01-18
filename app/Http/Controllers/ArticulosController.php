<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticulosRequest;
use App\Http\Requests\UpdateArticulosRequest;
use App\Models\Articulos;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ArticulosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|JsonResponse|View
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = Articulos::select('*');
            return datatables()->of($data)
                ->addColumn('action', function($row){
                    $btn = '<a href="'.route('Articulo.edit',$row->id).'" class="edit btn btn-primary" >Edit</a>
                            <a data-id="'.$row->id.'" href="javascript:void(0)" class="delete btn btn-danger" onclick="onDelete(this)">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);

        }

        return view('articulos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        return \view('articulos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreArticulosRequest $request
     * @return \Illuminate\Http\RedirectResponse|Response
     */
    public function store(StoreArticulosRequest $request)
    {
        $request->validate([
            'nombre'=>'required',
            'cantidad'=>'required',
            'descripcion'=>'required',
            'precio'=>'required',
            'stock'=>'required',
            'departamento'=>'required',
            'id_prov'=>'required',
        ]);

        $articulos = new Articulos();

        $articulos->nombre = $request->nombre;
        $articulos->cantidad = $request->cantidad;
        $articulos->descripcion = $request->descripcion;
        $articulos->precio = $request->precio;
        $articulos->stock = $request->stock;
        $articulos->fecha_caducidad = $request->fecha_caducidad;
        $articulos->departamento = $request->departamento;
        $articulos->id_prov = $request->id_prov;
        $articulos->save();
        return redirect()->route('Articulo.index')
            ->with('success','Articulos Actualizado');

    }

    /**
     * Display the specified resource.
     *
     * @param Articulos $articulos
     * @return Response
     */
    public function show(Articulos $articulos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $articulos
     * @return Application|Factory|View|Response
     */
    public function edit(int $articulos)
    {
        $articulo= Articulos::find($articulos);
        return view('articulos.edit',compact('articulo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateArticulosRequest $request
     * @param int $articulos
     * @return \Illuminate\Http\RedirectResponse|Response
     */
    public function update(UpdateArticulosRequest $request, int $articulos)
    {
        $request->validate([
            'nombre'=>'required',
            'cantidad'=>'required',
            'descripcion'=>'required',
            'precio'=>'required',
            'stock'=>'required',
            'fecha_caducidad'=>'required',
            'departamento'=>'required',
            'id_prov'=>'required',
        ]);

        $articulos = Articulos::find($articulos);

        $articulos->nombre = $request->nombre;
        $articulos->cantidad = $request->cantidad;
        $articulos->descripcion = $request->descripcion;
        $articulos->precio = $request->precio;
        $articulos->stock = $request->stock;
        $articulos->fecha_caducidad = $request->fecha_caducidad;
        $articulos->departamento = $request->departamento;
        $articulos->id_prov = $request->id_prov;
        $articulos->save();
        return redirect()->route('Articulo.index')
            ->with('success','Articulos Actualizado');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function destroy(Request $request)
    {
        $com = Articulos::where('id',$request->id)->delete();
        return Response()->json($com);
    }
}
