<?php

namespace Database\Seeders;

use App\Models\OurStory;
use Illuminate\Database\Seeder;

class OurStorySeeder extends Seeder
{
    public function run(): void
    {
        OurStory::updateOrCreate(
            ['slug' => 'our-story'],
            [
                'title' => 'Our Story',
                'short_description' => 'Founded in 2018, Sundry Blossom has grown into a trusted name for handcrafted and sourced products. With a passion for quality and authenticity, we bring you the finest from across Bangladesh and beyond.',
                'content' => "At Sundry Blossom, we believe that every object carries a story — of the hands that shaped it, the land it came from, and the love poured into its creation.\n\nFounded in 2018, our journey began with a simple idea: to connect people with authentic, handcrafted products that carry the soul of their origin. What started as a small initiative has now grown into a movement that supports local artisans, farmers, and craftspeople across Bangladesh.\n\nWe travel to remote villages, work closely with communities, and ensure every product we offer is ethically sourced and sustainably made. From the cotton fields of Rajshahi to the weaving looms of Sylhet, every item in our collection tells a story of tradition, skill, and dedication.\n\nOur mission is simple — to bring beauty, quality, and soul into your everyday life while empowering the hands that create these treasures. When you choose Sundry Blossom, you're not just buying a product. You're becoming part of a story that spans generations, cultures, and borders.\n\nWe are committed to fair trade practices, environmental sustainability, and preserving the rich heritage of Bangladeshi craftsmanship. Every purchase directly supports the artisans and their families, helping preserve traditional skills for future generations.",
                'image' => null,
            ]
        );
    }
}
