<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * Generate dynamic XML sitemap.
     */
    public function index(): Response
    {
        $products = Product::select('slug', 'updated_at')->get();

        $staticPages = [
            ['url' => route('home'), 'priority' => '1.0', 'changefreq' => 'daily'],
            ['url' => route('products.index'), 'priority' => '0.9', 'changefreq' => 'daily'],
            ['url' => route('our-story'), 'priority' => '0.8', 'changefreq' => 'weekly'],
            ['url' => route('contact'), 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['url' => route('inquiry'), 'priority' => '0.8', 'changefreq' => 'weekly'],
        ];

        return response()
            ->view('sitemap', compact('staticPages', 'products'))
            ->header('Content-Type', 'application/xml');
    }

    /**
     * Generate robots.txt
     */
    public function robots(): Response
    {
        $content = "User-agent: *\nAllow: /\nDisallow: /admin/\nDisallow: /login\n\nSitemap: " . route('sitemap.xml') . "\n";

        return response($content, 200)
            ->header('Content-Type', 'text/plain');
    }
}
