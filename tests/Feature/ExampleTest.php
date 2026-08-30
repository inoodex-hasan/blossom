<?php

namespace Tests\Feature;

use App\Models\ContactMessage;
use App\Models\Inquiry;
use App\Models\OurStory;
use App\Models\Product;
use App\Models\SiteSetting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();

        Product::create([
            'name' => 'Legumes',
            'slug' => 'legumes',
            'description' => 'Fine organic legumes from Rajshahi.',
            'long_description' => 'Our premium collection of legumes.',
            'highlights' => ['100% Organic', 'Ethically Sourced'],
            'is_active' => true,
        ]);
    }

    public function test_homepage_returns_successful_response(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Sundry Blossom');
        $response->assertSee('Legumes');
    }

    public function test_products_list_returns_successful_response(): void
    {
        $response = $this->get('/products');
        $response->assertStatus(200);
        $response->assertSee('Our Collections', false);
        $response->assertSee('Legumes');
    }

    public function test_product_detail_page_returns_successful_response(): void
    {
        $response = $this->get('/products/legumes');
        $response->assertStatus(200);
        $response->assertSee('Legumes');
        $response->assertSee('Key Highlights');
    }

    public function test_our_story_page_returns_successful_response(): void
    {
        $response = $this->get('/our-story');
        $response->assertStatus(200);
        $response->assertSee('Our Story');
        $response->assertSee('Our Journey', false);
    }

    public function test_contact_page_returns_successful_response(): void
    {
        $response = $this->get('/contact');
        $response->assertStatus(200);
        $response->assertSee('Send a Message');
        $response->assertSee('sundryblossom@gmail.com');
    }

    public function test_inquiry_page_returns_successful_response(): void
    {
        $response = $this->get('/inquiry');
        $response->assertStatus(200);
        $response->assertSee('Send Us an Inquiry');
    }

    public function test_contact_form_submission_stores_message(): void
    {
        $payload = [
            'name' => 'Alice Green',
            'email' => 'alice@example.com',
            'phone' => '+8801700000000',
            'message' => 'Hello, I would like to inquire about your handmade rugs.',
        ];

        $response = $this->postJson('/contact', $payload);

        $response->assertStatus(201)
                 ->assertJson([
                     'success' => true,
                 ]);

        $this->assertDatabaseHas('contact_messages', [
            'name' => 'Alice Green',
            'email' => 'alice@example.com',
        ]);
    }

    public function test_contact_form_validation_fails_on_missing_data(): void
    {
        $response = $this->postJson('/contact', [
            'name' => '',
            'email' => 'invalid-email',
            'message' => '',
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name', 'email', 'message']);
    }

    public function test_inquiry_form_submission_stores_inquiry(): void
    {
        $payload = [
            'name' => 'Bob Retailer',
            'email' => 'bob@boutique.com',
            'phone' => '+8801800000000',
            'address' => 'London, UK',
            'company_name' => 'Artisan Boutique UK',
            'company_details' => 'Wholesale retail store',
            'message' => 'We want to order 500 units of cotton linens.',
        ];

        $response = $this->postJson('/inquiry', $payload);

        $response->assertStatus(201)
                 ->assertJson([
                     'success' => true,
                 ]);

        $this->assertDatabaseHas('inquiries', [
            'name' => 'Bob Retailer',
            'company_name' => 'Artisan Boutique UK',
        ]);
    }

    public function test_inquiry_form_validation_fails_on_missing_required_fields(): void
    {
        $response = $this->postJson('/inquiry', [
            'name' => '',
            'email' => 'not-an-email',
            'phone' => '',
            'message' => '',
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name', 'email', 'phone', 'message']);
    }
}
