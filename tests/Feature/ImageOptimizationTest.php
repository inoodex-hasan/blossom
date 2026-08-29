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
        $file = UploadedFile::fake()->image('handcrafted-rug.jpg', 2400, 1600);

        $storedPath = $imageService->storeAsWebp($file, 'products', 1200, 85);

        $this->assertStringEndsWith('.webp', $storedPath);
        Storage::disk('public')->assertExists($storedPath);
    }

    public function test_optimize_images_artisan_command_runs_successfully(): void
    {
        $this->artisan('images:optimize', ['--quality' => 85])
            ->assertSuccessful()
            ->expectsOutputToContain('Done! Successfully converted');
    }

    public function test_product_model_image_url_serves_webp_when_available(): void
    {
        $product = Product::first();
        $url = $product->image_url;

        $this->assertNotEmpty($url);
        $this->assertStringContainsString('.webp', $url);
    }
}
