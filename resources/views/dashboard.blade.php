@extends('layouts.app')

@section('titulo')
    {{ $user->name }}
@endsection

@section('contenido')
    
    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">

            {{-- Imagen usuario --}}
            <div class="w-8/12 lg:w-6/12 px-5">
                <img class="imagen-perfil" src="{{ $user->imagen ? asset('perfiles').'/'.$user->imagen : asset('img/usuario.svg') }}" alt="Imagen usuario">
            </div>

            {{-- Información usuario --}}
            <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center md:items-start py-10 md:py-10">
                
                <div class="flex items-center gap-2">
                    <p class="text-gray-700 text-xl">{{ $user->username }}</p>
                    @auth
                        @if ($user->id === auth()->user()->id)
                            <a href="{{ route('perfil.index') }}"
                                class="text-gray-500 hover:text-gray-600 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                </svg>
                            </a>
                        @endif
                    @endauth
                </div>

                {{-- Estadísticas --}}
                <a href="{{ route('perfil.seguidores', $user->username) }}" class="text-gray-800 text-sm mt-2 font-bold">
                    {{ $user->followers->count() }}
                    <span class="font-normal">
                        @choice('seguidor|seguidores', $user->followers->count())
                    </span>
                </a>
                <a href="{{ route('perfil.seguidos', $user->username) }}" class="text-gray-800 text-sm mt-2 font-bold">
                    {{ $user->following->count() }}
                    <span class="font-normal">
                        @choice('seguido|seguidos', $user->following->count())
                    </span>
                </a>
                <p class="text-gray-800 text-sm mt-2 font-bold">
                    {{ $user->posts->count() }}
                    <span class="font-normal">publicaciones</span>
                </p>
                
               @auth
                    @if ($user->id !== auth()->user()->id)
                        @if (!$user->siguiendo(auth()->user()))
                            <form method="POST" action="{{ route('users.follow', $user) }}">
                                @csrf
                                <input type="submit"
                                    class="bg-blue-600 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer mt-2"
                                    value="Seguir"
                                />
                            </form>
                        @else
                            <form method="POST" action="{{ route('users.unfollow', $user) }}">
                                @csrf
                                @method('DELETE')
                                <input type="submit"
                                    class="bg-red-600 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer mt-2"
                                    value="Dejar de seguir"
                                />
                            </form>
                        @endif
                    @endif    
               @endauth

            </div>
        </div>
    </div>

    {{-- Sección de publicaciones --}}
    <section class="container mx-auto mt-10">
        <h2 class="text-4xl text-center font-black my-10">Publicaciones</h2>
        
        @if ($posts->count())
            <div class="grid md:grid-cols-2 lg:grids-col-3 xl:grid-cols-4 gap-5">
                @foreach ($posts as $post)
                    <div>
                        <a href="{{ route('posts.show', ['user' => $post->user, 'post' => $post]) }}">
                            <img src="{{ asset('uploads'.'/'.$post->imagen) }}" alt="Imagen del post {{ $post->titulo }}">
                        </a>
                    </div>
                @endforeach
            </div>

            {{-- Paginación --}}
            <div class="my-10">
                {{ $posts->links('pagination::tailwind') }}
            </div>
        @else    
            <p class="text-gray-600 uppercase text-sm text-center font-bold">No hay publicaciones</p>
        @endif

    </section>

@endsection