<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//Para validar datos del formulario:
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function index(){
        return view ('auth.login');
    }

    use ValidatesRequests;

    public function store(Request $request){
        //Validacion del formulario
        $this->validate($request,[
            'email'=>'required|email',
            'password'=>'required'
        ]);

        //Otra forma de autenticar
        if(Auth::attempt($request->only('email','password'),$request->remember)) {

            return redirect()->route('post.index', Auth::user()->username);

        } else{
            //dd('Alguno de los datos ingresados fue erroneo');
            return back()->with('mensaje','Credenciales incorrectas');
        }
    }
}
