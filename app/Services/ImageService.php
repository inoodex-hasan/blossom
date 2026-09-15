<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\WebpEncoder;
use Intervention\Image\ImageManager;

class ImageService
{
    protected ?ImageManager $manager = null;

    public function __construct()
    {
        try {
            $this->manager = new ImageManager(new Driver());
        } catch (\Throwable $e) {
            Log::warning('Intervention ImageManager initialization failed: ' . $e->getMessage());
            $this->manager = null;
        }
    }

    /**
     * Process, resize, and convert an uploaded image to optimized WebP format.
     */
    public function storeAsWebp(
        UploadedFile|string $file,
        string $directory = 'uploads',
        int $maxWidth = 1600,
        int $quality = 85
    ): string {
        try {
            if (function_exists('ini_set')) {
                @ini_set('memory_limit', '256M');
            }

            if ($this->manager !== null) {
                $filename = Str::random(40) . '.webp';
                $destinationPath = trim($directory, '/') . '/' . $filename;

                // Decode source image (handles UploadedFile, file path, binary string, etc.)
                $source = $file instanceof UploadedFile ? $file->getRealPath() : $file;
                $image = $this->manager->decode($source);

                // Auto-orient based on EXIF
                $image->orient();

                // Proportionally scale down if wider than max width
                if ($maxWidth > 0 && $image->width() > $maxWidth) {
                    $image->scaleDown(width: $maxWidth);
                }

                // Encode to WebP with optimal compression
                $encoded = $image->encode(new WebpEncoder(quality: $quality));

                // Ensure destination directory exists on public disk
                $targetDir = trim($directory, '/');
                if (!Storage::disk('public')->exists($targetDir)) {
                    Storage::disk('public')->makeDirectory($targetDir);
                }

                // Store to public storage disk
                Storage::disk('public')->put($destinationPath, (string) $encoded);

                return $destinationPath;
            }
        } catch (\Throwable $e) {
            Log::warning('ImageService WebP conversion failed (' . $e->getMessage() . '), falling back to native file storage.');
        }

        // Direct storage fallback if GD/WebP is not available or fails on live server
        if ($file instanceof UploadedFile) {
            $path = $file->store(trim($directory, '/'), 'public');
            return $path ?: (trim($directory, '/') . '/' . $file->hashName());
        }

        if (is_string($file) && file_exists($file)) {
            $ext = pathinfo($file, PATHINFO_EXTENSION) ?: 'jpg';
            $fallbackPath = trim($directory, '/') . '/' . Str::random(40) . '.' . $ext;
            Storage::disk('public')->put($fallbackPath, file_get_contents($file));
            return $fallbackPath;
        }

        return trim($directory, '/') . '/' . Str::random(40) . '.jpg';
    }

    /**
     * Optimize an existing file in-place or convert to a new WebP file.
     */
    public function convertToWebp(
        string $sourcePath,
        ?string $destinationPath = null,
        int $maxWidth = 1920,
        int $quality = 85
    ): ?string {
        if (!file_exists($sourcePath)) {
            return null;
        }

        try {
            if ($this->manager === null) {
                return null;
            }

            $image = $this->manager->decode($sourcePath);

            $image->orient();

            if ($maxWidth > 0 && $image->width() > $maxWidth) {
                $image->scaleDown(width: $maxWidth);
            }

            $encoded = $image->encode(new WebpEncoder(quality: $quality));

            if (!$destinationPath) {
                $info = pathinfo($sourcePath);
                $destinationPath = $info['dirname'] . '/' . $info['filename'] . '.webp';
            }

            file_put_contents($destinationPath, (string) $encoded);

            return $destinationPath;
        } catch (\Throwable $e) {
            Log::warning('convertToWebp failed: ' . $e->getMessage());
            return null;
        }
    }
}
