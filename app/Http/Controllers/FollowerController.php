<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\returnCallback;

class FollowerController extends Controller
{
    public function store(User $user, Request $request){

        //$user: perfil que queremos seguir
        
        $user->followers()->attach(Auth::user()->id);
        // $Modelo->Metodo()->attach nos sirve para relaciones muchos a muchos
        return back();
    }

    public function destroy(User $user, Request $request){
        
        $user->followers()->detach(Auth::user()->id);

        return back();
    }
}
