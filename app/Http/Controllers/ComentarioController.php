<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;

class ComentarioController extends Controller
{
    public function store(Request $request, User $user, Post $post)
    {
        //Validar
        $validated = $request->validate([
            "comentario" => "required|max:255"
        ]);

        $userId = auth()->user()->id;
        $postId = $post->id;

        //Almacenar
        Comentario::create([
            "user_id" => $userId,
            "post_id" => $postId,
            "comentario" => $validated["comentario"],
        
         ]);

        //Mostrar un mensaje
        return back()->with("mensaje", "Comentario creado correctamente");
    }
}
