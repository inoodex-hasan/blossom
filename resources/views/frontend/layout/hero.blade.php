@php
    $slides = $heroSlides ?? collect();
@endphp

<!-- Hero Banner / Slider -->
<section class="w-full bg-slate-900 shadow-sm overflow-hidden relative select-none">
    @if($slides->count() > 0)
        <div x-data="{
                active: 0,
                total: {{ $slides->count() }},
                autoplayTimer: null,
                init() {
                    if (this.total > 1) {
                        this.startAutoplay();
                    }
                },
                startAutoplay() {
                    this.autoplayTimer = setInterval(() => {
                        this.next();
                    }, 5500);
                },
                stopAutoplay() {
                    if (this.autoplayTimer) {
                        clearInterval(this.autoplayTimer);
                    }
                },
                next() {
                    this.active = (this.active + 1) % this.total;
                },
                prev() {
                    this.active = (this.active - 1 + this.total) % this.total;
                },
                goTo(index) {
                    this.active = index;
                }
            }"
            @mouseenter="stopAutoplay()"
            @mouseleave="startAutoplay()"
            class="relative w-full h-[240px] xs:h-[300px] sm:h-[380px] md:h-[460px] lg:h-[540px] xl:h-[600px]">

            <!-- Slides Container -->
            @foreach($slides as $index => $slide)
                <div x-show="active === {{ $index }}"
                     x-transition:enter="transition ease-out duration-700"
                     x-transition:enter-start="opacity-0 scale-102"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-500"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="absolute inset-0 w-full h-full">

                    <!-- Background Image -->
                    <img src="{{ $slide->image_url }}"
                         alt="{{ $slide->title ?? 'Sundry Blossom' }}"
                         class="w-full h-full object-cover object-center">

                    @if($slide->title || $slide->subtitle || $slide->link_url)
                        <!-- Ambient Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-slate-950/35 to-transparent"></div>
                        <div class="absolute inset-0 bg-gradient-to-r from-slate-950/70 via-transparent to-transparent"></div>

                        <!-- Slide Content Overlay -->
                        <div class="absolute inset-0 flex items-center justify-start px-6 sm:px-12 lg:px-20 max-w-5xl">
                            <div class="space-y-2 sm:space-y-4 max-w-xl text-white">
                                @if($slide->title)
                                    <h1 class="font-serif text-2xl xs:text-3xl sm:text-4xl lg:text-5xl font-bold tracking-tight text-white leading-tight drop-shadow-md">
                                        {{ $slide->title }}
                                    </h1>
                                @endif

                                @if($slide->subtitle)
                                    <p class="text-xs sm:text-sm md:text-base text-slate-200 leading-relaxed max-w-lg drop-shadow-sm line-clamp-2 sm:line-clamp-none">
                                        {{ $slide->subtitle }}
                                    </p>
                                @endif

                                @if($slide->link_url)
                                    <div class="pt-2 sm:pt-4">
                                        <a href="{{ $slide->link_url }}"
                                           class="inline-flex items-center gap-2 bg-[#03a8f4] hover:bg-[#0284c7] text-white px-5 sm:px-7 py-2.5 sm:py-3 rounded-xl font-semibold text-xs sm:text-sm uppercase tracking-wider transition-all duration-200 shadow-lg shadow-sky-500/30 hover:scale-105 active:scale-95">
                                            <span>{{ $slide->link_text ?: 'Explore Collections' }}</span>
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach

            @if($slides->count() > 1)
                <!-- Navigation Arrows -->
                <button type="button"
                        @click="prev()"
                        aria-label="Previous Slide"
                        class="absolute left-3 sm:left-6 top-1/2 -translate-y-1/2 w-9 h-9 sm:w-11 sm:h-11 rounded-full bg-black/35 hover:bg-black/60 text-white backdrop-blur-md border border-white/20 flex items-center justify-center transition-all hover:scale-110 active:scale-95 z-20 cursor-pointer shadow-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                </button>

                <button type="button"
                        @click="next()"
                        aria-label="Next Slide"
                        class="absolute right-3 sm:right-6 top-1/2 -translate-y-1/2 w-9 h-9 sm:w-11 sm:h-11 rounded-full bg-black/35 hover:bg-black/60 text-white backdrop-blur-md border border-white/20 flex items-center justify-center transition-all hover:scale-110 active:scale-95 z-20 cursor-pointer shadow-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                </button>

                <!-- Indicator Dots / Pills -->
                <div class="absolute bottom-4 sm:bottom-6 left-1/2 -translate-x-1/2 flex items-center gap-2 z-20 bg-black/30 backdrop-blur-md px-3 py-1.5 rounded-full border border-white/10">
                    @foreach($slides as $index => $slide)
                        <button type="button"
                                @click="goTo({{ $index }})"
                                :aria-current="active === {{ $index }} ? 'true' : 'false'"
                                aria-label="Go to slide {{ $index + 1 }}"
                                :class="active === {{ $index }} ? 'w-6 sm:w-8 bg-sky-400' : 'w-2 sm:w-2.5 bg-white/50 hover:bg-white/80'"
                                class="h-2 sm:h-2.5 rounded-full transition-all duration-300 cursor-pointer"></button>
                    @endforeach
                </div>
            @endif
        </div>
    @else
        <!-- Elegant Dynamic Brand Hero (When no slides are configured) -->
        <div class="relative w-full py-20 sm:py-28 lg:py-36 px-6 sm:px-12 lg:px-20 bg-gradient-to-br from-[#1B3B5A] via-[#142C44] to-[#0A1929] text-white flex flex-col justify-center items-start">
            <div class="max-w-3xl space-y-4 sm:space-y-6">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-500/10 border border-amber-500/20 text-amber-400 text-xs font-semibold uppercase tracking-widest">
                    <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                    {{ $siteSettings['site_tagline'] ?? 'Handcrafted & Sustainable Goods' }}
                </div>
                <h1 class="font-serif text-3xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-white leading-tight">
                    Connecting Skilled Artisans with Global Trade
                </h1>
                <p class="text-sm sm:text-base md:text-lg text-slate-300 leading-relaxed max-w-2xl">
                    {{ $siteSettings['site_description'] ?? 'Discover authentic, sustainably sourced goods crafted with dedication across Bangladesh. Pure quality, ethical trade partnerships, and enduring heritage.' }}
                </p>
                <div class="pt-4 flex flex-wrap items-center gap-3.5">
                    <a href="{{ route('products.index') }}"
                       class="inline-flex items-center gap-2 bg-[#03a8f4] hover:bg-[#0284c7] text-white px-6 py-3 rounded-xl font-semibold text-xs sm:text-sm uppercase tracking-wider transition-all duration-200 shadow-lg shadow-sky-500/30">
                        <span>Explore Collections</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                    <button onclick="openInquiryModal()" type="button"
                       class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 text-white border border-white/20 px-6 py-3 rounded-xl font-semibold text-xs sm:text-sm uppercase tracking-wider transition-all duration-200 cursor-pointer">
                        <span>Trade Inquiry</span>
                    </button>
                </div>
            </div>
        </div>
    @endif
</section>