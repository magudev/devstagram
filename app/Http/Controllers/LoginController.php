<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        // Valida el formulario
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Autenticar inicio de sesión
        if (!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            return back()->with('mensaje', 'Credenciales incorrectas');
        }

        return redirect()->route('posts.index', auth()->user()->username);

    }

}
