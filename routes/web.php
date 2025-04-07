<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControllerApi;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExcellController;


/*
|--------------------------------------------------------------------------

| Web Routes
|--------------------------------------------------------------------------

*/

Route::get('/', function () {
    return redirect()->route('homebyte');
});


Route::middleware(['guest'])->group(function () {
    // Vista de inicio de sesión
    Route::get('/login', function () {
        return view('login');
    })->name('login');

    // Procesar inicio de sesión
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');
});


Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');




Route::get('/homebyte', [ControllerApi::class, 'homebyte'])->name('homebyte');



Route::middleware(['auth'])->group(function () {
    Route::get('/usuarios', [ControllerApi::class, 'usuarios'])->name('usuarios');

    Route::get('/usuarios/{id}', [ControllerApi::class, 'usuarios_detalle'])->name('usuarios.detalle');
   
Route::get('/usuarios_editar/{id}', [ControllerApi::class, 'usuarios_editar'])->name('usuarios_editar');
Route::put('/usuarios_salvar/{id}', [ControllerApi::class, 'usuarios_salvar'])->name('usuarios_salvar');

    Route::delete('/usuarios/{id}', [ControllerApi::class, 'usuarios_borrar'])->name('usuarios.borrar');

});


Route::get('/usuarios_alta', [ControllerApi::class, 'usuarios_alta'])->name('usuarios.alta');
Route::post('/usuarios_registrar', [ControllerApi::class, 'usuarios_registrar'])->name('usuarios.registrar');



Route::middleware(['auth'])->group(function () {
    Route::get('/productos', [ControllerApi::class, 'productos'])->name('productos');
    Route::get('/producto_detalle/{id}', [ControllerApi::class, 'producto_detalle'])->name('producto_detalle');
    Route::get('/producto_alta', [ControllerApi::class, 'producto_alta'])->name('producto_alta');
    Route::post('/producto_registrar', [ControllerApi::class, 'producto_registrar'])->name('producto_registrar');
    Route::get('/producto_editar/{id}', [ControllerApi::class, 'producto_editar'])->name('producto_editar');
    Route::put('/producto_salvar/{id}', [ControllerApi::class, 'producto_salvar'])->name('producto_salvar');
    Route::delete('/producto_borrar/{id}', [ControllerApi::class, 'producto_borrar'])->name('producto_borrar');
    
});



use App\Exports\ProductosExport;
use Maatwebsite\Excel\Facades\Excel;

Route::get('exportar-productos', function () {
    return Excel::download(new ProductosExport, 'productos.xlsx');
})->name('exportar.productos');

use App\Exports\UsertExport;


Route::get('exportar-usuarios', [ExcellController::class, 'exportarUsuarios'])
    ->name('exportar.usuarios');

Route::get('exportar-accesos', [ExcellController::class, 'exportarAccesos'])
    ->name('exportar.accesos');

// routes/web.php
Route::get('/accesos', [ControllerApi::class, 'acceso'])->name('accesos');


// En routes/web.php
Route::get('/controlar-puerta', function () {
    return view('controlar_puerta');  // Vista 'controlar_puerta.blade.php'
});

Route::post('/controlar-puerta', [ControllerApi::class, 'controlarPuerta'])->name('controlar.puerta');

