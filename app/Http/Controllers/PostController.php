<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index(User $user){

        $posts = $user->posts()->latest()->paginate(10);

        return view('users.profile', compact('user', 'posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        
        $data = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'required',
        ]);

        // Post::create([
        //     'title' => $data['title'],
        //     'description' => $data['description'],
        //     'image' => $data['image'],
        //     'user_id' => auth()->user()->id,
        // ]);

        //* Another way to create a post
        // $post = new Post();
        // $post->title = $data['title'];
        // $post->description = $data['description'];
        // $post->image = $data['image'];
        // $post->user_id = auth()->user()->id;
        // $post->save();

        //* Another way
        $request->user()->posts()->create([
            'title' => $data['title'],
            'description' => $data['description'],
            'image' => $data['image'],
        ]);

        return redirect()->route('posts.index', auth()->user()->username)->with('success', 'Post created successfully!');
    }

    public function show(User $user, Post $post)
    {
        return view('posts.show', compact('post', 'user'));
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        $imagePath = public_path('uploads/posts/' . $post->image);

        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        return redirect()->route('posts.index', auth()->user()->username)->with('success', 'Post deleted successfully!');
    }

}
