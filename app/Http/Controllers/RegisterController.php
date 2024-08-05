<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index() 
    {
        return view('auth.register');
    }

    public function store(Request $request) 
    {
        //dd($request);

        $validated = $request->validate([
            "username" => "required|unique:users|min:4|max:20"
        ]);

        //Modificar el request
        $request->request->add(["username" => Str::slug($validated["username"])]);

        //Valdación
        $validated = $request->validate([
            "name" => "required|max:30",
            "username" => "required|unique:users|min:4|max:20",
            "email" => "required|unique:users|email|max:60",
            "password" => "required|confirmed|min:6",
        ]);

        

        User::create([
            'name' => $validated["name"],
            'username' => $validated["username"],
            'email' => $validated["email"],
            'password' => $validated["password"],
        ]);

        //Autenticar un usuario
        auth()->attempt([
            "email" => $validated["email"],
            "password" => $validated["password"]
        ]);

        //Redireccionamos
        return redirect()->route("post.index", $validated["username"]);

    }
}
