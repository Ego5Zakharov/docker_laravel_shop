<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $title
 */
class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = ['title'];

    public function products(): hasMany
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
