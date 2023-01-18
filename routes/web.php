<?php

use App\Http\Controllers\ArticulosController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VentaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace' => 'App\Http\Controllers'], function()
{
    Route::group(['middleware' => ['guest']], function() {
        /**
         * Login Routes
         */
        Route::get('/Login', [LoginController::class,'show'])->name('login.show');
        Route::post('/Login', [LoginController::class,'login'])->name('login.perform');

    });

    Route::group(['middleware'=>['auth']], function (){
        Route::get('/Salir',[LoginController::class,'logout'])->name('logout.perfom');

        Route::resource('Usuario', UsuarioController::class);
        Route::post('Usuario-Eliminar', [UsuarioController::class,'destroy'])->name('Usuario.eliminar');

        Route::resource('Proveedor', ProveedorController::class);
        Route::post('Proveedor-Eliminar', [ProveedorController::class,'destroy'])->name('Proveedor.eliminar');
        Route::get('Proveedor-list',[ProveedorController::class,'list'])->name('Proveedor.list');

        Route::resource('Articulo', ArticulosController::class);
        Route::post('Articulo-Eliminar', [ArticulosController::class,'destroy'])->name('Articulo.eliminar');

        Route::resource('Venta', VentaController::class);
        Route::post('Venta-Eliminar', [VentaController::class,'destroy'])->name('Venta.eliminar');
        Route::get('Venta-Lista', [VentaController::class,'list_inventario'])->name('Venta.lista');
        Route::post('Venta-Store',[VentaController::class,'store'])->name('Venta.store');
        Route::get('Venta/Ticket/{id}', [VentaController::class,'getTicket'])->name('Tienda.ticket');


    });

}
);


Route::get('/', function () {
    return view('home.index');
});



