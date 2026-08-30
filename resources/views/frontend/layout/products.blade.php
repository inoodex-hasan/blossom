<!-- Products Section -->
<section id="projects" class="pt-4 sm:pt-6 pb-16 sm:pb-24 px-5 sm:px-10 lg:px-16">
    <div class="max-w-4xl mx-auto">
        <h2 class="text-2xl sm:text-3xl font-serif italic text-[#1B3B5A] mb-6 sm:mb-8">Our products</h2>

        <div class="space-y-3 sm:space-y-4">
            @forelse($products as $product)
            <a href="{{ route('products.show', $product->slug) }}" class="block group">
                <div class="flex flex-col sm:flex-row items-stretch bg-white/80 backdrop-blur-sm rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                    <div class="w-full sm:w-1/2 h-48 sm:h-44 bg-brand-100 overflow-hidden">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    </div>
                    <div class="w-full sm:w-1/2 bg-slate-200 flex items-center justify-center px-5 py-4 sm:py-0">
                        <h3 class="text-lg sm:text-xl lg:text-2xl font-serif text-[#1B3B5A] group-hover:text-[#03a8f4] transition-colors">{{ $product->name }}</h3>
                    </div>
                </div>
            </a>
            @empty
                <p class="text-center text-slate-500 py-8">No products available at the moment.</p>
            @endforelse

           

            
        </div>

        <div class="mt-8 text-center">
            <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 bg-[#03a8f4] hover:bg-[#0284c7] text-white px-5 sm:px-6 py-2.5 rounded-lg font-medium text-xs uppercase tracking-wider transition-colors shadow-sm">
                View All Products
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
        </div>
    </div>
</section>
