<?php

namespace App\Services\ProductService\Helpers;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait productFileUploader
{
    private ?UploadedFile $image = null;

    private string $imagePath;
    private string $fileName;
    private bool $isPreview = false;

    private function generateFileName(): string
    {
        $this->fileName = Str::random(40) . '.' . $this->image->getClientOriginalExtension();
        return $this->fileName;
    }

    private function loadFiles(?array $array, Product $product): bool|array
    {
        if (!isset($array)) {
            return false;
        }
        $images = [];
        foreach ($array as $image) {
            $images[] = $this->createProductFile($image, $product);
        }
        return $images;
    }

    private function createProductFile(null|UploadedFile|string $image, Product $product, $isPreview = false): Image|int|bool
    {
        if (!$image instanceof UploadedFile) return true;

        $this->setImage($image);
        $this->setIsPreview($isPreview);

        $this->generateFileName();
        $this->setImagePath('images/products/' . $this->fileName);

        Storage::disk('public')->putFileAs('images/products', $this->image, $this->fileName);

        return $this->createNewImageModel($product);
    }


    private function createNewImageModel(Product $product): Image
    {
        $imageUrl = '/storage/' . $this->imagePath;

        $imageModel = new Image([
            'path' => $this->imagePath,
            'url' => asset($imageUrl),
            'product_id' => $product->id
        ]);

        if ($this->isPreview) {
            $product->update([
                'preview_image_path' => $this->imagePath,
                'preview_image_url' => asset($imageUrl)
            ]);
        }

        $imageModel->save();
        return $imageModel;
    }

    private function setImage(?UploadedFile $image): void
    {
        if (!is_null($image)) {
            $this->image = $image;
        }
    }

    private function setImagePath(string $imagePath): void
    {
        $this->imagePath = $imagePath;
    }

    private function setIsPreview(bool $isPreview): void
    {
        $this->isPreview = $isPreview;
    }
}
