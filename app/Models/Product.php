<?php

namespace App\Models;

use App\Events\Product\ProductDeleting;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $article
 * @property float $price
 * @property int $quantity
 * @property boolean $is_published
 * @property string $preview_image_url
 * @property string $preview_image_path
 * @property Category $category
 * @property Tag[] $tags
 * @property Image[] $images
 */
class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'title', 'description', 'article',
        'price', 'quantity',
        'preview_image_path', 'preview_image_url',
        'is_published', 'category_id'
    ];

    protected $casts = [
        'price' => 'integer',
        'is_published' => 'boolean',
    ];


    public function category(): belongsTo
    {
        return $this->belongsTo(
            Category::class,
            'category_id',
            'id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(
            Tag::class,
            'products_tag',
            'product_id',
            'tag_id'
        );
    }

    public function images(): HasMany
    {
        return $this->hasMany(
            Image::class,
            'product_id',
            'id');
    }

//    public function getPreviewImageUrlAttribute()
//    {
//        return url('storage')
//    }
}
