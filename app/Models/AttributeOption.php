<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AttributeOption extends Model
{
    use HasFactory;

    protected $fillable = ['attribute_id', 'value', 'sku_id', 'quantity'];

    public function attribute(): BelongsTo
    {
        return $this->belongsTo(Attribute::class);
    }

    public function skus()
    {
        return $this->belongsToMany(Sku::class, 'attribute_option_sku');
    }

    public function sku()
    {
        return $this->belongsTo(Sku::class, 'sku_id');
    }
}
