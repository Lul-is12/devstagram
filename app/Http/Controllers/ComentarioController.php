<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comentario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Validation\ValidatesRequests;

class ComentarioController extends Controller
{   
    use ValidatesRequests;

    public function store(Request $request, User $user, Post $post){
        //Validar comentario
        $this->validate($request,[
            'comentario'=>'required|max:50',
        ]);
        //almacenar comentario
        Comentario::create([
            'user_id' =>Auth::user()->id,
            'post_id' => $post->id,
            'comentario'=> $request->comentario,
        ]);
        //imprimir mensaje
        return back(); //->with('mensaje', 'Comentario publicado');
    }
}
