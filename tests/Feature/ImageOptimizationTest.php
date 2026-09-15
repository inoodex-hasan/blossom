<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Services\ImageService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ImageOptimizationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_image_service_converts_uploaded_image_to_webp(): void
    {
        Storage::fake('public');

        $imageService = app(ImageService::class);
        $tempPath = tempnam(sys_get_temp_dir(), 'test_img_') . '.jpg';
        $gd = imagecreatetruecolor(200, 200);
        imagejpeg($gd, $tempPath);
        imagedestroy($gd);

        $file = new UploadedFile($tempPath, 'handcrafted-rug.jpg', 'image/jpeg', null, true);

        $storedPath = $imageService->storeAsWebp($file, 'products', 1200, 85);

        $this->assertStringEndsWith('.webp', $storedPath);
        Storage::disk('public')->assertExists($storedPath);

        if (file_exists($tempPath)) {
            @unlink($tempPath);
        }
    }

    public function test_optimize_images_artisan_command_runs_successfully(): void
    {
        $this->artisan('images:optimize', ['--quality' => 85])
            ->assertSuccessful()
            ->expectsOutputToContain('Done! Successfully converted');
    }

    public function test_product_model_image_url_serves_webp_when_available(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('products/sample.webp', 'fake content');

        $product = Product::create([
            'name' => 'Sample Product',
            'slug' => 'sample-product',
            'image' => 'products/sample.jpg',
            'is_active' => true,
        ]);

        $url = $product->image_url;

        $this->assertNotEmpty($url);
        $this->assertStringContainsString('.webp', $url);
    }
}
