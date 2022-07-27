<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function home()
    {
        $allposts = Post::orderBy('created_at', 'desc')->get();
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        return view('pages.home', [
            'posts' => $posts,
            'allposts' => $allposts
        ]);
    }

    public function dashboard()
    {
        if (Auth::check()) {
            $user_id = auth()->user()->id;
            $allposts = Post::orderBy('created_at', 'desc')->where('user_id', $user_id)->get();
            $posts = Post::orderBy('created_at', 'desc')->where('user_id', $user_id)->paginate(10);
            return view('pages.dashboard', [
                'posts' => $posts,
                'allposts' => $allposts
            ]);
        }

        return redirect('login')->with('error', 'First, Login to your account.');
    }

    public function login()
    {
        return view('pages.login');
    }

    public function register()
    {
        return view('pages.register');
    }
}
