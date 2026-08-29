<?php

namespace App\Console\Commands;

use App\Services\ImageService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class OptimizeImagesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'images:optimize {--quality=85 : WebP quality between 1 and 100} {--max-width=1920 : Maximum width in pixels}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Optimize existing JPEG/PNG images and generate WebP versions for faster page loads';

    /**
     * Execute the console command.
     */
    public function handle(ImageService $imageService): int
    {
        $quality = (int) $this->option('quality');
        $maxWidth = (int) $this->option('max-width');

        $directories = [
            public_path('assets/images'),
            storage_path('app/public'),
        ];

        $convertedCount = 0;
        $savedBytes = 0;

        $this->info("Scanning directories for images to optimize & convert to WebP...");

        foreach ($directories as $dir) {
            if (!File::isDirectory($dir)) {
                continue;
            }

            $files = File::allFiles($dir);

            foreach ($files as $file) {
                $ext = strtolower($file->getExtension());
                if (!in_array($ext, ['jpg', 'jpeg', 'png'])) {
                    continue;
                }

                $sourcePath = $file->getRealPath();
                $webpPath = pathinfo($sourcePath, PATHINFO_DIRNAME) . '/' . pathinfo($sourcePath, PATHINFO_FILENAME) . '.webp';

                $originalSize = filesize($sourcePath);

                try {
                    $imageService->convertToWebp($sourcePath, $webpPath, $maxWidth, $quality);

                    if (file_exists($webpPath)) {
                        $newSize = filesize($webpPath);
                        $saved = max(0, $originalSize - $newSize);
                        $savedBytes += $saved;
                        $convertedCount++;

                        $this->line("  ✓ Converted <comment>{$file->getFilename()}</comment> -> <info>" . basename($webpPath) . "</info> (Saved " . round($saved / 1024, 1) . " KB)");
                    }
                } catch (\Throwable $e) {
                    $this->warn("  ⚠ Could not convert {$file->getFilename()}: {$e->getMessage()}");
                }
            }
        }

        $this->newLine();
        $this->info("🎉 Done! Successfully converted {$convertedCount} images to WebP.");
        $this->info("💾 Total estimated bandwidth/disk saved: " . round($savedBytes / 1024, 2) . " KB");

        return Command::SUCCESS;
    }
}
