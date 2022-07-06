<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @stack('styles')
        <link rel="stylesheet" href="{{ asset('css/app.css')}}">
        <link rel="icon" type="image/x-icon" href="{{ asset('img/icon2.ico') }}">

        <title>DevStagram - @yield('titulo')</title>
        <script src="{{ asset('js/app.js')}}" defer></script>

    </head>
    
    <body class="bg-gray-100">
        
        {{-- Header --}}
        <header class="p-2 border-b bg-white shadow">
            <div class="container mx-auto flex justify-between items-center">
                
                <a href="{{ route('home') }}" class="text-3xl font-black">DevStagram</a>

                {{-- El usuario está autenticado --}}
                @auth
                    <nav class="flex gap-5 items-center">
                        
                        <a href="{{ route('home') }}">
                            <svg class="h-6 w-6 text-gray-600" width="30" height="30" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <polyline points="5 12 3 12 12 3 21 12 19 12" />  <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />  <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>                        </a>
                        </a>

                        <a class="gap-1 flex items-center bg-white border p-2 text-gray-600 rounded text-sm uppercase font-bold cursor-pointer" href=" {{ route('posts.create') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Crear
                        </a>

                        <a class="font-normal text-gray-600 text-sm" href="{{ route('posts.index', auth()->user()->username) }}">
                            {{ auth()->user()->username }}
                        </a>

                        {{-- Para mayor seguridad en el cierre de sesión, utilizamos un formulario POST --}}
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="font-bold uppercase text-gray-600 text-sm" type="submit" href="{{ route('logout') }}">Cerrar sesión</button>
                        </form>
                    </nav>
                @endauth

                {{-- El usuario no está autenticado --}}
                @guest
                    <nav class="flex gap-5 items-center">
                        <a class="font-bold uppercase text-gray-600 text-sm" href="{{ route('login') }}">Login</a>
                        <a class="font-bold uppercase text-gray-600 text-sm" href="{{ route('register') }}">Crear cuenta</a>
                    </nav>
                @endguest
            
            </div>
        </header>

        {{-- Main --}}
        <main class="container mx-auto mt-6">
            <h2 class="font-black text-center text-2xl mb-6">
                @yield('titulo')
            </h2>
            @yield('contenido')
        </main>

        {{-- Footer --}}
        <footer class="mt-8 text-center p-3 text-gray-500 text-sm font-bold uppercase">
            DevStagram - Todos los derechos reservados {{ date('Y') }}
        </footer>
        
    </body>

</html>
