@extends('layouts.app')

@section('titulo')
    @auth
        Editar perfil: {{ Auth::user()->username }} 
    @endauth
@endsection

@section( 'contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <form method="POST" action="{{ route('perfil.store')}}" enctype="multipart/form-data"  class="mt-10 md:mt-0">
                @csrf
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                        Username
                    </label>
                    <input 
                        id="username"
                        name="username"
                        type="text"
                        placeholder="Nuevo nombre de usuario"
                        class="border p-3 w-full rounded-lg
                        @error('name')
                            border-red-500
                        @enderror
                        "
                        @auth
                        value="{{ Auth::user()->username}}" 
                        @endauth
                        
                    />
                    @error('username')
                        <p class="bg-red-500">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">
                        Foto de perfil
                    </label>
                    <input 
                        id="imagen"
                        name="imagen"
                        type="file"
                        class="border p-3 w-full rounded-lg"
                        value="" 
                        accept=".png, .jpg, .jpeg"
                    />
                </div>

                <input 
                    type="submit"
                    value="Guardar Cambios"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors 
                    cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
                />
            </form>
        </div>
    </div>

@endsection