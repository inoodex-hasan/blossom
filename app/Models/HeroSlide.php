<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroSlide extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'image',
        'link_url',
        'link_text',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'sort_order' => 'integer',
        'is_active' => 'boolean',
    ];

    protected $appends = [
        'image_url',
    ];

    /**
     * Get the accessible public URL for the hero image (prioritizes optimized WebP).
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
     * Scope query to only active slides in sort order.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)->orderBy('sort_order', 'asc')->orderBy('id', 'asc');
    }
}
