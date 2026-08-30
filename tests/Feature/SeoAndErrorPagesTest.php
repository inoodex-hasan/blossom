<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SeoAndErrorPagesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();

        Product::create([
            'name' => 'Handcrafted Legumes',
            'slug' => 'legumes',
            'description' => 'Organic legumes',
            'image' => 'products/sample.jpg',
            'is_active' => true,
        ]);
    }

    public function test_homepage_renders_open_graph_meta_tags(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('og:site_name', false);
        $response->assertSee('og:title', false);
        $response->assertSee('twitter:card', false);
    }

    public function test_product_detail_page_renders_dynamic_open_graph_and_schema_json_ld(): void
    {
        $product = Product::first();

        $response = $this->get(route('products.show', $product->slug));

        $response->assertStatus(200);
        $response->assertSee($product->name);
        $response->assertSee('schema.org', false);
        $response->assertSee('"@type": "Product"', false);
        $response->assertSee('og:image', false);
    }

    public function test_sitemap_xml_returns_valid_xml_with_products(): void
    {
        $product = Product::first();

        $response = $this->get('/sitemap.xml');

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/xml');
        $response->assertSee('<urlset', false);
        $response->assertSee($product->slug);
    }

    public function test_robots_txt_returns_proper_directives(): void
    {
        $response = $this->get('/robots.txt');

        $response->assertStatus(200);
        $response->assertSee('User-agent: *');
        $response->assertSee('Sitemap:');
    }

    public function test_custom_404_error_page_renders_branded_view(): void
    {
        $response = $this->get('/this-route-does-not-exist-at-all');

        $response->assertStatus(404);
        $response->assertSee('Story Not Found');
        $response->assertSee('Error 404');
        $response->assertSee('Return Home');
    }
}
