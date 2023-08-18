<?php


namespace App\Services\ProductService\Helpers;

use App\Models\Image;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait productHelper
{
    public static function generateArticle(int $length = 8): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $randomString;
    }

    public function loadFiles(array $array): array
    {
        $images = [];
        foreach ($array as $image) {
            $images[] = $this->createProductFile($image);
        }
        return $images;
    }

    private function createFileName(UploadedFile $image): string
    {
        return Str::random(40) . '.' . $image->getClientOriginalExtension();
    }

    private function createProductFile(UploadedFile $image): Image
    {
        $fileName = $this->createFileName($image);

        $imagePath = 'images/products/' . $fileName;

        Storage::disk('public')->putFileAs('images/products',
            $image, $this->createFileName($image)
        );

        $imageModel = new Image([
            'path' => $imagePath,
            'url' => asset('storage/' . $imagePath)
        ]);

        $imageModel->save();

        return $imageModel;
    }
}
