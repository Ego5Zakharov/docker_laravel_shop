<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{

    public function definition()
    {
        return [
            'title' => $this->withFaker()->title,
            'alt' => $this->withFaker()->text,
            'path' => $this->withFaker()->filePath(),
            'url' => $this->withFaker()->imageUrl,
        ];
    }
}
