<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {
        //Obtener a quienes seguimos
        $id = auth()->user()->following->pluck("id")->toArray();
        $post = Post::whereIn("user_id", $id)->latest()->paginate(20);

        
        return view("home", [
            "posts" => $post
        ]);
    }
}