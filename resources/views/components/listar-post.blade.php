<div>
    @if ($posts->count())
    <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach ($posts as $foto)
            <div>
                <a href="{{ route('posts.show',['post'=>$foto, 'user'=>$foto->user]) }}">
                <img src="{{ asset('uploads').'/'.$foto->imagen }}" alt="Imagen del post {{ $foto->titulo }}"> 
                </a>
            </div>
        @endforeach
    </div>

    <div class="my-10">
        {{ $posts->links('pagination::tailwind') }}
    </div>
@else
    <p> No hay posts disponibles</p>
@endif

<!--
@forelse ($posts as $post)
    <h2>{{ $post -> titulo}}</h2>
@empty
    <p> No hay publicaciones disponibles</p>
@endforelse
-->

</div>