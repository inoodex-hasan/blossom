<nav class="bg-white shadow-sm sticky top-0 z-50">
    <!-- Top Row: Logo + Search + Inquiry -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 sm:h-18 gap-4">

            <!-- Logo + Title -->
            <a href="{{ route('home') }}" class="flex items-center gap-2.5 shrink-0">
                <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-full border-2 border-[#1B3B5A] flex items-center justify-center">
                    <span class="text-sm sm:text-base font-serif font-bold text-[#1B3B5A]">SB</span>
                </div>
                <div class="flex flex-col leading-none">
                    <span class="text-base sm:text-xl font-serif font-bold tracking-wide text-[#1B3B5A]">{{ $siteSettings['site_name'] ?? 'Sundry Blossom' }}</span>
                    <span class="text-[8px] sm:text-[10px] font-serif tracking-[0.15em] text-slate-500 uppercase">Import and Export Agency</span>
                </div>
            </a>

            <!-- Search Bar (desktop) -->
            <div class="hidden md:flex flex-1 max-w-md mx-6 relative" id="search-wrapper">
                <div class="relative w-full">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <input type="text" id="search-input" placeholder="Search authentic Bangladeshi crafts..." autocomplete="off"
                        class="w-full pl-10 pr-4 py-2 text-sm border border-slate-200 rounded-full bg-slate-50 focus:ring-2 focus:ring-[#1B3B5A]/20 focus:border-[#1B3B5A] outline-none transition">
                </div>
                <div id="search-results" class="hidden absolute top-full left-0 right-0 mt-2 bg-white rounded-xl shadow-xl border border-slate-100 py-2 z-50 max-h-60 overflow-y-auto"></div>
            </div>

            <!-- Inquiry Button + Mobile Menu -->
            <div class="flex items-center gap-3 shrink-0">
                <button onclick="openInquiryModal()" type="button" class="bg-[#03a8f4] hover:bg-[#0284c7] cursor-pointer text-white px-5 py-2 rounded-lg font-semibold text-xs sm:text-sm uppercase tracking-wider transition-colors">
                    Inquiry
                </button>
                <button id="menu-btn" onclick="toggleMobileMenu()" type="button" aria-label="Toggle Navigation Menu" class="md:hidden flex flex-col justify-center items-center w-10 h-10 space-y-1.5 focus:outline-none cursor-pointer">
                    <span id="bar1" class="block w-6 h-0.5 bg-[#1B3B5A] transition-all duration-300 origin-center pointer-events-none"></span>
                    <span id="bar2" class="block w-6 h-0.5 bg-[#1B3B5A] transition-all duration-300 pointer-events-none"></span>
                    <span id="bar3" class="block w-6 h-0.5 bg-[#1B3B5A] transition-all duration-300 origin-center pointer-events-none"></span>
                </button>
            </div>
        </div>
    </div>

    <!-- Desktop Nav Links -->
    <div class="hidden md:block border-t border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-center gap-8 lg:gap-12 py-3">
                <a href="{{ route('home') }}" class="text-sm font-semibold tracking-wider text-[#1B3B5A] uppercase hover:text-[#03a8f4] transition-colors">Home</a>
                <a href="{{ route('our-story') }}" class="text-sm font-semibold tracking-wider text-[#1B3B5A] uppercase hover:text-[#03a8f4] transition-colors">Our Story</a>

                <!-- Products Dropdown -->
                <div class="relative group">
                    <button type="button" class="text-sm font-semibold tracking-wider text-[#1B3B5A] uppercase flex items-center gap-1.5 cursor-pointer hover:text-[#03a8f4] transition-colors">
                         Products and Services
                        <svg class="w-3.5 h-3.5 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div class="absolute top-full left-0 mt-2 w-52 bg-white rounded-xl shadow-xl border border-slate-100 py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                        <a href="{{ route('products.index') }}" class="block px-4 py-2 text-xs font-bold uppercase tracking-wider text-slate-400 border-b border-slate-50 hover:bg-slate-50">All Collections</a>
                        @foreach($headerProducts as $product)
                            <a href="{{ route('products.show', $product->slug) }}" class="block px-4 py-2.5 text-sm font-medium text-[#1B3B5A] hover:bg-slate-50 hover:text-[#03a8f4] transition-colors">
                                {{ $product->name }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <a href="{{ route('contact') }}" class="text-sm font-semibold tracking-wider text-[#1B3B5A] uppercase hover:text-[#03a8f4] transition-colors">Contact</a>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="md:hidden bg-white border-t px-4 pb-6 pt-2 space-y-1 shadow-lg hidden">
        <a href="{{ route('home') }}" class="block py-3 px-4 rounded-lg {{ request()->routeIs('home') ? 'text-[#1B3B5A] bg-slate-100' : 'text-[#1B3B5A]' }} font-medium">Home</a>
        <a href="{{ route('our-story') }}" class="block py-3 px-4 rounded-lg {{ request()->routeIs('our-story*') ? 'text-[#1B3B5A] bg-slate-100' : 'text-[#1B3B5A]' }} font-medium">Our Story</a>
        <div>
            <button id="products-toggle" onclick="toggleProductsSubmenu(event)" type="button" class="w-full flex items-center justify-between py-3 px-4 rounded-lg text-[#1B3B5A] font-medium cursor-pointer">
                Our Products
                <svg id="products-arrow" class="w-4 h-4 transition-transform duration-200 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </button>
            <div id="products-submenu" class="hidden pl-6 space-y-1">
                <a href="{{ route('products.index') }}" class="block py-2 px-4 text-xs font-semibold uppercase tracking-wider text-slate-400">All Collections</a>
                @foreach($headerProducts as $product)
                    <a href="{{ route('products.show', $product->slug) }}" class="block py-2 px-4 text-sm text-[#1B3B5A]/80 hover:text-[#1B3B5A]">{{ $product->name }}</a>
                @endforeach
            </div>
        </div>
        <a href="{{ route('contact') }}" class="block py-3 px-4 rounded-lg {{ request()->routeIs('contact') ? 'text-[#1B3B5A] bg-slate-100' : 'text-[#1B3B5A]' }} font-medium">Contact</a>
    </div>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var searchInput = document.getElementById('search-input');
    var searchResults = document.getElementById('search-results');
    var searchWrapper = document.getElementById('search-wrapper');

    var allProducts = [
        @foreach($headerProducts as $product)
            { name: '{{ $product->name }}', slug: '{{ $product->slug }}', url: '{{ route("products.show", $product->slug) }}', image: '{{ $product->image ?? "" }}' },
        @endforeach
    ];

    if (searchInput && searchResults) {
        searchInput.addEventListener('input', function() {
            var query = this.value.trim().toLowerCase();
            searchResults.innerHTML = '';

            if (query.length < 1) {
                searchResults.classList.add('hidden');
                return;
            }

            var matches = allProducts.filter(function(p) {
                return p.name.toLowerCase().includes(query) || p.slug.toLowerCase().includes(query);
            });

            if (matches.length === 0) {
                searchResults.innerHTML = '<div class="px-4 py-3 text-sm text-slate-400">No products found</div>';
                searchResults.classList.remove('hidden');
            } else {
                matches.forEach(function(p) {
                    var link = document.createElement('a');
                    link.href = p.url;
                    link.className = 'flex items-center gap-3 px-4 py-2.5 hover:bg-slate-50 transition-colors';
                    link.innerHTML = '<span class="text-sm text-[#1B3B5A] font-medium">' + p.name + '</span>';
                    searchResults.appendChild(link);
                });
                searchResults.classList.remove('hidden');
            }
        });

        searchInput.addEventListener('blur', function() {
            setTimeout(function() { searchResults.classList.add('hidden'); }, 200);
        });

        searchInput.addEventListener('focus', function() {
            if (this.value.trim().length >= 1) {
                searchResults.classList.remove('hidden');
            }
        });
    }
});
</script>
