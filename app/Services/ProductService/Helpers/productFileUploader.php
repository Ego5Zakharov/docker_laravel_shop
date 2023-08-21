<?php


namespace App\Services\ProductService\Helpers;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait productFileUploader
{
    private function createFileName(UploadedFile $image): string
    {
        return Str::random(40) . '.' . $image->getClientOriginalExtension();
    }

    public function loadFiles(array $array, Product $product): array
    {
        $images = [];
        foreach ($array as $image) {
            $images[] = $this->createProductFile($image, $product);
        }
        return $images;
    }

    private function createProductFile(UploadedFile $image, Product $product): Image
    {
        $fileName = $this->createFileName($image);

        $imagePath = 'images/products/' . $fileName;

        Storage::disk('public')->putFileAs('images/products',
            $image, $this->createFileName($image)
        );

        $imageModel = new Image([
            'path' => $imagePath,
            'url' => asset('storage/' . $imagePath),
            'product_id' => $product->id
        ]);

        $imageModel->save();

        return $imageModel;
    }
}
