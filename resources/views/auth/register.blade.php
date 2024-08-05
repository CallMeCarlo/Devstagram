@extends('layouts.app')

@section('titulo')
    Registrate en DevStagram
@endsection

@section('contenido')
    <div class="md:flex md:justify-center md:gap-12 md:items-center">
        <div class="md:w-6/12 p-5">
            <img src="{{asset("img/registrar.jpg")}}" alt="Registrandonos">
        </div>
        <div class="md:w-6/12 bg-white p-6 rounded-lg shadow-xl">
            <form action="{{route("register")}}" method="POST">
                @csrf
                <div class="mb-5">
                    <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">
                        Nombre
                    </label>
                    <input type="text" name="name" id="name" placeholder="Tu nombre" class="border p-3 w-full rounded-lg @error("name") border-red-500 @enderror" value="{{old('name')}}">
                    @error("name")
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ str_replace("name", "nombre", $message)}}
                        </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                        Username
                    </label>
                    <input type="text" name="username" id="username" placeholder="Tu nombre de usuario" class="border p-3 w-full rounded-lg @error("name") border-red-500 @enderror">
                    @error("username")
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ str_replace("username", "usuario", $message)}}
                        </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                        Email
                    </label>
                    <input type="email" name="email" id="email" placeholder="Tu email" class="border p-3 w-full rounded-lg @error("name") border-red-500 @enderror" value="{{old('email')}}">
                    @error("email")
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ str_replace("email", "email", $message)}}
                        </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                        Contraseña
                    </label>
                    <input type="password" name="password" id="password" placeholder="Tu contraseña" class="border p-3 w-full rounded-lg @error("name") border-red-500 @enderror">
                    @error("password")
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ str_replace("password", "contraseña", $message)}}
                        </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">
                        Repetir Contraseña
                    </label>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Repite tu contraseña" class="border p-3 w-full rounded-lg">
                </div>

                <input type="submit" value="Crear Cuenta" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
            </form>
        </div>
    </div>
@endsection
