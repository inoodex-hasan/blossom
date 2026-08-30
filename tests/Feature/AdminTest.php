<?php

namespace Tests\Feature;

use App\Models\ContactMessage;
use App\Models\HeroSlide;
use App\Models\Inquiry;
use App\Models\OurStory;
use App\Models\Product;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();

        $this->admin = User::first() ?? User::factory()->create([
            'email' => 'hello@inoodex.com',
            'password' => bcrypt('hello@inoodex.com'),
        ]);

        Product::create([
            'name' => 'Legumes',
            'slug' => 'legumes',
            'description' => 'Test legumes',
            'is_active' => true,
        ]);

        HeroSlide::create([
            'title' => 'Sundry Blossom',
            'subtitle' => 'Handcrafted goods',
            'is_active' => true,
            'sort_order' => 1,
        ]);
    }

    public function test_login_route_redirects_to_filament_login(): void
    {
        $response = $this->get('/login');
        $response->assertRedirect('/admin/login');
    }

    public function test_guest_is_redirected_to_filament_login(): void
    {
        $response = $this->get('/admin');
        $response->assertRedirect('/admin/login');
    }

    public function test_filament_login_page_renders_successfully(): void
    {
        $response = $this->get('/admin/login');
        $response->assertStatus(200);
        $response->assertSee('Sundry Blossom');
        $response->assertSee('Sign in');
    }

    public function test_authenticated_admin_can_access_filament_dashboard(): void
    {
        $response = $this->actingAs($this->admin)->get('/admin');
        $response->assertStatus(200);
        $response->assertSee('Sundry Blossom');
    }

    public function test_dashboard_header_widget_renders_successfully(): void
    {
        \Livewire\Livewire::actingAs($this->admin)
            ->test(\App\Filament\Widgets\DashboardHeaderWidget::class)
            ->assertSee('Sundry Blossom Management')
            ->assertSee('Add Product');
    }

    public function test_dashboard_stats_widget_renders_successfully(): void
    {
        \Livewire\Livewire::actingAs($this->admin)
            ->test(\App\Filament\Widgets\StatsOverviewWidget::class)
            ->assertSee('All Products')
            ->assertSee('Total Inquiries');
    }

    public function test_dashboard_inquiries_widget_renders_successfully(): void
    {
        \Livewire\Livewire::actingAs($this->admin)
            ->test(\App\Filament\Widgets\LatestInquiriesWidget::class)
            ->assertSee('Recent Inquiries & Trade Leads');
    }

    public function test_dashboard_contact_messages_widget_renders_successfully(): void
    {
        \Livewire\Livewire::actingAs($this->admin)
            ->test(\App\Filament\Widgets\LatestContactMessagesWidget::class)
            ->assertSee('Recent Customer Messages');
    }

    public function test_admin_can_access_products_resource(): void
    {
        $response = $this->actingAs($this->admin)->get('/admin/products');
        $response->assertStatus(200);
        $response->assertSee('Products');
        $response->assertSee('Legumes');
    }

    public function test_admin_can_access_product_create_page(): void
    {
        $response = $this->actingAs($this->admin)->get('/admin/products/create');
        $response->assertStatus(200);
        $response->assertSee('Create Product');
    }

    public function test_admin_can_view_product_details_in_admin(): void
    {
        $product = Product::first();
        $response = $this->actingAs($this->admin)->get("/admin/products/{$product->id}");
        $response->assertStatus(200);
        $response->assertSee($product->name);
    }

    public function test_admin_can_access_our_story_resource(): void
    {
        $response = $this->actingAs($this->admin)->get('/admin/our-stories');
        $response->assertStatus(200);
        $response->assertSee('Brand Story');
    }

    public function test_admin_can_view_our_story_in_admin(): void
    {
        $story = OurStory::first();
        $response = $this->actingAs($this->admin)->get("/admin/our-stories/{$story->slug}");
        $response->assertStatus(200);
        $response->assertSee($story->title);
    }

    public function test_admin_can_access_hero_slides_resource(): void
    {
        $response = $this->actingAs($this->admin)->get('/admin/hero-slides');
        $response->assertStatus(200);
        $response->assertSee('Hero Slides');
        $response->assertSee('Sundry Blossom');
    }

    public function test_admin_can_access_inquiries_resource(): void
    {
        Inquiry::create([
            'name' => 'Artisan Retailer',
            'email' => 'artisan@test.com',
            'phone' => '+8801900000000',
            'message' => 'Wholesale catalog request',
            'status' => 'pending',
        ]);

        $response = $this->actingAs($this->admin)->get('/admin/inquiries');
        $response->assertStatus(200);
        $response->assertSee('Inquiries');
        $response->assertSee('Artisan Retailer');
    }

    public function test_admin_can_access_contact_messages_resource(): void
    {
        ContactMessage::create([
            'name' => 'General Customer',
            'email' => 'customer@test.com',
            'message' => 'Love your brand products!',
            'is_read' => false,
        ]);

        $response = $this->actingAs($this->admin)->get('/admin/contact-messages');
        $response->assertStatus(200);
        $response->assertSee('Contact Messages');
        $response->assertSee('General Customer');
    }

    public function test_admin_can_access_site_settings_page(): void
    {
        $response = $this->actingAs($this->admin)->get('/admin/manage-site-settings');
        $response->assertStatus(200);
        $response->assertSee('Store &amp; Contact Settings', false);
    }
}
