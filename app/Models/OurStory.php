<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OurStory extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'content',
        'image',
    ];

    protected $appends = [
        'image_url',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($story) {
            if (empty($story->slug)) {
                $story->slug = \Illuminate\Support\Str::slug($story->title ?: 'our-story');
            }
        });
    }

    /**
     * Get the accessible public URL for story image (prioritizes optimized WebP).
     */
    public function getImageUrlAttribute(): string
    {
        if (empty($this->image)) {
            $defaultWebp = 'assets/images/cta.webp';
            return file_exists(public_path($defaultWebp)) ? asset($defaultWebp) : asset('assets/images/cta.jpeg');
        }

        if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://')) {
            return $this->image;
        }

        if (str_starts_with($this->image, 'assets/')) {
            $webp = preg_replace('/\.(jpg|jpeg|png)$/i', '.webp', $this->image);
            if ($webp !== $this->image && file_exists(public_path($webp))) {
                return asset($webp);
            }
            return asset($this->image);
        }

        $webpStorage = preg_replace('/\.(jpg|jpeg|png)$/i', '.webp', $this->image);
        if ($webpStorage !== $this->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($webpStorage)) {
            return asset('storage/' . $webpStorage);
        }

        return asset('storage/' . $this->image);
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
