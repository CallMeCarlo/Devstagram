@extends("layouts.app")

@section("titulo")
    {{$post->titulo}}
@endsection

@section("contenido")

<div class="container mx-auto md:flex">
    <div class="md:w-1/2">
        <img src="{{asset("uploads") . "/" . $post->imagen}}" alt="Imagen del post">
        <div class="p-3 flex items-center gap-2">
            @auth
                <livewire:like-post :post="$post"/>  
            @endauth
            
        </div>
        <div>
            <p class="font-bold">{{$post->user->username}}</p>
            <p class="text-sm text-gray-500">{{$post->created_at->diffForHumans()}}</p>
            <p class="mt-5">
                {{$post->descripcion}}
            </p>
        </div>
        @auth
            @if ($post->user_id === auth()->user()->id)
            <form method="POST" action="{{route("post.destroy", $post)}}">
                @method("DELETE")
                @csrf
                <input type="submit" value="Eliminar publicacion" class="bg-red-600 hover:bg-red-700 transition-colors cursor-pointer uppercase font-bold mt-4 p-3 text-white rounded-lg">
            </form>
            @endif
        @endauth
    </div>
        <div class="md:w-1/2 p-5">
                <div class="shadow bg-white p-5 mb-5">
                    @auth
                    <p class="text-xl font-bold text-center mb-4">Agrega un nuevo comentario</p>
                    <form action="{{route("comentarios.store", ["post" => $post, "user" => $user])}}" method="POST">
                        @csrf
                            @if (session("mensaje"))
                                <p class="bg-green-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                                    {{ session("mensaje") }}
                                </p>
                            @endif
                        <div class="mb-5">
                            <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">
                                Comentario
                            </label>
                            <textarea placeholder="Añade un comentario" name="comentario" id="comentario" class="border p-3 w-full rounded-lg @error("comentario") border-red-500 @enderror"></textarea>
                            @error("comentario")
                                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                                    {{ $message}}
                                </p>
                            @enderror
                        </div>

                        <input type="submit" value="Añadir Comentario" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
                    </form>
                    @endauth

                    <div class="bg-white shadow mb-5 max-h-96 overflow-y-scroll mt-10">
                        @if ($post->comentarios->count() > 1)
                            @foreach ($post->comentarios as $comentario)
                            <div class="p-5 border-gray-300 border-b">
                                <a href="{{route("post.index", $comentario->user->username)}}" class="font-bold">{{$comentario->user->username}}</a>
                                <p>{{$comentario->comentario}}</p>
                                <p class="text-sm text-gray-500">{{$comentario->created_at->diffForHumans()}}</p>
                            </div>
                            @endforeach
                        @else
                            <p class="text-center p-10"> Aún no hay comentarios </p>
                        @endif
                    </div>

                </div>
        </div>
</div>


@endsection