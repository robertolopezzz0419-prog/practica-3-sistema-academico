<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccesoController extends Controller
{
    // Mostrar pantalla de inicio de sesión
    public function mostrarLogin()
    {
        return view('auth.login');
    }

    // Comprobar los datos del usuario
    public function iniciarSesion(Request $request)
    {
        $datos = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($datos)) {
            $request->session()->regenerate();

            if (Auth::user()->rol === 'profesor') {
                return redirect()->route('alumnos.index');
            }

            return redirect()->route('alumnos.mi-info');
        }

        return back()->withErrors([
            'email' => 'Correo o contraseña incorrectos.',
        ])->onlyInput('email');
    }

    // Cerrar sesión
    public function cerrarSesion(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}