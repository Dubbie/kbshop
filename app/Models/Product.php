<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'type',
    ];

    public function skus()
    {
        return $this->hasMany(Sku::class);
    }

    public function scopeBaseProducts($query)
    {
        // Count the related skus, and only return products with 1 sku
        return $query->where('type', 'product')->withCount('skus')->having('skus_count', '=', 1);
    }
}
