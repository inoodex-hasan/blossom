<!-- Our Story Section -->
<section id="about" class="relative py-16 sm:py-24 px-5 sm:px-10 lg:px-16 overflow-hidden">
    @if($ourStory && $ourStory->image_url)
        <div class="relative max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-6 sm:gap-8 lg:gap-12 items-stretch">
            <div class="rounded-2xl overflow-hidden shadow-md border border-amber-100 min-h-[240px] sm:min-h-0 bg-slate-100">
                <img src="{{ $ourStory->image_url }}" alt="Our Story" class="w-full h-full object-cover">
            </div>
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-6 sm:p-10 shadow-sm border border-amber-100 flex flex-col justify-between">
                <div>
                    <div class="flex items-center gap-3 mb-4 sm:mb-6">
                        <span class="w-8 sm:w-12 h-[1px] bg-slate-300"></span>
                        <span class="text-[10px] sm:text-xs font-bold tracking-[0.2em] text-[#1B3B5A] uppercase">Our Story</span>
                    </div>
                    <h2 class="text-lg sm:text-2xl lg:text-3xl font-serif text-[#1B3B5A] leading-snug italic">
                        At {{ $siteSettings['site_name'] ?? 'Sundry Blossom' }}, we believe that every object carries a story — of the hands that shaped it, the land it came from, and the love poured into its creation
                    </h2>
                    <p class="mt-4 sm:mt-6 text-sm text-slate-600 leading-relaxed">
                        {{ $ourStory->short_description ?? 'Founded with a passion for authenticity, Sundry Blossom brings you the finest handcrafted and sustainable goods.' }}
                    </p>
                </div>
                <div class="mt-6 sm:mt-8">
                    <a href="{{ route('our-story') }}" class="inline-flex items-center gap-2 bg-[#03a8f4] hover:bg-[#0284c7] text-white px-5 sm:px-6 py-2.5 rounded-lg font-medium text-xs uppercase tracking-wider transition-colors shadow-sm">
                        <span>Read More</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    @else
        <div class="relative max-w-4xl mx-auto bg-white/90 backdrop-blur-sm rounded-3xl p-8 sm:p-12 lg:p-16 shadow-sm border border-amber-100 text-center">
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-amber-500/10 text-amber-800 text-xs font-bold uppercase tracking-widest mb-6">
                <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                Our Brand Journey
            </div>
            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-serif text-[#1B3B5A] leading-snug italic max-w-2xl mx-auto">
                At {{ $siteSettings['site_name'] ?? 'Sundry Blossom' }}, every piece tells a story of tradition, ethical craftsmanship, and dedication
            </h2>
            <p class="mt-5 text-sm sm:text-base text-slate-600 leading-relaxed max-w-2xl mx-auto">
                {{ $ourStory->short_description ?? 'We connect local artisan communities and sustainable sourcing with modern conscious consumers and trade partners.' }}
            </p>
            <div class="mt-8">
                <a href="{{ route('our-story') }}" class="inline-flex items-center gap-2 bg-[#03a8f4] hover:bg-[#0284c7] text-white px-6 py-3 rounded-xl font-medium text-xs uppercase tracking-wider transition-colors shadow-sm">
                    <span>Explore Our Story</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
            </div>
        </div>
    @endif
</section>
