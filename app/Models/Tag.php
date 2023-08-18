<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property string $title
 */
class Tag extends Model
{
    use HasFactory;

    protected $table = 'tags';

    protected $fillable = ['title'];

    public function products(): belongsToMany
    {
        return $this->belongsToMany(
            Product::class,
            'products_tag',
            'tag_id',
            'product_id',
        );
    }
}
