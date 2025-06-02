<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function store(Request $request, User $user,Post $post)
    {
        $data = $request->validate([
            'comment' => 'required|max:255',
        ]);
       
        $request->user()->comments()->create([
            'post_id' => $post->id,
            'comment' => $data['comment'],
        ]);

        return back();
    }
}
