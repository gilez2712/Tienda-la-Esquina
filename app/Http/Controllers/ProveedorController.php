<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProveedorRequest;
use App\Http\Requests\UpdateProveedorRequest;
use App\Models\Proveedor;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProveedorController extends Controller
{
    /**
 * Display a listing of the resource.
 *
 * @return Application|Factory|JsonResponse|View
 */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = Proveedor::select('*');
            return datatables()->of($data)
                ->addColumn('action', function($row){
                    $btn = '<a href="'.route('Proveedor.edit',$row->id).'" class="edit btn btn-primary" >Edit</a>
                            <a data-id="'.$row->id.'" href="javascript:void(0)" class="delete btn btn-danger" onclick="onDelete(this)">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);

        }

        return view('proveedor.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        return \view('Proveedor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProveedorRequest $request
     * @return \Illuminate\Http\RedirectResponse|Response
     */
    public function store(StoreProveedorRequest $request)
    {
        $request->validate([
            'nombre'=>'required',
            'email'=>'required',
            'descripcion'=>'required',
        ]);

        $proveedor = new Proveedor();

        $proveedor->nombre = $request->nombre;
        $proveedor->email = $request->email;
        $proveedor->descripcion = $request->descripcion;

        $proveedor->save();
        return redirect()->route('Proveedor.index')
            ->with('success','Proveedor Actualizado');

    }

    /**
     * Display the specified resource.
     *
     * @param Proveedor $proveedor
     * @return Response
     */
    public function show(Proveedor $proveedor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $proveedor
     * @return Application|Factory|View|Response
     */
    public function edit(int $proveedor)
    {
        $proveedor = Proveedor::find($proveedor);
        return view('proveedor.edit',compact('proveedor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProveedorRequest $request
     * @param int $proveedor
     * @return \Illuminate\Http\RedirectResponse|Response
     */
    public function update(UpdateProveedorRequest $request, int $proveedor)
    {
        $request->validate([
            'nombre'=>'required',
            'email'=>'required',
            'descripcion'=>'required',
        ]);

        $proveedor = Proveedor::find($proveedor);

        $proveedor->nombre = $request->nombre;
        $proveedor->email = $request->email;
        $proveedor->descripcion = $request->descripcion;
        $proveedor->save();
        return redirect()->route('Proveedor.index')
            ->with('success','Proveedor Actualizado');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function destroy(Request $request)
    {
        $com = Proveedor::where('id',$request->id)->delete();
        return Response()->json($com);
    }
    public function list(){
        $prov = Proveedor::get();
        return Response()->json($prov);
    }

}
