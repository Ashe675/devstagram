<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function edit()
    {
        $user = auth()->user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {

        $user = User::findOrFail(auth()->user()->id);

        $data = $request->validate([
            'username' => ['required', 'string', 'min:3', 'max:20', 'unique:users,username,' . $user->id, 'not_in:editar-perfil'],
            'image' => 'nullable|string',
        ]);

        if ($data['image']) {
            $image = $data['image'];
        }

        $user->username = $data['username'];
        if (isset($image)) {
            $user->avatar = $image;
        }
        $user->save();

        return redirect()->route('posts.index', $user->username)->with('success', 'Profile updated successfully.');
    }
}
