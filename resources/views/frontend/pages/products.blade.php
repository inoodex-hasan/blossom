@extends('frontend.layout.master')

@section('title', 'Our Products - ' . ($siteSettings['site_name'] ?? 'Sundry Blossom'))

@section('content')
<section class="pt-20 pb-16 sm:pb-20 px-5 sm:px-6 lg:px-10 lg:px-16">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-2xl sm:text-4xl font-serif italic mb-6 sm:mb-8 text-[#1B3B5A]">Our Collections & Products</h1>
        <div class="space-y-4">
            @forelse($products as $product)
            <a href="{{ route('products.show', $product->slug) }}" class="block group">
                <div class="flex flex-col sm:flex-row items-stretch bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                    <div class="w-full sm:w-1/2 h-48 sm:h-48 bg-brand-100 overflow-hidden">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    </div>
                    <div class="w-full sm:w-1/2 bg-slate-100 flex flex-col justify-center px-6 py-6 sm:py-0">
                        <h2 class="text-lg sm:text-xl lg:text-2xl font-serif text-[#1B3B5A] group-hover:text-[#03a8f4] transition-colors">{{ $product->name }}</h2>
                        @if($product->description)
                            <p class="text-xs sm:text-sm text-slate-500 mt-2 line-clamp-2">{{ $product->description }}</p>
                        @endif
                    </div>
                </div>
            </a>
            @empty
                <div class="bg-white p-8 rounded-xl text-center text-slate-500">
                    <p>No products available yet.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
