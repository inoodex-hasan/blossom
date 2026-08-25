<?php

namespace App\Http\Controllers;

use App\Models\HeroSlide;
use App\Models\OurStory;
use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display the homepage.
     */
    public function index()
    {
        $products = Product::all();
        $ourStory = OurStory::first();
        $heroSlides = HeroSlide::active()->get();

        return view('index', compact('products', 'ourStory', 'heroSlides'));
    }

    /**
     * Display the Our Story page.
     */
    public function ourStory(?string $slug = null)
    {
        $ourStory = $slug
            ? OurStory::where('slug', $slug)->firstOrFail()
            : OurStory::firstOrFail();

        return view('frontend.pages.our-story', compact('ourStory'));
    }

    /**
     * Display the contact page.
     */
    public function contact()
    {
        return view('frontend.pages.contact');
    }

    /**
     * Display the inquiry page.
     */
    public function inquiry()
    {
        return view('frontend.pages.inquiry');
    }
}
