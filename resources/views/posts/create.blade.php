@extends('layouts.app')

@section('titulo')
    Crea una nueva publicación
@endsection

<!-- importaciones para el dropzone-->
@push('styles')
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
@endpush

@push('scripts')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@section('contenido')

    <div class="md:flex md:items-center">
        <div class="md:w-1/2 px-10"> 
            <form action="{{route('imagenes.store')}}"  method="POST" enctype="multipart/form-data" id="dropzone" class="dropzone border-dashed border-2 w-full h-96 rounded flex
            flex-col justify-center items-center">
                @csrf
            </form>        
        </div>
        <div class="md:w-1/2 p-10 bg-white rounded-lg shadow-xl mt-10 md:mt-0"> 
            <form action="{{route('post.store')}}" method="POST">
                @csrf
                <div class="mb-5">
                    <label for="titulo" class="mb-2 block uppercase text-gray-500 font-bold">
                        Titulo
                    </label>
                    <input 
                        id="titulo"
                        name="titulo"
                        type="text"
                        placeholder="Agrega un titulo a la publicacion"
                        class="border p-3 w-full rounded-lg
                        @error('titulo')
                            border-red-500
                        @enderror
                        "
                        value="{{old('titulo')}}"
                    />
                    @error('titulo')
                        <p class="bg-red-500">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="descripcion" class="mb-2 block uppercase text-gray-500 font-bold">
                        Descripción
                    </label>
                    <textarea
                        id="descripcion"
                        name="descripcion"
                        placeholder="Agrega una descripción"
                        class="border p-3 w-full rounded-lg
                        @error('descripcion')
                            border-red-500
                        @enderror
                        "
                    >{{old('descripcion')}}</textarea>
                    @error('descripcion')
                        <p class="bg-red-500">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <input  
                        name="imagen" 
                        type="hidden"
                        value="{{ old('imagen') }}"
                    />
                    @error('imagen')
                        <p class="bg-red-500">{{$message}}</p>
                    @enderror
                </div>


                <input 
                    type="submit"
                    value="Subir imagén"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors 
                    cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
                />
            </form>
        </div>
    </div>
    <!--Script de Dropzone-->
    <script>
        Dropzone.autoDiscover = false;
        const dropzone = new Dropzone('#dropzone',{
            dictDefaultMessage:'Subir aquí tu imagen',
            acceptedFiles:".png, .jpg, .jpeg, .gif",
            addRemoveLinks: true,
            dictRemoveFile:'Borrar archivo',
            maxFiles:1,
            uploadMultiple: false,

            init: function(){
                console.log("Dropzone cargado")
                const imagenInput = document.querySelector('[name="imagen"]');

                if( imagenInput && imagenInput.value.trim()){
                    const imagenPublicada = {}
                    imagenPublicada.size = 1234;
                    imagenPublicada.name = imagenInput.value;

                    this.options.addedfile.call(this, imagenPublicada);
                    this.options.thumbnail.call(this, imagenPublicada,`/uploads/${imagenPublicada.name}`)

                    if (imagenPublicada.previewElement) {
                        imagenPublicada.previewElement.classList.add("dz-success", "dz-complete");
                    }
                } 
            }
        });

        //dropzone.on('sending',function(file,xhr,formData){ console.log(file)  })
        dropzone.on('success',function(file ,response){
            document.querySelector('[name="imagen"]').value = response.imagen
        })
        //dropzone.on('error',function(file,message){ console.log(message) })
        dropzone.on('removedfile',function(){ document.querySelector('[name="imagen"]').value = ''})

    </script>
@endsection