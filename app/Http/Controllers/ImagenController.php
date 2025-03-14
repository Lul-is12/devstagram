<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image; //funciones de un unico proposito

class ImagenController extends Controller
{
    //
    public function store(Request $request){
        //$input = $request->all();
        $imagen = $request->file('file');

        $nombreImagen = Str::uuid() . "." . $imagen->extension();

        $imagenServidor= Image::make($imagen);

        $imagenServidor->fit(1000,1000); //Documentaciones de Intervention/image

        $imagenPath = public_path('uploads').'/'.$nombreImagen;
        // "uploads/12342342342334.jpg"

        $imagenServidor->save($imagenPath);

        return response()->json(['imagen'=>$nombreImagen]);
    }
}
