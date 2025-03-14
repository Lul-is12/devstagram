<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    //
    public function index() 
    {
        return view('auth.register');
    }

    use ValidatesRequests;

    public function store(Request $request)
    {
        //dd($request);
        //dd($request->get('email'));

        //Modificar el request
        $request->request->add(['username'=>Str::slug($request->username)]);


        //Validacion
        $this->validate($request,[
            'name'=>'required|max:20',
            'username'=>['required','unique:users','min:6','max:15'],
            'email'=>'required|unique:users|email|max:30',
            'password'=>'required|confirmed|min:6'
        ]);

        //dd('Creando usuario...');

        //creando registros
        User::create([
                'name'=>$request->name,
                'username'=>$request->username,
                'email'=>$request->email,
                'password'=>$request->password,
                //'password'=> Hash::make($request->password)
            ]
        );

        //autenticar usuario
        //if(Auth::attempt([
        //    'email'=>$request->email,
        //    'password'=>$request->password
        //])) {

        //    return redirect()->route('post.index');

        // }

        //Otra forma de autenticar
        if(Auth::attempt($request->only('email','password'))) {

            return redirect()->route('post.index');

        }

        
    }

}
