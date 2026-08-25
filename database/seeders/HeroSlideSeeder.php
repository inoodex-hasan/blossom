<?php

namespace Database\Seeders;

use App\Models\HeroSlide;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class HeroSlideSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure storage directory exists and copy banner images
        $storageDir = storage_path('app/public/hero-slides');
        if (! File::exists($storageDir)) {
            File::makeDirectory($storageDir, 0755, true);
        }

        $sourceDir = public_path('assets/images');
        $filesToCopy = [
            'hero.jpeg' => 'hero-1.jpeg',
            'cta.jpeg' => 'hero-2.jpeg',
            'garments.jpeg' => 'hero-3.jpeg',
        ];

        foreach ($filesToCopy as $src => $dest) {
            $srcPath = $sourceDir . DIRECTORY_SEPARATOR . $src;
            $destPath = $storageDir . DIRECTORY_SEPARATOR . $dest;
            if (File::exists($srcPath)) {
                File::copy($srcPath, $destPath);
            }
        }

        $slides = [
            [
                'title' => 'Sundry Blossom',
                'subtitle' => 'Handcrafted & Sustainable Goods Sourced from Rural Artisans',
                'image' => 'hero-slides/hero-1.jpeg',
                'link_url' => '/products',
                'link_text' => 'Explore Collections',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Ethical B2B Sourcing',
                'subtitle' => 'Connecting Global Retailers with Authentic Bangladeshi Craftsmanship',
                'image' => 'hero-slides/hero-2.jpeg',
                'link_url' => '/inquiry',
                'link_text' => 'Trade Inquiries',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Hand-loomed & Organic',
                'subtitle' => 'Pure Natural Fibers, Sustainable Textiles & Mindful Living',
                'image' => 'hero-slides/hero-3.jpeg',
                'link_url' => '/our-story',
                'link_text' => 'Our Heritage',
                'sort_order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($slides as $slide) {
            HeroSlide::updateOrCreate(
                ['title' => $slide['title']],
                $slide
            );
        }
    }
}
