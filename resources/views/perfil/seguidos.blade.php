@extends('layouts.app')

@section('titulo')
    Seguidos de {{ $user->username }}
@endsection

@section('contenido')
    <div class="container justify-center">
        
        <div class="w-6/12 justify-center mx-auto items-center bg-white p-5">
            
            {{-- DIV SEGUIDORES --}}
            <div class="p-3 border-gray-300 text-sm">
             @if ($seguidos->count())
                @foreach ($seguidos as $seguido)

                    {{-- DIV SEGUIDOR --}}
                    <div class="p-3 border-gray-300 border-b text-sm flex">

                        {{-- IMAGEN SEGUIDOR --}}
                        <div class="md:w-1/12">
                            <a href="{{ route('posts.index', $seguido->username)}}">
                                <img class="imagen-perfil h-8 w-8" src="{{ $seguido->imagen ? asset('perfiles').'/'.$seguido->imagen : asset('img/usuario.svg') }}" alt="Imagen usuario">
                            </a>
                        </div>

                        {{-- NOMBRE SEGUIR Y BOTÓN SEGUIR --}}
                        <div class="md:w-11/12 flex justify-between items-center">
                            <a href="{{ route('posts.index', $seguido->username)}}" class="font-bold">
                                {{ $seguido->username }}
                            </a>

                            @auth
                                @if ($seguido->id !== auth()->user()->id)
                                    @if (!$seguido->siguiendo(auth()->user()))  
                                        <form method="POST" action="{{ route('users.follow', $seguido) }}">
                                            @csrf
                                            <input type="submit"
                                                class="bg-blue-600 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer"
                                                value="Seguir"
                                            />
                                        </form>
                                    @else
                                        <form method="POST" action="{{ route('users.unfollow', $seguido) }}"> 
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit"
                                                class="bg-red-600 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer"
                                                value="Dejar de seguir"
                                            />
                                        </form>
                                    @endif
                                @endif    
                            @endauth

                        </div>
                    </div>

                @endforeach
            @else
                <p class="text-center">¡{{$user->username}} no sigue a nadie!</p>
            @endif
            </div>

        </div>
        
@endsection