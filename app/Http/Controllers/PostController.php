<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{

    // Inicia una instancia de sesión de autenticación 
    public function __construct()
    {
        $this->middleware('auth')->except('show', 'index');
    }

    // Perfil usuario
    public function index(User $user)
    {
        // Filtramos las publicaciones de un perfil
        $posts = Post::where('user_id', $user->id)->latest()->paginate(8);  

        return view('dashboard', [
            'user' => $user,
            'posts' => $posts
        ]);
    } 

    // Crear la estructura de una publicación
    public function create()
    {
        return view('posts.create');
    }

    // Almacenar la publicación en la BD
    public function store(Request $request) 
    {
        $this->validate($request, [
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required'
        ]);

        // Post::create([
        //     'titulo' => $request->titulo,
        //     'descripcion' => $request->descripcion,
        //     'imagen' => $request->imagen,
        //     'user_id' => auth()->user()->id
        // ]);

        // Otra forma
        // $post = new Post;
        // $post->titulo = $request->titulo;
        // $post->descripcion = $request->descripcion;
        // $post->imagen = $request->imagen;
        // $post->user_id = auth()->user()->id;
        // $post->save();

        // Otra forma más utilizando relaciones
        $request->user()->posts()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('posts.index', auth()->user()->username);

    }

    // Ver detalles de una publicación
    public function show(User $user, Post $post) 
    {
        return view('posts.show', [
            'user' => $user,
            'post' => $post
        ]);
    }

    // Eliminar una publicación
    public function destroy(Post $post) 
    {
        $this->authorize('delete', $post);
        $post->delete();

        // Eliminar imagen
        $imagen_path = public_path('uploads/'.$post->imagen);
        if (File::exists($imagen_path)) {
            unlink($imagen_path);
        }

        return redirect()->route('posts.index', auth()->user()->username);
    }

    // Editar una publicación
    public function edit(Post $post)
    {
        if ($post->user_id != auth()->user()->id) {
            return redirect()->route('home');
        }

        return view('posts.edit', ['post' => $post]);
    }

    public function update(Request $request, Post $post)
    {
        $this->validate($request, [
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
        ]);

        $post = Post::find($post->id);

        $post->titulo = $request->titulo;
        $post->descripcion = $request->descripcion;

        $post-> save();

        return view('posts.show', [
            'user' => auth()->user(),
            'post' => $post
        ]);
    }

}
