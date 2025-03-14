<?php

namespace App\Http\Controllers;

use App\Models\Post;
//use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Validation\ValidatesRequests;

class PostController extends Controller
{
    //Proteger el endpoit

    public function index(User $user){
        //dd('desde el muro');
        //dd($user = Auth::user());

        //GET of BD
        $posts = Post::where('user_id',$user->id)->latest()->paginate(6);

        return view('dashboard',[
            'user'=>$user,
            'posts' => $posts
        ]);
    }

    public function create(){
        //Poder visualiza una vista
        return view('posts.create');
    }


    use ValidatesRequests; //Para validar los campos
        
    public function store(Request $request){
        //almacena en la base de datos
        //dd('creando publicacion...');
        $this-> validate($request, [
            'titulo' => 'required|max:25',
            'descripcion' => 'required|max:100',
            'imagen' =>'required'
        ]);

        // Post::create([
        //     'titulo'=> $request-> titulo,
        //     'descripcion' => $request->descripcion,
        //     'imagen'=> $request -> imagen,
        //     'user_id'=> Auth::user()->id
        // ]);

        //Otra forma de crear registros
        //$post = new Post;
        //$post -> titulo = $request->titulo;
        //$post -> descripcion = $request->descripcion;
        //$post -> imagen = $request->imagen;
        //$post -> user_id = $request->user_id;
        //$post -> save();

        //---Otra forma de crear registro ya teniendo relaciones---
        $request->user()->posts()->create([
            'titulo'=> $request-> titulo,
            'descripcion' => $request->descripcion,
            'imagen'=> $request -> imagen,
            'user_id'=> Auth::user()->id
        ]);

        return redirect()->route('post.index',Auth::user()->username);
    }

    public function show(User $user, Post $post){
        return view('posts.show',
            ['post'=> $post,
            'user'=>$user]
        );
    }

    public function destroy(Post $post){

        Gate::authorize('delete',$post);
        $post -> delete();

        //eliminar la imagen
        $imagen_path = public_path('uploads/'.$post->imagen);

        if(File::exists($imagen_path)){
            unlink($imagen_path);
        }

        return redirect()->route('post.index', Auth::user()->username);

    }
}

