<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function user(Request $request, $id)
    {
        $user = User::where('id', $id)->first();
        $posts = Post::where('user_id', $id)->get();
        
        return view('pages.user', [
            'user' => $user,
            'posts' => $posts
        ]);
    }
}
