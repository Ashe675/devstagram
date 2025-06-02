<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{

    public function store(Request $request, Post $post)
    {
        $user = $request->user();
        $user->likes()->create([
            'post_id' => $post->id,
        ]);

        return back();
    }

    public function destroy(Request $request, Post $post)
    {
        $user = $request->user();
        $like = $user->likes()->where('post_id', $post->id)->first();

        if ($like) {
            $like->delete();
        }

        return back();
    }

}
