<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUsuarioRequest;
use App\Http\Requests\UpdateUsuarioRequest;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|JsonResponse|View
     */
    public function index(Request $request)
    {
        if($request->ajax()){
          $data = User::select('*');
          return datatables()->of($data)
              ->addColumn('action', function($row){
                  $btn = '<a href="'.route('Usuario.edit',$row->id).'" class="edit btn btn-primary" >Edit</a>
                            <a data-id="'.$row->id.'" href="javascript:void(0)" class="delete btn btn-danger" onclick="onDelete(this)">Delete</a>';
                  return $btn;
              })
              ->rawColumns(['action'])
              ->addIndexColumn()
              ->make(true);

        }

        return view('usuario.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        return \view('Usuario.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUsuarioRequest $request
     * @return \Illuminate\Http\RedirectResponse|Response
     */
    public function store(StoreUsuarioRequest $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'username'=>'required',
            'password'=>'required',
            'tipo'=>'required'
        ]);

        $usuario = new User();
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->username = $request->username;
        $usuario->password = password_hash($request->password,PASSWORD_DEFAULT);
        $usuario->tipo = $request->tipo;
        $usuario->save();
        return redirect()->route('Usuario.index')
            ->with('success','Usuario Registrado!');

    }

    /**
     * Display the specified resource.
     *
     * @param Usuario $usuario
     * @return Response
     */
    public function show(Usuario $usuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $usuario
     * @return Application|Factory|View|Response
     */
    public function edit(int $usuario)
    {
        $usuario = User::find($usuario);
        return view('usuario.edit',compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUsuarioRequest $request
     * @param int $usuario
     * @return \Illuminate\Http\RedirectResponse|Response
     */
    public function update(UpdateUsuarioRequest $request, int $usuario)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'username'=>'required',
            'tipo'=>'required'
        ]);

        $usuario = User::find($usuario);
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->username = $request->username;
        $usuario->password = password_hash($request->password,PASSWORD_DEFAULT);
        $usuario->tipo = $request->tipo;
        $usuario->save();
        return redirect()->route('Usuario.index')
            ->with('success','Usuario Actualizado');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function destroy(Request $request)
    {
        $com = User::where('id',$request->id)->delete();
        return Response()->json($com);
    }
}
