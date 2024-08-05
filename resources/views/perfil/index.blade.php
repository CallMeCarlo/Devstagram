@extends("layouts.app")

@section("titulo")
    Editar Perfil: {{$user->username}}
@endsection

@section("contenido")
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white p-6">
            <form action="{{route("perfil.store")}}" enctype="multipart/form-data" method="POST" class="mt-10 md:mt-0">
                @csrf

                @if (session("mensaje"))
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                    {{ session("mensaje") }}
                </p>
                @endif

                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                            Username
                    </label>
                    <input type="text" name="username" id="username" placeholder="Tu username" class="border p-3 w-full rounded-lg @error("username") border-red-500 @enderror" value="{{auth()->user()->username}}">
                    @error("username")
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ str_replace("username", "username", $message)}}
                        </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                        Contraseña
                    </label>
                    <input type="password" name="password" id="password" placeholder="Escribe tu contraseña para cambiar de nombre de usuario" class="border p-3 w-full rounded-lg @error("name") border-red-500 @enderror">
                    @error("password")
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ str_replace("password", "contraseña", $message)}}
                        </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">
                            Imagen de Perfil
                    </label>
                    <input type="file" accept=".jpg, .jpeg, .png" name="imagen" id="imagen" class="border p-3 w-full rounded-lg">
                    @error("email")
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ str_replace("username", "username", $message)}}
                        </p>
                    @enderror
                </div>

                <input type="submit" value="Guardar Cambios" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
            </form>
        </div>
    </div>
@endsection