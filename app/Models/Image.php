<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model
{
    use HasFactory;

    protected $table = 'images';

    protected $fillable = [
        'title', 'alt',
        'path', 'url',
        'product_id'
    ];

    public function product(): belongsTo
    {
        return $this->belongsTo(
            Product::class,
            'product_id',
            'id');
    }
}
