<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function publish(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'post' => 'required|max:255',
        ]);
        Post::create([
            'user_id' => $request->user_id,
            'body' => $request->post,
        ]);
        return back()->with('success', 'Post Added Successfully . . . !');
    }

    public function delete(Request $request)
    {
        $delete_this_post = Post::find($request->post_id);
        $deleted = $delete_this_post->delete();
        if ($deleted) {
            return back()->with('success', 'Your post has been deleted.');
        }else{
            return back()->with('error', 'Your post has not been deleted.');
        }
    }
}
