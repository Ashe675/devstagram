<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        $imagePath = storage_path("/app/public/posts/" . $imageName);


        // Crear la carpeta si no existe
        $directory = dirname($imagePath);

        if (!is_dir($directory)) {
            mkdir($directory, 0755, true); // true -> crea todas las carpetas necesarias
        }

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
        $imagePath = storage_path("/app/public/avatars/" . $imageName);

        // Crear la carpeta si no existe
        $directory = dirname($imagePath);

        if (!is_dir($directory)) {
            mkdir($directory, 0755, true); // true -> crea todas las carpetas necesarias
        }

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
    public function deleteAvatar($filename)
    {
        $filePath = "avatars/" . $filename;

        if (Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
            return response()->json(['message' => 'Avatar eliminado correctamente'], 200);
        }

        return response()->json(['message' => 'Archivo no encontrado'], 404);
    }

    public function deletePostImage($filename)
    {
        $filePath = "posts/" . $filename;

        if (Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
            return response()->json(['message' => 'Imagen del post eliminada', 'deleted' => true], 200);
        }

        return response()->json(['message' => 'Archivo no encontrado', 'deleted' => false], 404);
    }
}
