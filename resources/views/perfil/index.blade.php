@extends('layouts.app')

@section('titulo')
    Editar perfil
@endsection

@section('contenido')
    
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <form method="POST" action="{{ route('perfil.store') }}" enctype="multipart/form-data" class="mt-10 md:mt-0">
                @csrf

                {{-- Nombre de usuario --}}
                <div class="mb-3">
                    <label for="username" class="mb-1 block uppercase text-gray-500 font-bold text-sm">Username</label>
                    <input 
                        type="text" 
                        id="username" 
                        name="username" 
                        placeholder="Ingresa tu nombre de usuario" 
                        class="border p-1 w-full rounded-lg @error('username') border-red-500 @enderror"
                        value="{{ auth()->user()->username }}"
                    >

                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Imagen --}}
                <div class="mb-3">
                    <label for="imagen" class="mb-1 block uppercase text-gray-500 font-bold text-sm">Imagen de perfil</label>
                    <input 
                        type="file" 
                        id="imagen" 
                        name="imagen" 
                        class="border p-1 w-full rounded-lg"
                        value=""
                        accept=".jpg, .jpeg, .png"
                    >

                </div>

                {{-- Email de usuario --}}
                <div class="mb-3">
                    <label for="email" class="mb-1 block uppercase text-gray-500 font-bold text-sm">Email</label>
                    <input 
                        type="text" 
                        id="email" 
                        name="email" 
                        placeholder="Ingresa tu correo de usuario" 
                        class="border p-1 w-full rounded-lg @error('email') border-red-500 @enderror"
                        value="{{ auth()->user()->email }}"
                    >

                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Password de usuario --}}
                <div class="mb-3">
                    <label for="password" class="mb-1 block uppercase text-gray-500 font-bold text-sm">Contraseña</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        placeholder="Ingresa tu contraseña actual" 
                        class="border p-1 w-full rounded-lg @error('password') border-red-500 @enderror"
                    >

                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Nuevo password de usuario --}}
                <div class="mb-3">
                    <label for="new_password" class="mb-1 block uppercase text-gray-500 font-bold text-sm">Nueva contraseña</label>
                    <input 
                        type="password" 
                        id="new_password" 
                        name="new_password" 
                        placeholder="Ingresa tu nueva contraseña" 
                        class="border p-1 w-full rounded-lg @error('nuevo-password') border-red-500 @enderror"
                    >

                    @if (session('mensaje'))
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ session('mensaje') }}
                        </p>
                    @endif
                </div>

                 {{-- Botón submit --}}
                <input 
                    type="submit" 
                    value="Guardar cambios"
                    class="bg-sky-600 hover:bg-sky-700 rounded-lg transition-colors cursor-pointer uppercase font-bold w-full p-2 text-white"    
                />

            </form>
        </div>
    </div>

@endsection