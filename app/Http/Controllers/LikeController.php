<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function like(Request $request)
    {
        if (Auth::check()) {
            $user_id = auth()->user()->id;
            $post_id = $request->post_id;
            $liked = like::where('user_id', $user_id)->where('post_id', $post_id)->first();
            if ($liked) {
                return back()->with('error', 'Already Liked.');
            }
            Like::create([
                'user_id' => $user_id,
                'post_id' => $post_id,
            ]);
            return back();
        }
        return redirect('login')->with('error', 'First, Login to your account.');
    }

    public function unlike(Request $request)
    {
        if (Auth::check()) {
            $user_id = auth()->user()->id;
            $post_id = $request->post_id;
            $liked = like::where('user_id', $user_id)->where('post_id', $post_id)->first();
            if ($liked) {
                $liked->delete();
                return back();
            }
            return back()->with('error', 'Already Unliked.');
        }
        return redirect('login')->with('error', 'First, Login to your account.');
    }
}
