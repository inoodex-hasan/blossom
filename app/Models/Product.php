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
        'description',
        'long_description',
        'highlights',
        'style_guidance',
        'partnerships',
        'image',
    ];

    protected $casts = [
        'highlights' => 'array',
        'style_guidance' => 'array',
        'partnerships' => 'array',
    ];

    protected $appends = [
        'image_url',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($product) {
            if (empty($product->slug)) {
                $product->slug = \Illuminate\Support\Str::slug($product->name);
            }
        });
    }

    /**
     * Get the accessible public URL for product image (prioritizes optimized WebP).
     */
    public function getImageUrlAttribute(): ?string
    {
        if (empty($this->image)) {
            return null;
        }

        if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://')) {
            return $this->image;
        }

        if (str_starts_with($this->image, 'assets/')) {
            $webp = preg_replace('/\.(jpg|jpeg|png)$/i', '.webp', $this->image);
            if ($webp !== $this->image && file_exists(public_path($webp))) {
                return asset($webp);
            }
            return file_exists(public_path($this->image)) ? asset($this->image) : null;
        }

        $webpStorage = preg_replace('/\.(jpg|jpeg|png)$/i', '.webp', $this->image);
        if ($webpStorage !== $this->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($webpStorage)) {
            return asset('storage/' . $webpStorage);
        }

        return asset('storage/' . $this->image);
    }

    /**
     * Find a product by slug (case-insensitive and hyphen-tolerant).
     */
    public static function findBySlug(string $slug): ?self
    {
        $normalized = strtolower(str_replace('_', '-', trim($slug)));

        return self::where('slug', $slug)
            ->orWhereRaw('LOWER(REPLACE(slug, "_", "-")) = ?', [$normalized])
            ->first();
    }
}
