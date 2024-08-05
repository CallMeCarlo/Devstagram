<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Follower;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function store(User $user, Request $request)
    {
        // Crear la relación de seguidor
        $follower = new Follower();
        $follower->user_id = $user->id;
        $follower->follower_id = $request->user()->id;
        $follower->save();

        return back();
    }

    public function destroy(User $user, Request $request) 
    {
        // Eliminar la relación de seguimiento
        $user->followers()->detach($request->user()->id);
        return back();
    }
}
