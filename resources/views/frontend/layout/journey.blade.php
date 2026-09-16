<!-- Our Story Section -->
<section id="about" class="relative py-16 sm:py-24 px-5 sm:px-10 lg:px-16 overflow-hidden">
    <div class="absolute inset-0">
        <img src="{{ asset('assets/images/bg.jpeg') }}" alt="" class="w-full h-full object-cover opacity-20">
    </div>
    <div class="relative max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-6 sm:gap-8 lg:gap-12 items-stretch">
        
        <a href="{{ route('our-story') }}" class="group block rounded-2xl overflow-hidden shadow-md min-h-[200px] sm:min-h-0 relative">
            <img src="{{ $ourStory->image_url ?? asset('assets/images/cta.jpeg') }}" alt="Our Story" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/20 to-transparent"></div>
        
            
        </a>
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-5 sm:p-8 shadow-sm flex flex-col justify-between">
            <div>
                <h2 class="text-lg sm:text-2xl lg:text-3xl font-serif text-[#1B3B5A] leading-snug italic">
                    At {{ $siteSettings['site_name'] ?? 'Sundry Blossom' }}, we believe that every object carries a story — of the hands that shaped it, the land it came from, and the love poured into its creation
                </h2>
                <p class="mt-4 sm:mt-6 text-sm text-slate-500 leading-relaxed">
                    {{ $ourStory->short_description ?? 'Founded in 2018, Sundry Blossom has grown into a trusted name for handcrafted and sourced products. With a passion for quality and authenticity, we bring you the finest from across Bangladesh and beyond.' }}
                </p>
                <a href="{{ url('/our-story/' . $ourStory->slug) }}" class="mt-6 sm:mt-8 inline-flex items-center gap-2 bg-[#03a8f4] text-white px-5 sm:px-6 py-2.5 rounded-lg font-medium text-xs uppercase tracking-wider">
                    Read More
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
            </div>
        </div>
    </div>
</section>
