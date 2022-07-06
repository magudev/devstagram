@extends('layouts.app')

@section('titulo')
    Crea una nueva publicación 
@endsection

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@section('contenido')
    <div class="md:flex md:items-center">

        {{-- Dropzone --}}
        <div class="md:w-6/12 px-10">
            <form action="{{ route('imagenes.store') }}" method="POST" enctype="multipart/form-data" id="dropzone" 
                class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center">
                @csrf
            </form>
        </div>

        {{-- Formulario --}}
        <div class="md:w-6/12 px-10 bg-white p-5 rounded-lg shadow-xl mt-10 md:mt-0">
            <form action="{{ route('posts.store') }}" method="POST" novalidate> {{-- novalidate → deshabilita validación de HTML5 --}}
                @csrf

                {{-- Campo título --}}
                <div class="mb-3">
                    <label for="titulo" class="mb-1 block uppercase text-gray-500 font-bold text-sm">Título</label>
                    <input 
                        type="text" 
                        id="titulo" 
                        name="titulo" 
                        placeholder="Título de la publicación" 
                        class="border p-1 w-full rounded-lg @error('titulo') border-red-500 @enderror"
                        value={{ old('titulo') }}
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
                    >{{ old('descripcion') }}</textarea>

                    @error('descripcion')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
                
                {{-- Imagen --}}
                <div class="mb-5">
                    <input 
                        name="imagen" 
                        type="hidden"
                        value="{{ old('imagen') }}"
                    />

                    @error('imagen')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                {{-- Botón submit --}}
                <input 
                    type="submit" 
                    value="Crear publicación"
                    class="bg-sky-600 hover:bg-sky-700 rounded-lg transition-colors cursor-pointer uppercase font-bold w-full p-2 text-white"    
                />

            </form>
        </div>
    </div>
@endsection