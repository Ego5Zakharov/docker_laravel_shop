<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id,
 * @property int $product_id
 * @property int $tag_id
 */
class ProductTag extends Model
{
    use HasFactory;

    protected $table = 'products_tag';

    protected $fillable = ['product_id', 'tag_id'];
}
