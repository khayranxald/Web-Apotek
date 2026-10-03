<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'sku',
        'description',
        'manufacturer',
        'price',
        'discount_price',
        'stock',
        'image',
        'requires_prescription',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'discount_price' => 'decimal:2',
            'requires_prescription' => 'boolean',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Product $product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name) . '-' . Str::random(5);
            }
            if (empty($product->sku)) {
                $product->sku = 'SKU-' . strtoupper(Str::random(8));
            }
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function getFinalPriceAttribute(): float
    {
        return $this->discount_price && $this->discount_price < $this->price
            ? (float) $this->discount_price
            : (float) $this->price;
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}