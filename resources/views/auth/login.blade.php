@extends('layouts.app')

@section('titulo')
    Inicia Sesión en DevStagram
@endsection

@section('contenido')
    
    <div class="md:flex md:justify-center md:gap-8 md:items-center">
        {{-- IMAGEN --}}
        <div class="md:w-6/12">
            <img class="rounded-lg" src="{{ asset('img/login.jpg') }}" alt="Imagen login de usuarios">
        </div>
        {{-- FORMULARIO --}}
        <div class="md:w-4/12 bg-white p-5 rounded-lg shadow-xl"> 
            <form method="POST" action="{{ route('login') }}" novalidate> {{-- novalidate → deshabilita validación de HTML5 --}}
                @csrf

                {{-- Alerta cuando no se puede iniciar sesión por credenciales inválidas  --}}
                @if (session('mensaje'))
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{ session('mensaje') }}
                    </p>
                @endif

                {{-- Campo email --}}
                <div class="mb-3">
                    <label for="email" class="mb-1 block uppercase text-gray-500 font-bold text-sm">Correo electrónico</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        placeholder="Ingresa tu email de registro" 
                        class="border p-1 w-full rounded-lg @error('email') border-red-500 @enderror"
                        value={{ old('email') }}
                    >
                </div>
                @error('email')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{ $message }}
                    </p>
                @enderror

                {{-- Campo contraseña --}}
                <div class="mb-3">
                    <label for="password" class="mb-1 block uppercase text-gray-500 font-bold text-sm">Contraseña</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        placeholder="Ingresa tu contraseña de registro" 
                        class="border p-1 w-full rounded-lg @error('password') border-red-500 @enderror"
                    >
                </div>
                @error('password')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{ $message }}
                    </p>
                @enderror

                <div class="mb-5">
                    <input type="checkbox" name="remember">
                    <label class="text-gray-500 font-bold text-sm">
                        Mantener mi sesión abierta
                    </label>
                </div>
                
                {{-- Botón submit --}}
                <input 
                    type="submit" 
                    value="Iniciar sesión"
                    class="bg-sky-600 hover:bg-sky-700 rounded-lg transition-colors cursor-pointer uppercase font-bold w-full p-2 text-white"    
                />
            </form>
        </div>
    </div>

@endsection