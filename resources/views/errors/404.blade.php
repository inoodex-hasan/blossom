@extends('frontend.layout.master')

@section('title', '404 - Page Not Found | ' . ($siteSettings['site_name'] ?? 'Sundry Blossom'))

@section('content')
<section class="min-h-[70vh] flex items-center justify-center py-20 px-5 sm:px-10">
    <div class="max-w-xl w-full text-center">
        <!-- Badge -->
        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-100 text-amber-800 text-xs font-semibold uppercase tracking-widest mb-6">
            <span class="w-2 h-2 rounded-full bg-amber-500"></span>
            Error 404
        </div>

        <!-- Heading -->
        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-serif text-[#1B3B5A] mb-4">
            Story Not Found
        </h1>

        <!-- Description -->
        <p class="text-base sm:text-lg text-slate-600 leading-relaxed mb-8">
            The collection, page, or handcrafted story you are looking for may have been moved, renamed, or is no longer available.
        </p>

        <!-- Action Buttons -->
        <div class="flex flex-wrap items-center justify-center gap-3.5">
            <a href="{{ route('home') }}" 
               class="inline-flex items-center gap-2 bg-[#1B3B5A] hover:bg-[#152e46] text-white font-medium text-sm px-6 py-3 rounded-xl transition shadow-md">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span>Return Home</span>
            </a>

            <a href="{{ route('products.index') }}" 
               class="inline-flex items-center gap-2 bg-[#03a8f4] hover:bg-[#0284c7] text-white font-medium text-sm px-6 py-3 rounded-xl transition shadow-md">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
                <span>Browse Collections</span>
            </a>
        </div>
    </div>
</section>
@endsection
