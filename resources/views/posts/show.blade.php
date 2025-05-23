@extends('layouts.app')

@section('titulo')
    {{ $post-> titulo}}
@endsection

@section('contenido')
    <div class="container mx-auto md:flex">
        <div class="md:w-1/2"> 
            <img src="{{ asset('uploads').'/'.$post->imagen }}" alt="Imagen del post {{ $post->titulo }}"> 
            
            <div class="p-3 flex items-center gap-4"> 
                @auth
                
                    @php
                        $msj = "Hola desde el template al catributo"
                    @endphp

                    <livewire:like-post :post="$post"/>
<!--
                    @if( $post->checkLike(auth()->user())) 
                        <form method="POST" action="{{ route('posts.likes.destroy', $post) }}">
                            @method('DELETE')
                            @csrf
                            <div class="my-4">
                                <button type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="blue" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                    </svg> 
                                </button>
                            </div>
                        </form>
                    @else
                        <form method="POST" action="{{ route('posts.likes.store', $post) }}">
                            @csrf
                            <div class="my-4">
                                <button type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                    </svg> 
                                </button>
                            </div>
                        </form>
                    @endif
-->
                @endauth
                <!--<p class="font-bold"> {{ $post->likes->count()}}  <span class="font-normal">likes   / </span>  {{$post->comentarios->count()}} <span class="font-normal"> comentarios </span></p> -->
            </div>

            <div>
                <p class="font-bold"> {{ $post->user->username}} </p>
                <p>  {{ $post-> descripcion}} </p>
                <p class="text-sm mt-5 text-gray-500"> 
                    {{ $post ->created_at -> diffForHumans() }}
                </p>
            </div>

            @auth
                @if($post->user_id === auth()->user()->id)
                    <form method="POST" action="{{route('posts.destroy', $post )}}">
                        @method('DELETE') <!-- METHOD SPOOFING -->
                        @csrf
                        <input 
                            type="submit"
                            value="Eliminar publicacion"
                            class="bg-red-500 hover:bg-red-600 p-2
                            rounded text-white font-bold mt-4 cursor-pointer"
                        />
                    </form>
                @endif
            @endauth
        </div>

        <div class="md:w-1/2 p-5"> 

            <div class="bg-white shadow mb-5 mx-h-96 overflow-y-scroll"> <!-- Ver los comentarios -->
                @if($post->comentarios->count())
                    @foreach ($post->comentarios as $comentario)
                        <div class="p-5 border-gray-300 border-b">
                            <a class="font-bold"  href="{{ route('post.index', $comentario->user) }}">{{ $comentario->user->username }} </a>
                            <p>{{ $comentario->comentario }}</p>
                            <p class="text-sm text-gray-500">{{ $comentario->created_at->diffForHumans() }}</p>
                        </div>
                    @endforeach
                @else
                <label for="comentario" class="mb-2 mt- 5 block text-gray-500 font-bold">
                    Sin comentarios.
                </label>
                @endif
            </div>

            <div class="shadow bg-white p-5 mb-5"> <!-- Escribir comentarios -->
                
                @if(auth()->user()) <!-- Si la persona tiene cuenta puede subir su comentario -->
                    <p class="text-xl font-bold text-center mb-4"> agregar comentario</p>
                    
                    <form action="{{ route('comentarios.store',['post'=>$post,'user'=>$user]) }}" method="POST">
                        @csrf
                        <div class="mb-5">
                            <!--
                            <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">
                                comentario
                            </label> -->
                            <textarea
                                id="comentario"
                                name="comentario"
                                placeholder="Escribir comentario"
                                class="border p-3 w-full rounded-lg
                                @error('comentario')
                                    border-red-500
                                @enderror
                                "
                            ></textarea>
                            @error('comentario')
                                <p class="bg-red-500">{{$message}}</p>
                            @enderror
                        </div>

                        <input 
                            type="submit"
                            value="Subir comentario"
                            class="bg-sky-600 hover:bg-sky-700 transition-colors 
                            cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
                        />

                    </form>
                @else <!-- Mensaje mostrado a -->
                    <p class="text-l font-bold text-center mb-4"> NO PUEDES AGREGAR COMENTARIOS</p>
                    <label for="comentario" class="mb-2 mt- 5 block text-gray-500 font-bold">
                        Para poder comentar esta publicacion favor de iniciar sesión.
                    </label>
                @endif
             
            </div>
        </div>
    </div>

    
@endsection