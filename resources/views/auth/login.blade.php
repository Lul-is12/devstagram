@extends('layouts.app')

@section('titulo')
 Inicia sesión en DevStagram
@endsection

@section('contenido')
    <div class="md:flex md:justify-center md:gap-10 md:items-center">
        <div class="md:w-6/12 p-5">
            <img src="{{asset('img/login.jpg')}}" alt="imagen login de usuarios">
        </div>
        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
            <form method="POST" action="{{ route('login')}}" novalidate>
                @csrf

                @if(session('mensaje'))
                    <p class="bg-red-500">{{ session('mensaje') }}</p>
                @endsession

                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                        Correo electronico
                    </label>
                    <input 
                        id="email"
                        name="email"
                        type="text"
                        placeholder="Ingresa correo electronico"
                        class="border p-3 w-full rounded-lg @error('email')
                            border-red-500
                        @enderror"
                        value="{{old('email')}}"
                    />
                    @error('email')
                        <p class="bg-red-500">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                        Contraseña
                    </label>
                    <input 
                        id="password"
                        name="password"
                        type="password"
                        placeholder="Ingresar contraseña"
                        class="border p-3 w-full rounded-lg"
                    />
                    @error('password')
                        <p class="bg-red-500">{{$message}}</p>
                    @enderror
                </div>
                
                <div class="mb-5">
                    <input type="checkbox" name="remember">
                    <label class=" text-gray-500 font-bold text-sm">
                        Mantener sesión abierta
                    </label>
                </div>

                <input 
                    type="submit"
                    value="Iniciar Sesión"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors 
                    cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
                />
            </form>
        </div>
    </div>
@endsection