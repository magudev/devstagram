@extends('layouts.app')

@section('titulo')
    Editar publicación
@endsection

@section('contenido')
    
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <form method="POST" action="{{ route('posts.update', $post) }}" class="mt-10 md:mt-0">
                @csrf

                {{-- Título --}}
                <div class="mb-3">
                    <label for="titulo" class="mb-1 block uppercase text-gray-500 font-bold text-sm">Título</label> 
                    <input 
                        type="text" 
                        id="titulo" 
                        name="titulo" 
                        placeholder="Ingresa tu nombre de usuario" 
                        class="border p-1 w-full rounded-lg @error('titulo') border-red-500 @enderror"
                        value="{{ $post->titulo }}"
                    >

                    @error('titulo')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Campo descripción --}}
                <div class="mb-3">
                    <label for="descripcion" class="mb-1 block uppercase text-gray-500 font-bold text-sm">Descripción</label>
                    <textarea 
                        id="descripcion" 
                        name="descripcion" 
                        placeholder="Descripción de la publicación" 
                        class="border p-1 w-full rounded-lg @error('descripcion') border-red-500 @enderror"
                        rows="5"
                    >{{ $post->descripcion }}</textarea>

                    @error('descripcion')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{ $message }}
                    </p>
                    @enderror
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