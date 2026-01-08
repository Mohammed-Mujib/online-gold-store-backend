<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
    protected $fillable = [
    'name',
    'description',
    'weight',
    'karat',
    'type',
    'gold_price_per_gram',
    'making_fee',
    'total_price',
    'stock',
    'category_id',
    'images',
    'is_active',
    'user_id',
    'is_store_own'
];

protected $casts = [
    'images' => 'array',
    'is_store_own' => 'boolean',
    'is_active' => 'boolean',
];

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
