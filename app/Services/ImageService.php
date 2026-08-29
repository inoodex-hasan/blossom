<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\WebpEncoder;
use Intervention\Image\ImageManager;

class ImageService
{
    protected ImageManager $manager;

    public function __construct()
    {
        $this->manager = new ImageManager(new Driver());
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

        // Store to public storage disk
        Storage::disk('public')->put($destinationPath, (string) $encoded);

        return $destinationPath;
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
    }
}
