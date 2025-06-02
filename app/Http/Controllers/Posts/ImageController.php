<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Imagick\Driver;
use Intervention\Image\ImageManager;

class ImageController extends Controller
{
    //
    public function store(Request $request)
    {
        // Validate the request data
        // $request->validate([
        //     'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        // ]);

        $image = $request->file('file');

        $imageName = Str::uuid() . '.' . $image->extension();

       // Crear el path final
        $imagePath = public_path("uploads/posts/" . $imageName);

        // Crear instancia del manager con el driver GD
        $manager = new ImageManager(new Driver());

        // Abrir la imagen
        $serverImage = $manager->read($image);

        // Redimensionarla (máximo 1000x1000)
        $serverImage->cover(width: 1000, height: 1000);

        // Guardarla en el servidor
        $serverImage->save($imagePath);

        // Store the image in the public storage
        // $path = $request->file('image')->store('images', 'public');

        // Return the path of the stored image
        return response()->json(['image' => $imageName], 201);
    }


    public function storeAvatar(Request $request, $user)
    {
        

        $image = $request->file('file');

        $imageName = Str::uuid() . '.' . $image->extension();

        // Crear el path final
        $imagePath = public_path("uploads/avatars/" . $imageName);

        // Crear instancia del manager con el driver GD
        $manager = new ImageManager(new Driver());

        // Abrir la imagen
        $serverImage = $manager->read($image);

        // Redimensionarla (máximo 1000x1000)
        $serverImage->cover(width: 1000, height: 1000);

        // Guardarla en el servidor
        $serverImage->save($imagePath);

        return response()->json(['image' => $imageName], 201);
    }
}
