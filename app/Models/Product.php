<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'badge',
        'concentration',
        'gender',
        'scent_family',
        'short_description',
        'description',
        'top_notes',
        'middle_notes',
        'base_notes',
        'longevity',
        'sillage',
        'projection',
        'mood',
        'price',
        'original_price',
        'discount_percent',
        'stock',
        'is_sold_out',
        'rating',
        'reviews_count',
        'image',
        'gallery',
        'is_featured',
        'is_popular',
        'is_bestseller',
        'is_active',
    ];

    protected $casts = [
        'gallery' => 'array',
        'price' => 'decimal:2',
        'original_price' => 'decimal:2',
        'rating' => 'decimal:1',
        'is_featured' => 'boolean',
        'is_popular' => 'boolean',
        'is_bestseller' => 'boolean',
        'is_sold_out' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class)->latest();
    }

    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    public function getFormattedOriginalPriceAttribute(): ?string
    {
        return $this->original_price ? 'Rp ' . number_format($this->original_price, 0, ',', '.') : null;
    }
}
