<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class PerfilController extends Controller
{
    public function index(User $user) 
    {
        return view("perfil.index", [
            "user" => $user
        ]);
    }

    public function store(Request $request) 
    {

        //Modificar el request
        $request->request->add(["username" => Str::slug($request->username)]);

        //Valdación
        $validated = $request->validate([
            "username" => [
                "required",
                // "unique:users,username,{auth()->user()->username}", 
                Rule::unique('users', 'username')->ignore(auth()->user()->id),
                "min:4",
                "max:20",
                "not_in:editar-perfil,puto"
            ],
            "password" => ""
        ]);

        if(!($validated["username"] === auth()->user()->username) || $request->imagen) {

        if($request->imagen) {
            $imagen = $request->file('imagen');
 
            $nombreImagen = Str::uuid() . "." . $imagen->extension();
    
            $manager = new ImageManager(new Driver()); // Instancia el manager
            $imagenServidor = $manager->read($imagen); // Lee la imagen
            $imagenServidor->resize(1000, 1000);       // Le hace el resize 
    
            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;
            $imagenServidor->save($imagenPath);

        }

        if(!Hash::check($validated["password"], auth()->user()->password)) {
            return back()->with("mensaje", "Contraseña incorrecta");
        } else {

        //Guardar cambios
        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? "";

        $usuario->save();

        //Reedireccionar
        return redirect()->route("post.index", $usuario->username);
        }

    } else return redirect()->route("post.index", auth()->user()->username);

    }
}
