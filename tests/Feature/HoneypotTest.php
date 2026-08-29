<?php

namespace Tests\Feature;

use App\Models\ContactMessage;
use App\Models\Inquiry;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HoneypotTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_contact_page_renders_honeypot_fields(): void
    {
        config()->set('honeypot.enabled', true);

        $response = $this->get('/contact');
        $response->assertStatus(200);
        $response->assertSee(config('honeypot.name_field_name'));
    }

    public function test_inquiry_page_renders_honeypot_fields(): void
    {
        config()->set('honeypot.enabled', true);

        $response = $this->get('/inquiry');
        $response->assertStatus(200);
        $response->assertSee(config('honeypot.name_field_name'));
    }

    public function test_honeypot_blocks_bot_filling_hidden_field(): void
    {
        config()->set('honeypot.enabled', true);

        $payload = [
            'name' => 'Spam Bot 3000',
            'email' => 'bot@spammer.com',
            'phone' => '+123456789',
            'message' => 'Buy cheap pharmaceuticals here!',
            config('honeypot.name_field_name') => 'I am a bot filling every input',
        ];

        $response = $this->post('/contact', $payload);

        // Honeypot silently responds with a blank page / 200 without creating the record
        $this->assertDatabaseMissing('contact_messages', [
            'email' => 'bot@spammer.com',
        ]);
    }
}
