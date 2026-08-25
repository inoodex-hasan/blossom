@extends('frontend.layout.master')

@section('title', $product->name . ' - ' . ($siteSettings['site_name'] ?? 'Sundry Blossom'))

@section('content')
<section class="py-12 sm:py-16 px-5 sm:px-10 lg:px-16">
    <div class="max-w-6xl mx-auto">
        <!-- Breadcrumbs -->
        <nav class="mb-8 flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-slate-400">
            <a href="{{ route('home') }}" class="hover:text-slate-700 transition">Home</a>
            <span>/</span>
            <a href="{{ route('products.index') }}" class="hover:text-slate-700 transition">Collections</a>
            <span>/</span>
            <span class="text-slate-700">{{ $product->name }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16 items-start">
            <!-- Left Image Column -->
            <div class="lg:col-span-6 sticky top-24">
                <div class="rounded-3xl overflow-hidden shadow-xl bg-slate-100 aspect-4/3 sm:aspect-square">
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                </div>
            </div>

            <!-- Right Content Column -->
            <div class="lg:col-span-6 flex flex-col">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-[#0EA5E9]">Collection</span>
                    <h1 class="font-serif text-3xl sm:text-4xl lg:text-5xl text-[#1B3B5A] leading-[1.05]">{{ $product->name }}</h1>

                    <p class="mt-4 sm:mt-6 text-sm sm:text-base text-slate-600 leading-relaxed">{{ $product->description }}</p>

                    @if($product->long_description)
                    <div class="mt-8 sm:mt-10">
                        <h2 class="font-serif text-xl sm:text-2xl text-[#1B3B5A] border-b border-slate-100 pb-2">About This Collection</h2>
                        
                        @php
                            $longDesc = $product->long_description;
                            $hasHtml = \Illuminate\Support\Str::contains($longDesc, ['<p>', '<br>', '<ul>', '<ol>', '<li>', '<h3>', '<h2>', '<strong>']);
                        @endphp

                        @if($hasHtml)
                            <div class="mt-3 sm:mt-4 text-sm sm:text-[15px] text-slate-600 leading-relaxed space-y-3">
                                {!! $longDesc !!}
                            </div>
                        @else
                            <div class="mt-3 sm:mt-4 space-y-3 sm:space-y-4 text-sm sm:text-[15px] text-slate-600 leading-relaxed">
                                @foreach(explode("\n\n", $longDesc) as $paragraph)
                                    <p>{{ $paragraph }}</p>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    @endif

                    @if(!empty($product->highlights) && is_array($product->highlights))
                    <div class="mt-8 sm:mt-10">
                        <h2 class="font-serif text-xl sm:text-2xl text-[#1B3B5A] border-b border-slate-100 pb-2">Key Highlights</h2>
                        <ul class="mt-3 sm:mt-4 space-y-2 sm:space-y-3">
                            @foreach($product->highlights as $item)
                            <li class="flex items-start gap-3">
                                <span class="w-2 h-2 mt-2 rounded-full bg-[#0EA5E9] flex-shrink-0"></span>
                                <span class="text-sm sm:text-[15px] text-slate-700 leading-relaxed">{{ $item }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    @if(!empty($product->style_guidance) && is_array($product->style_guidance))
                    <div class="mt-8 sm:mt-10">
                        <h2 class="font-serif text-xl sm:text-2xl text-[#1B3B5A] border-b border-slate-100 pb-2">Style Guidance & Care</h2>
                        <ul class="mt-3 sm:mt-4 space-y-2 sm:space-y-3">
                            @foreach($product->style_guidance as $item)
                            <li class="flex items-start gap-3">
                                <span class="w-2 h-2 mt-2 rounded-full bg-amber-500 flex-shrink-0"></span>
                                <span class="text-sm sm:text-[15px] text-slate-700 leading-relaxed">{{ $item }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    @if(!empty($product->partnerships) && is_array($product->partnerships))
                    <div class="mt-8 sm:mt-10">
                        <h2 class="font-serif text-xl sm:text-2xl text-[#1B3B5A] border-b border-slate-100 pb-2">Trade Partnerships & Sourcing</h2>
                        <ul class="mt-3 sm:mt-4 space-y-2 sm:space-y-3">
                            @foreach($product->partnerships as $item)
                            <li class="flex items-start gap-3">
                                <span class="w-2 h-2 mt-2 rounded-full bg-emerald-600 flex-shrink-0"></span>
                                <span class="text-sm sm:text-[15px] text-slate-700 leading-relaxed">{{ $item }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <!-- Action Trigger -->
                    <div class="mt-10 sm:mt-12 pt-6 border-t border-slate-100">
                        <button type="button" onclick="openInquiryModal()" class="w-full sm:w-auto inline-flex items-center justify-center gap-3 bg-[#03a8f4] hover:bg-sky-500 text-white font-semibold text-xs sm:text-sm uppercase tracking-wider py-4 px-8 rounded-2xl shadow-lg transition">
                            <span>Request Trade Inquiry for this Collection</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
