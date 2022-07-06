<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    public function store(Request $request) 
    {
        // Obtenemos la imagen
        $imagen = $request->file('file');

        // Creamos un nombre único
        $nombreImagen = Str::uuid().'.'.$imagen->extension();

        // Creamos una instancia de la imagen con Intervention
        $imagenServidor = Image::make($imagen);

        // Damos el tamaño que queremos en px
        $imagenServidor->fit(1000, 1000);

        // Establecemos el path donde se va a almacenar la imagen
        $imagenPath = public_path('uploads').'/'.$nombreImagen;
        
        // Subimos la imagen
        $imagenServidor->save($imagenPath);

        // Retornamos una respuesta
        return response()->json(['imagen' => $nombreImagen]);
    }

}
