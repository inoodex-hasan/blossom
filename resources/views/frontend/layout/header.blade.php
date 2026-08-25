<nav class="bg-white/80 backdrop-blur-sm shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 sm:h-20 items-center">
            <a href="{{ route('home') }}" class="text-lg sm:text-2xl font-serif font-bold tracking-widest text-[#0c23d7] uppercase">
                {{ $siteSettings['site_name'] ?? 'Sundry Blossom' }}
            </a>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-6 lg:space-x-10">
                <a href="{{ route('home') }}" class="text-sm font-semibold tracking-wider text-[#0c23d7] uppercase hover:text-[#03a8f4] transition-colors">Home</a>
                <a href="{{ route('our-story') }}" class="text-sm font-semibold tracking-wider text-[#0c23d7] uppercase hover:text-[#03a8f4] transition-colors">Our Story</a>

                <!-- Products Dropdown -->
                <div class="relative group">
                    <button type="button" class="text-sm font-semibold tracking-wider text-[#0c23d7] uppercase flex items-center gap-2 cursor-pointer hover:text-[#03a8f4] transition-colors">
                        Our Products
                        <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div class="absolute top-full left-0 mt-2 w-52 bg-white rounded-xl shadow-xl border border-slate-100 py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                        <a href="{{ route('products.index') }}" class="block px-4 py-2 text-xs font-bold uppercase tracking-wider text-slate-400 border-b border-slate-50 hover:bg-slate-50">All Collections</a>
                        @foreach($headerProducts as $product)
                            <a href="{{ route('products.show', $product->slug) }}" class="block px-4 py-2.5 text-sm font-medium text-[#0c23d7] hover:bg-slate-50 hover:text-[#03a8f4] transition-colors">
                                {{ $product->name }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <a href="{{ route('contact') }}" class="text-sm font-semibold tracking-wider text-[#0c23d7] uppercase hover:text-[#03a8f4] transition-colors">Contact</a>
                <button id="inquiry-btn" onclick="openInquiryModal()" type="button" class="bg-[#03a8f4] hover:bg-[#0284c7] cursor-pointer text-white px-4 sm:px-5 py-2 rounded-lg font-semibold flex items-center gap-2 text-sm uppercase tracking-wider transition-colors shadow-sm">
                    Inquiry
                </button>
            </div>

            <!-- Mobile Menu Button -->
            <button id="menu-btn" onclick="toggleMobileMenu()" type="button" aria-label="Toggle Navigation Menu" class="md:hidden flex flex-col justify-center items-center w-10 h-10 space-y-1.5 focus:outline-none cursor-pointer">
                <span id="bar1" class="block w-6 h-0.5 bg-[#1B3B5A] transition-all duration-300 origin-center pointer-events-none"></span>
                <span id="bar2" class="block w-6 h-0.5 bg-[#1B3B5A] transition-all duration-300 pointer-events-none"></span>
                <span id="bar3" class="block w-6 h-0.5 bg-[#1B3B5A] transition-all duration-300 origin-center pointer-events-none"></span>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="md:hidden bg-white border-t px-4 pb-6 pt-2 space-y-1 shadow-lg hidden">
        <a href="{{ route('home') }}" class="block py-3 px-4 rounded-lg {{ request()->routeIs('home') ? 'text-[#0c23d7] bg-slate-100' : 'text-[#0c23d7]' }} font-medium">Home</a>
        <a href="{{ route('our-story') }}" class="block py-3 px-4 rounded-lg {{ request()->routeIs('our-story*') ? 'text-[#0c23d7] bg-slate-100' : 'text-[#0c23d7]' }} font-medium">Our Story</a>
        <div>
            <button id="products-toggle" onclick="toggleProductsSubmenu(event)" type="button" class="w-full flex items-center justify-between py-3 px-4 rounded-lg text-[#0c23d7] font-medium cursor-pointer">
                Our Products
                <svg id="products-arrow" class="w-4 h-4 transition-transform duration-200 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </button>
            <div id="products-submenu" class="hidden pl-6 space-y-1">
                <a href="{{ route('products.index') }}" class="block py-2 px-4 text-xs font-semibold uppercase tracking-wider text-slate-400">All Collections</a>
                @foreach($headerProducts as $product)
                    <a href="{{ route('products.show', $product->slug) }}" class="block py-2 px-4 text-sm text-[#0c23d7]/80 hover:text-[#0c23d7]">{{ $product->name }}</a>
                @endforeach
            </div>
        </div>
        <a href="{{ route('contact') }}" class="block py-3 px-4 rounded-lg {{ request()->routeIs('contact') ? 'text-[#0c23d7] bg-slate-100' : 'text-[#0c23d7]' }} font-medium">Contact</a>
        <button id="inquiry-btn-mobile" onclick="openInquiryModal()" type="button" class="block w-full mt-2 bg-[#03a8f4] hover:bg-[#0284c7] cursor-pointer text-white px-5 py-2.5 rounded-lg font-medium flex items-center justify-center gap-2 text-sm transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
            Inquiry
        </button>
    </div>
</nav>
