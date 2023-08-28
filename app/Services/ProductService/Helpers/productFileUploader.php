<?php


namespace App\Services\ProductService\Helpers;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Database\Eloquent\Concerns\QueriesRelationships;
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

    private function createProductFile(?UploadedFile $image, Product $product, $isPreview = false): ?Image
    {
        if ($image === null) {
            return null;
        }

        $fileName = $this->createFileName($image);

        $imagePath = 'images/products/' . $fileName;

        Storage::disk('public')->putFileAs('images/products',
            $image, $this->createFileName($image)
        );

        return $this->createNewImageModel($imagePath, $product, $isPreview);
    }

    private function createNewImageModel(string $imagePath, Product $product, $isPreview = false): Image
    {
        $imageUrl = 'storage/' . $imagePath;

        $imageModel = new Image([
            'path' => $imagePath,
            'url' => asset($imageUrl),
            'product_id' => $product->id
        ]);

        if ($isPreview) $product->update([
            'preview_image_path' => $imagePath,
            'preview_image_url' => $imageUrl
        ]);

        $imageModel->save();

        return $imageModel;
    }
}
