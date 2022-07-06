@extends('layouts.app')

@section('titulo')
    Regístrate en DevStagram
@endsection

@section('contenido')
    
    <div class="md:flex md:justify-center md:gap-8 md:items-center">

        {{-- IMAGEN --}}
        <div class="md:w-6/12">
            <img class="rounded-lg" src="{{ asset('img/registrar.jpg') }}" alt="Imagen registro de usuarios">
        </div>
        
        {{-- FORMULARIO --}}
        <div class="md:w-4/12 bg-white p-5 rounded-lg shadow-xl"> 
            <form action="{{ route('register') }}" method="POST" novalidate> {{-- novalidate → deshabilita validación de HTML5 --}}
                @csrf

                {{-- Campo nombre --}}
                <div class="mb-3">
                    <label for="name" class="mb-1 block uppercase text-gray-500 font-bold text-sm">Nombre</label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        placeholder="Ingresa tu nombre" 
                        class="border p-1 w-full rounded-lg @error('name') border-red-500 @enderror"
                        value={{ old('name') }}
                    >

                    @error('name')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                {{-- Campo usuario --}}
                <div class="mb-3">
                    <label for="username" class="mb-1 block uppercase text-gray-500 font-bold text-sm">Usuario</label>
                    <input 
                        type="text" 
                        id="username" 
                        name="username" 
                        placeholder="Ingresa tu nombre de usuario" 
                        class="border p-1 w-full rounded-lg @error('username') border-red-500 @enderror"
                        value={{ old('username') }}
                    >

                    @error('username')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{ $message }}
                    </p>
                    @enderror
                </div>

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
                    
                    @error('email')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{ $message }}
                    </p>
                    @enderror
                </div>

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
                    
                    @error('password')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                {{-- Campo repetir contraseña --}}
                <div class="mb-3">
                    <label for="password_confirmation" class="mb-1 block uppercase text-gray-500 font-bold text-sm">Repetir contraseña</label>
                    <input  
                        type="password" 
                        id="password_confirmation" 
                        name="password_confirmation" 
                        placeholder="Repite tu contraseña de registro" 
                        class="border p-1 w-full rounded-l"
                    >
                </div>
                
                {{-- Botón submit --}}
                <input 
                    type="submit" 
                    value="Crear cuenta"
                    class="bg-sky-600 hover:bg-sky-700 rounded-lg transition-colors cursor-pointer uppercase font-bold w-full p-2 text-white"    
                />
            </form>
        </div>
    </div>

@endsection