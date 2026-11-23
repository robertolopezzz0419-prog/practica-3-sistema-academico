<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\AccesoController;

// Inicio de sesión
Route::get('/login', [AccesoController::class, 'mostrarLogin'])->name('login');
Route::post('/login', [AccesoController::class, 'iniciarSesion'])->name('login.procesar');
Route::post('/logout', [AccesoController::class, 'cerrarSesion'])->name('logout');

// Página principal
Route::get('/', function () {
    return redirect()->route('login');
});

// Rutas para el profesor
Route::middleware(['auth', 'rol:profesor'])->group(function () {
    Route::resource('alumnos', AlumnoController::class);
});

// Ruta para el alumno
Route::middleware(['auth', 'rol:alumno'])->group(function () {
    Route::get('/mi-informacion', [AlumnoController::class, 'miInfo'])
        ->name('alumnos.mi-info');
});