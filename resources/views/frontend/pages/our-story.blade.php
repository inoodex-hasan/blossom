@extends('frontend.layout.master')

@section('title', ($ourStory->title ?? 'Our Story') . ' - ' . ($siteSettings['site_name'] ?? 'Sundry Blossom'))

@section('meta_description', Str::limit(strip_tags($ourStory->short_description ?? 'Learn about Sundry Blossom, connecting skilled artisans with global trade partners.'), 160))
@section('og_title', ($ourStory->title ?? 'Our Story') . ' - Artisan Heritage & Sustainable Sourcing')
@section('og_description', Str::limit(strip_tags($ourStory->short_description ?? 'From humble beginnings to a trusted name in sustainable goods.'), 200))
@section('og_image', $ourStory->image_url ?? '')

@section('content')
@if(!empty($ourStory?->image_url))
<section class="w-full">
    <div class="w-full h-[250px] sm:h-[350px] lg:h-[420px] overflow-hidden">
        <img src="{{ $ourStory->image_url }}" alt="{{ $ourStory->title ?? 'Our Story' }}" class="w-full h-full object-cover">
    </div>
</section>
@endif

<section class="py-12 sm:py-16 px-5 sm:px-10 lg:px-16">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-serif text-[#1B3B5A]">{{ $ourStory->title ?? 'Our Story' }}</h1>
        <p class="mt-5 sm:mt-6 text-base sm:text-lg text-slate-600 leading-relaxed max-w-3xl">
            {{ $ourStory->short_description ?? 'From humble beginnings to a trusted name. We connect skilled artisans with the world, delivering quality products that blend tradition with modern craftsmanship.' }}
        </p>
    </div>
</section>

<section class="pb-16 sm:pb-24 px-5 sm:px-10 lg:px-16">
    <div class="max-w-4xl mx-auto">
        <h2 class="text-2xl sm:text-3xl font-serif text-[#1B3B5A] italic mb-6 sm:mb-8 border-b border-slate-100 pb-3">Our Journey</h2>

        <div class="space-y-6 text-base sm:text-[17px] text-slate-600 leading-relaxed">
            @php
                $content = $ourStory->content ?? '';
                $hasHtml = \Illuminate\Support\Str::contains($content, ['<p>', '<br>', '<ul>', '<ol>', '<li>', '<h3>', '<h2>', '<strong>']);
            @endphp

            @if($hasHtml)
                <div class="prose prose-slate max-w-none space-y-4">
                    {!! $content !!}
                </div>
            @else
                @foreach(explode("\n\n", $content) as $paragraph)
                    @if(trim($paragraph))
                        <p>{{ trim($paragraph) }}</p>
                    @endif
                @endforeach
            @endif
        </div>
    </div>
</section>
@endsection
