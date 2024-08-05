<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PostController extends Controller
{
    use AuthorizesRequests;

    public function index(User $user) 
    {
        
        $posts = Post::where("user_id", $user->id)->latest()->paginate(20);

        return view("dashboard", [
            "user" => $user,
            "posts" => $posts
        ]);
    }

    public function create() 
    {
        return view("post.create");
    }

    public function store(Request $request) 
    {
        //Valdación
        $validated = $request->validate([
            "titulo" => "required|max:255|",
            "descripcion" => "required",
            "imagen" => "required"
        ]);

        $userId = auth()->user()->id;

        // Post::create([
        //     "titulo" => $validated["titulo"],
        //     "descripcion" => $validated["descripcion"],
        //     "imagen" => $validated["imagen"],
        //     "user_id" => $userId
        // ]);

        //Otra forma de crear registro
        // $post = new Post;
        // $post->titulo = $validated["titulo"];
        // $post->descripcion = $validated["descripcion"];
        // $post->imagen = $validated["imagen"];
        // $post->user_id = $userId;

        //Tercera forma de crear
        $request->user()->post()->create([
            "titulo" => $validated["titulo"],
             "descripcion" => $validated["descripcion"],
             "imagen" => $validated["imagen"],
             "user_id" => $userId
        ]);

        return redirect()->route("post.index", auth()->user()->username);
    }

    public function show(User $user, Post $post) 
    {
        return view("post.show", [
            "post" => $post,
            "user" => $user
        ]);
    }

    public function destroy(User $user, Post $post)
    {
        $this->authorize("delete", $post);
        $post->delete();

        //Eliminar la imagen
        $imagen_path = public_path("uploads/" . $post->imagen);

        if(File::exists($imagen_path)) {
            unlink($imagen_path);
        }

        return redirect()->route("post.index", auth()->user()->username);
    }

}
