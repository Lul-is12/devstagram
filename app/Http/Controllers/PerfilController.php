<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Foundation\Validation\ValidatesRequests;

class PerfilController extends Controller
{
    public function index(){
        return view('perfil.index');
    }

    use ValidatesRequests;
    public function store(Request $request){

        //Modificar el request
        $request->request->add(['username'=>Str::slug($request->username)]);

        $this->validate($request,[
            'username'=>['required','unique:users,username,'.Auth::user()->id,'min:6','max:15',
            'not_in:wwe,twitter,editar-perfil'],  
        ]);

        if($request->imagen){
            $imagen = $request->file('imagen');

            $nombreImagen = Str::uuid() . "." . $imagen->extension();
    
            $imagenServidor= Image::make($imagen);
    
            $imagenServidor->fit(1000,1000); //Documentaciones de Intervention/image
    
            $imagenPath = public_path('perfiles').'/'.$nombreImagen;
            
            $imagenServidor->save($imagenPath);

        } 

        //Guardar Cambios
        $usuario = User::find(Auth::user()->id);
        $usuario->username = $request->username;
        $usuario->imagen = $nombreImagen ?? Auth::user()->imagen ?? '';
        $usuario->save();

        //redireccionar
        return redirect()->route('post.index',$usuario->username);




    }
}
