<!-- Where Style Meets Function -->
<section class="py-16 sm:py-24 px-5 sm:px-10 lg:px-16">
    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">
        <div>
            <h1 class="text-4xl sm:text-5xl lg:text-8xl font-serif text-[#1B3B5A] leading-[1.1]">
                <span class="inline-block animate-fade-up" style="animation-delay: 0.1s;">Where</span>
                <span class="inline-block animate-fade-up" style="animation-delay: 0.3s;">style</span><br>
                <span class="inline-block animate-fade-up" style="animation-delay: 0.6s;">meets</span>
                <span class="inline-block animate-fade-up" style="animation-delay: 0.9s;">function</span>
            </h1>
            <div class="mt-6 sm:mt-8 flex items-center gap-3">
                <span class="w-12 h-[2px] bg-amber-500"></span>
                <span class="w-2 h-2 rounded-full bg-amber-500"></span>
            </div>
        </div>
        <div class="style-container bg-white/80 backdrop-blur-sm rounded-2xl p-5 sm:p-8 lg:p-10 shadow-md border border-amber-100 max-w-lg lg:ml-auto max-h-[250px] sm:max-h-[280px] lg:max-h-[300px] flex flex-col">
            <div class="overflow-y-auto pr-3 sm:pr-4 style-scrollbar space-y-4">
                <p class="text-sm sm:text-base text-slate-600 leading-relaxed">
                    At {{ $siteSettings['site_name'] ?? 'Sundry Blossom' }}, we craft and curate pieces that bring warmth, authenticity, and enduring beauty to modern living. From sustainably harvested natural cotton and organic pulses to handcrafted apparel and bespoke home accents, every creation honors time-tested craftsmanship and mindful design.
                </p>
                <p class="text-sm sm:text-base text-slate-600 leading-relaxed">
                    We work hand-in-hand with regional weavers, farmers, and artisans across Bangladesh to celebrate traditional techniques while designing for contemporary lifestyle needs.
                </p>
                <p class="text-sm sm:text-base text-slate-600 leading-relaxed">
                    Every piece is thoughtfully selected to elevate your everyday spaces — creating a harmonious balance between refined aesthetic charm and purposeful utility.
                </p>
            </div>
        </div>
    </div>
</section>

<style>
    @keyframes fadeUp {
        0% { opacity: 0; transform: translateY(30px); }
        100% { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-up {
        opacity: 0;
        animation: fadeUp 0.6s ease-out forwards;
    }
    
    /* Light White Scrollbar - Initially Hidden, Visible on Hover */
    .style-scrollbar {
        scrollbar-width: thin;
        scrollbar-color: transparent transparent;
        transition: scrollbar-color 0.3s ease;
    }
    .style-scrollbar::-webkit-scrollbar {
        width: 5px;
    }
    .style-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }
    .style-scrollbar::-webkit-scrollbar-thumb {
        background: transparent;
        border-radius: 10px;
        transition: background 0.3s ease;
    }
    .style-container:hover .style-scrollbar {
        scrollbar-color: #ffffff #f1f1f1;
    }
    .style-container:hover .style-scrollbar::-webkit-scrollbar-thumb {
        background: #ffffff;
        box-shadow: 0 0 5px rgba(0,0,0,0.1);
    }
    .style-container:hover .style-scrollbar::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
</style>
