<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure storage directory exists and copy asset files for Filament FileUpload preview
        $storageDir = storage_path('app/public/products');
        if (! File::exists($storageDir)) {
            File::makeDirectory($storageDir, 0755, true);
        }

        $sourceDir = public_path('assets/images');
        $filesToCopy = [
            'legumes.jpeg' => 'legumes.jpeg',
            'cotton.jpeg' => 'cotton.jpeg',
            'garments1.jpeg' => 'garments1.jpeg',
            'home decor.jpeg' => 'home-decor.jpeg',
            'Accesssories.jpeg' => 'accessories.jpeg',
        ];

        foreach ($filesToCopy as $src => $dest) {
            $srcPath = $sourceDir . DIRECTORY_SEPARATOR . $src;
            $destPath = $storageDir . DIRECTORY_SEPARATOR . $dest;
            if (File::exists($srcPath)) {
                File::copy($srcPath, $destPath);
            }
        }

        $products = [
            [
                'name' => 'Legumes',
                'slug' => 'legumes',
                'description' => 'Fresh and organic legumes sourced directly from local farms.',
                'image' => 'products/legumes.jpeg',
                'long_description' => "Our legumes are sourced directly from local farmers who use sustainable farming practices. We ensure the highest quality pulses and grains reach your table.\n\nFrom red lentils to chickpeas, every product is carefully selected, cleaned, and packaged to preserve freshness and nutritional value.",
                'highlights' => ['Red Lentils', 'Chickpeas', 'Black Gram', 'Green Peas', 'Mixed Pulses'],
                'style_guidance' => ['Buy in bulk for better value', 'Store in airtight containers', 'Check for uniform size and color', 'Prefer organic options', 'Rotate stock regularly'],
                'partnerships' => ['Wholesale supply agreements', 'Restaurant and hotel partnerships', 'Custom packaging options', 'Volume discounts available', 'Farm-to-table collaboration'],
            ],
            [
                'name' => 'Cotton',
                'slug' => 'cotton',
                'description' => 'Premium quality cotton products for everyday comfort.',
                'image' => 'products/cotton.jpeg',
                'long_description' => "Our cotton products are crafted from the finest natural fibers, ensuring softness and durability. We work with skilled artisans to bring you premium cotton goods.\n\nEach piece is made with care, combining traditional weaving techniques with modern design sensibilities.",
                'highlights' => ['Organic Cotton Fabrics', 'Handwoven Textiles', 'Cotton Home Linens', 'Cotton Garment Fabrics', 'Custom Dyeing Services'],
                'style_guidance' => ['Choose organic for sustainability', 'Mix textures for depth', 'Pair with natural materials', 'Layer for warmth and style', 'Care with gentle washing'],
                'partnerships' => ['Fashion brand collaborations', 'Interior design supply', 'Bulk fabric orders', 'Custom color development', 'Sustainable sourcing programs'],
            ],
            [
                'name' => 'Garments',
                'slug' => 'garments',
                'description' => 'Handcrafted garments with unique designs and patterns.',
                'image' => 'products/garments1.jpeg',
                'long_description' => "Our garment collection features handcrafted clothing that blends traditional artistry with contemporary fashion. Each piece tells a story of skilled craftsmanship.\n\nFrom casual wear to formal attire, our garments are designed for comfort and elegance.",
                'highlights' => ['Hand-stitched Apparel', 'Embroidered Collections', 'Casual Wear Line', 'Formal Attire Range', 'Seasonal Collections'],
                'style_guidance' => ['Layer with complementary pieces', 'Accessorize thoughtfully', 'Choose quality over quantity', 'Invest in versatile staples', 'Express personal style'],
                'partnerships' => ['Boutique retail supply', 'Online store partnerships', 'Custom design services', 'Bulk order discounts', 'Private label manufacturing'],
            ],
            [
                'name' => 'Home Decor',
                'slug' => 'home-decor',
                'description' => 'Beautiful home decor items to brighten your living space.',
                'image' => 'products/home-decor.jpeg',
                'long_description' => "The biggest shift in home decor is a move toward spaces that feel warm, personal, and lived-in. We embrace warm minimalism with layered neutrals, natural materials, and spaces that prioritize emotional comfort.\n\nTransform any room with our carefully curated home decor products. We blend warm minimalism with functional design to create pieces that feel both beautiful and comfortable.",
                'highlights' => ['Handwoven rugs and floor mats', 'Ceramic and terracotta pottery', 'Wooden furniture accents', 'Textured wall panels and hangings', 'Natural fiber baskets and storage'],
                'style_guidance' => ['Mix textures for visual depth', 'Layer neutrals with accent tones', 'Balance open space with statement pieces', 'Incorporate natural light and organic shapes', 'Personal touches over showroom perfection'],
                'partnerships' => ['Interior designer collaboration program', 'Hotel and hospitality project supply', 'Custom color and size options', 'Volume discounts for project orders', 'Showroom visits by appointment'],
            ],
            [
                'name' => 'Accessories',
                'slug' => 'accessories',
                'description' => 'Stylish accessories to complement your look.',
                'image' => 'products/accessories.jpeg',
                'long_description' => "Our accessories collection adds the perfect finishing touch to any outfit or space. Handcrafted with attention to detail, each piece is unique.\n\nFrom bags to jewelry, our accessories are designed to complement your personal style with artisan quality.",
                'highlights' => ['Handcrafted Bags', 'Artisan Jewelry', 'Woven Baskets', 'Decorative Items', 'Gift Collections'],
                'style_guidance' => ['Choose statement pieces wisely', 'Mix materials for contrast', 'Keep it minimal and elegant', 'Match with your outfit palette', 'Quality over quantity always'],
                'partnerships' => ['Fashion accessory boutiques', 'Gift shop distribution', 'Custom branding available', 'Wholesale pricing tiers', 'Consignment opportunities'],
            ],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(
                ['slug' => $product['slug']],
                $product
            );
        }
    }
}
