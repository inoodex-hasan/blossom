<nav class="bg-white shadow-sm fixed top-0 left-0 right-0 z-50">
    <!-- Top Row: Logo + Search + Inquiry -->
    <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-14 sm:h-16 lg:h-18 gap-2 sm:gap-4">

            <!-- Logo + Title -->
            <a href="{{ route('home') }}" class="flex items-center gap-1.5 sm:gap-2.5 shrink-0 min-w-0 notranslate" translate="no">
                @if(!empty($siteSettings['site_logo']))
                    <img src="{{ asset('storage/' . $siteSettings['site_logo']) }}" alt="{{ $siteSettings['site_name'] ?? 'Sundry Blossom' }}" class="h-14 sm:h-16 lg:h-20 w-auto max-w-[200px] sm:max-w-[240px] lg:max-w-[300px] object-contain shrink-0">
                @else
                    <div class="w-8 h-8 sm:w-12 sm:h-12 lg:w-14 lg:h-14 rounded-full border-2 border-[#1B3B5A] flex items-center justify-center shrink-0">
                        <span class="text-xs sm:text-sm font-serif font-bold text-[#1B3B5A]">
                            {{ strtoupper(substr($siteSettings['site_name'] ?? 'Sundry Blossom', 0, 1)) }}{{ strtoupper(substr(strrchr($siteSettings['site_name'] ?? 'Sundry Blossom', ' ') ?: 'B', 1, 1)) }}
                        </span>
                    </div>
                @endif
                <div class="flex flex-col leading-tight min-w-0 notranslate py-0.5" translate="no">
                    <span id="site-brand-name" class="text-base sm:text-2xl font-serif font-bold tracking-wide text-[#02386A] truncate notranslate" translate="no" style="-webkit-text-stroke: 1px #000; text-shadow: 1px 1px 0 #000;">{{ $siteSettings['site_name'] ?? 'Sundry Blossom' }}</span>
                    <span id="site-brand-tagline" class="text-[7.5px] sm:text-[10.5px] font-serif tracking-[0.15em] text-[#02386A] uppercase truncate notranslate leading-normal mt-0.5" translate="no">Import Export Agency</span>
                    <script>
                        (function() {
                            var m = document.cookie.match(/(?:^|;\s*)googtrans=([^;]*)/);
                            var c = m ? decodeURIComponent(m[1]) : '';
                            if (c.indexOf('/bn') !== -1 || c === 'bn') {
                                var n = document.getElementById('site-brand-name');
                                var t = document.getElementById('site-brand-tagline');
                                if (n) {
                                    n.textContent = 'সানড্রি ব্লসম';
                                    n.style.webkitTextStroke = '0px';
                                    n.style.textShadow = 'none';
                                    n.style.fontFamily = "'Hind Siliguri', sans-serif";
                                }
                                if (t) {
                                    t.textContent = 'আমদানি রপ্তানি সংস্থা';
                                    t.style.letterSpacing = 'normal';
                                    t.style.textTransform = 'none';
                                    t.style.fontFamily = "'Hind Siliguri', sans-serif";
                                    t.style.fontSize = '12px';
                                    t.style.fontWeight = '600';
                                }
                            }
                        })();
                    </script>
                </div>
            </a>

            <!-- Search Bar + Language Switcher (desktop) -->
            <div class="hidden md:flex flex-1 max-w-xl mx-4 lg:mx-6 items-center gap-3">
                <form action="{{ route('products.index') }}" method="GET" class="flex-1 relative" id="search-wrapper" onsubmit="return handleSearchSubmit(event, 'search-input')">
                    <div class="relative w-full">
                        <button type="submit" aria-label="Search" class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-[#03a8f4] transition cursor-pointer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </button>
                        <input type="text" name="search" id="search-input" placeholder="Search authentic Bangladeshi crafts..." autocomplete="off"
                            class="w-full pl-10 pr-4 py-2 text-sm border border-slate-200 rounded-full bg-slate-50 focus:ring-2 focus:ring-[#1B3B5A]/20 focus:border-[#1B3B5A] outline-none transition">
                    </div>
                    <div id="search-results" class="hidden absolute top-full left-0 right-0 mt-2 bg-white rounded-xl shadow-2xl border border-slate-100 py-2 z-[60] max-h-72 overflow-y-auto"></div>
                </form>

                <!-- Desktop Language Switcher -->
                <div class="relative shrink-0" id="desktop-lang-wrapper">
                    <button id="lang-btn-desktop" onclick="toggleLangDropdown(event)" type="button" aria-expanded="false"
                        class="flex items-center gap-2 px-3 py-2 bg-slate-50 hover:bg-slate-100 border border-slate-200 rounded-full text-xs font-semibold text-[#1B3B5A] tracking-wide transition-all shadow-sm focus:outline-none cursor-pointer">
                        <svg class="w-4 h-4 text-[#03a8f4]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                        </svg>
                        <span id="current-lang-text-desktop">English</span>
                        <svg class="w-3 h-3 text-slate-400 transition-transform duration-200" id="lang-arrow-desktop" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <!-- Language Dropdown Menu -->
                    <div id="lang-menu-desktop" class="hidden absolute right-0 mt-2 w-32 bg-white rounded-xl shadow-xl border border-slate-100 py-1.5 z-50 transition-all">
                        <button onclick="handleLangSelect('en')" type="button" class="w-full flex items-center justify-between px-3.5 py-2 text-xs font-medium text-[#1B3B5A] hover:bg-slate-50 hover:text-[#03a8f4] transition-colors cursor-pointer text-left">
                            <span>English</span>
                            <span id="check-en-desktop" class="text-[#03a8f4] font-bold">✓</span>
                        </button>
                        <button onclick="handleLangSelect('bn')" type="button" class="w-full flex items-center justify-between px-3.5 py-2 text-xs font-medium text-[#1B3B5A] hover:bg-slate-50 hover:text-[#03a8f4] transition-colors cursor-pointer text-left">
                            <span>বাংলা</span>
                            <span id="check-bn-desktop" class="text-[#03a8f4] font-bold hidden">✓</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Inquiry Button + Mobile Menu -->
            <div class="flex items-center gap-1 sm:gap-2.5 shrink-0">
                <!-- Mobile Search Button -->
                <button id="mobile-search-toggle-btn" onclick="toggleMobileSearchBar()" type="button" aria-label="Search" class="md:hidden p-1.5 text-[#1B3B5A] hover:bg-slate-100 rounded-full cursor-pointer transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </button>

                <!-- Mobile Language Switcher Pill -->
                <div class="md:hidden relative" id="mobile-lang-wrapper">
                    <button onclick="toggleMobileLangDropdown(event)" type="button" aria-label="Switch Language" class="flex items-center gap-1.5 px-2.5 py-1.5 bg-slate-50 hover:bg-slate-100 border border-slate-200 rounded-full text-xs font-semibold text-[#1B3B5A] shadow-sm cursor-pointer">
                        <svg class="w-3.5 h-3.5 text-[#03a8f4]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                        </svg>
                        <span id="current-lang-text-mobile">EN</span>
                        <svg class="w-2.5 h-2.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div id="lang-menu-mobile" class="hidden absolute right-0 mt-2 w-28 bg-white rounded-xl shadow-xl border border-slate-100 py-1.5 z-50">
                        <button onclick="handleLangSelect('en')" type="button" class="w-full flex items-center justify-between px-3 py-2 text-xs font-medium text-[#1B3B5A] hover:bg-slate-50 text-left">
                            <span>English</span>
                            <span id="check-en-mobile" class="text-[#03a8f4] font-bold">✓</span>
                        </button>
                        <button onclick="handleLangSelect('bn')" type="button" class="w-full flex items-center justify-between px-3 py-2 text-xs font-medium text-[#1B3B5A] hover:bg-slate-50 text-left">
                            <span>বাংলা</span>
                            <span id="check-bn-mobile" class="text-[#03a8f4] font-bold hidden">✓</span>
                        </button>
                    </div>
                </div>

                <!-- Mobile Menu Button -->
                <button id="menu-btn" onclick="toggleMobileMenu()" type="button" aria-label="Toggle Navigation Menu" class="md:hidden flex flex-col justify-center items-center w-7 h-7 sm:w-10 sm:h-10 space-y-[5px] focus:outline-none cursor-pointer">
                    <span id="bar1" class="block w-5 sm:w-6 h-[2.5px] bg-[#1B3B5A] transition-all duration-300 origin-center pointer-events-none rounded-full"></span>
                    <span id="bar2" class="block w-5 sm:w-6 h-[2.5px] bg-[#1B3B5A] transition-all duration-300 pointer-events-none rounded-full"></span>
                    <span id="bar3" class="block w-5 sm:w-6 h-[2.5px] bg-[#1B3B5A] transition-all duration-300 origin-center pointer-events-none rounded-full"></span>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Dropdown Search Bar -->
    <div id="mobile-search-bar" class="hidden md:hidden border-t border-slate-100 bg-white px-4 py-3 shadow-md relative">
        <div class="relative w-full">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input type="text" id="mobile-search-input" placeholder="Search authentic crafts..." autocomplete="off"
                class="w-full pl-10 pr-4 py-2 text-sm border border-slate-200 rounded-full bg-slate-50 focus:ring-2 focus:ring-[#1B3B5A]/20 focus:border-[#1B3B5A] outline-none transition">
        </div>
        <div id="mobile-search-results" class="hidden absolute top-full left-4 right-4 mt-2 bg-white rounded-xl shadow-xl border border-slate-100 py-2 z-50 max-h-60 overflow-y-auto"></div>
    </div>

    <!-- Desktop Nav Links -->
    <div class="hidden md:block border-t border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-center gap-6 lg:gap-10 py-3">
                <a href="{{ route('home') }}" class="text-xs sm:text-sm font-semibold tracking-wider text-[#1B3B5A] uppercase hover:text-[#03a8f4] transition-colors">Home</a>
                <a href="{{ route('our-story') }}" class="text-xs sm:text-sm font-semibold tracking-wider text-[#1B3B5A] uppercase hover:text-[#03a8f4] transition-colors">Our Story</a>

                <!-- Products Dropdown -->
                <div class="relative group">
                    <a href="{{ route('products.index') }}" class="text-xs sm:text-sm font-semibold tracking-wider text-[#1B3B5A] uppercase flex items-center gap-1.5 hover:text-[#03a8f4] transition-colors">
                         Products and Services
                        <svg class="w-3.5 h-3.5 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </a>
                    <div class="absolute top-full left-0 mt-2 w-52 bg-white rounded-xl shadow-xl border border-slate-100 py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                        @foreach($headerProducts as $product)
                            <a href="{{ route('products.show', $product->slug) }}" class="block px-4 py-2.5 text-sm font-medium text-[#1B3B5A] hover:bg-slate-50 hover:text-[#03a8f4] transition-colors">
                                {{ $product->name }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <a href="{{ route('contact') }}" class="text-xs sm:text-sm font-semibold tracking-wider text-[#1B3B5A] uppercase hover:text-[#03a8f4] transition-colors">Contact</a>

                <!-- Desktop Log In Link -->
                <a href="{{ auth()->check() ? route('filament.admin.pages.dashboard') : route('login') }}" class="text-xs sm:text-sm font-semibold tracking-wider text-[#1B3B5A] uppercase hover:text-[#03a8f4] transition-colors flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-[#03a8f4]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                    <span id="nav-login-text">Log In</span>
                </a>

                <button onclick="openInquiryModal()" type="button" class="bg-[#03a8f4] hover:bg-[#0284c7] cursor-pointer text-white px-5 py-2 rounded-lg font-semibold text-xs uppercase tracking-wider transition-colors">Inquiry</button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu Drawer -->
    <div id="mobile-menu" class="md:hidden fixed inset-0 bg-white z-50 px-4 pb-6 pt-4 space-y-2 shadow-lg hidden overflow-y-auto top-14 sm:top-16">
        <!-- Mobile Drawer Search Bar -->
        <div class="relative w-full mb-3" id="drawer-search-wrapper">
            <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input type="text" id="drawer-search-input" placeholder="Search products & crafts..." autocomplete="off"
                class="w-full pl-10 pr-4 py-2.5 text-sm border border-slate-200 rounded-xl bg-slate-50 focus:ring-2 focus:ring-[#1B3B5A]/20 focus:border-[#1B3B5A] outline-none transition">
            <div id="drawer-search-results" class="hidden absolute top-full left-0 right-0 mt-2 bg-white rounded-xl shadow-xl border border-slate-100 py-2 z-50 max-h-60 overflow-y-auto"></div>
        </div>

        <a href="{{ route('home') }}" class="block py-3 px-4 rounded-lg {{ request()->routeIs('home') ? 'text-[#1B3B5A] bg-slate-100' : 'text-[#1B3B5A]' }} font-medium">Home</a>
        <a href="{{ route('our-story') }}" class="block py-3 px-4 rounded-lg {{ request()->routeIs('our-story*') ? 'text-[#1B3B5A] bg-slate-100' : 'text-[#1B3B5A]' }} font-medium">Our Story</a>
        <div>
            <button id="products-toggle" onclick="toggleProductsSubmenu(event)" type="button" class="w-full flex items-center justify-between py-3 px-4 rounded-lg text-[#1B3B5A] font-medium cursor-pointer">
                Products and Services
                <svg id="products-arrow" class="w-4 h-4 transition-transform duration-200 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </button>
            <div id="products-submenu" class="hidden pl-6 space-y-1">
                @foreach($headerProducts as $product)
                    <a href="{{ route('products.show', $product->slug) }}" class="block py-2 px-4 text-sm text-[#1B3B5A]/80 hover:text-[#1B3B5A]">{{ $product->name }}</a>
                @endforeach
            </div>
        </div>
        <a href="{{ route('contact') }}" class="block py-3 px-4 rounded-lg {{ request()->routeIs('contact') ? 'text-[#1B3B5A] bg-slate-100' : 'text-[#1B3B5A]' }} font-medium">Contact</a>

        <!-- Mobile Log In Link in Drawer -->
        <div class="pt-1">
            <a href="{{ auth()->check() ? route('filament.admin.pages.dashboard') : route('login') }}" class="flex items-center gap-2.5 py-3 px-4 rounded-lg text-[#1B3B5A] hover:bg-slate-50 font-medium transition-colors">
                <svg class="w-4 h-4 text-[#03a8f4]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                <span id="drawer-login-text">Log In</span>
            </a>
        </div>

        <button onclick="closeInquiryModal(); toggleMobileMenu(); setTimeout(function(){ openInquiryModal(); }, 300);" type="button" class="w-full block py-3 px-4 rounded-lg bg-[#03a8f4] hover:bg-[#0284c7] text-white font-medium text-center cursor-pointer">Inquiry</button>
    </div>
</nav>

<script>
// Language Switcher Helpers
function getGoogleTransCookie() {
    var match = document.cookie.match(/(?:^|;\s*)googtrans=([^;]*)/);
    return match ? decodeURIComponent(match[1]) : '';
}

function updateLanguageUI(lang) {
    var isBn = (lang === 'bn' || lang.indexOf('/bn') !== -1);
    
    // Desktop UI
    var langTextDesktop = document.getElementById('current-lang-text-desktop');
    if (langTextDesktop) langTextDesktop.textContent = isBn ? 'বাংলা' : 'English';
    var checkEnDesktop = document.getElementById('check-en-desktop');
    var checkBnDesktop = document.getElementById('check-bn-desktop');
    if (checkEnDesktop) checkEnDesktop.classList.toggle('hidden', isBn);
    if (checkBnDesktop) checkBnDesktop.classList.toggle('hidden', !isBn);

    // Mobile Header UI
    var langTextMobile = document.getElementById('current-lang-text-mobile');
    if (langTextMobile) langTextMobile.textContent = isBn ? 'বাংলা' : 'EN';
    var checkEnMobile = document.getElementById('check-en-mobile');
    var checkBnMobile = document.getElementById('check-bn-mobile');
    if (checkEnMobile) checkEnMobile.classList.toggle('hidden', isBn);
    if (checkBnMobile) checkBnMobile.classList.toggle('hidden', !isBn);

    // Brand Name and Tagline
    var brandName = document.getElementById('site-brand-name');
    var brandTagline = document.getElementById('site-brand-tagline');
    var footerBrandName = document.getElementById('footer-site-name');
    var footerCopyright = document.getElementById('footer-copyright-name');

    // Log In and Search Placeholders
    var navLogin = document.getElementById('nav-login-text');
    var drawerLogin = document.getElementById('drawer-login-text');
    var sInput = document.getElementById('search-input');
    var msInput = document.getElementById('mobile-search-input');
    var dsInput = document.getElementById('drawer-search-input');

    if (isBn) {
        if (brandName) {
            brandName.textContent = 'সানড্রি ব্লসম';
            brandName.style.webkitTextStroke = '0px';
            brandName.style.textShadow = 'none';
            brandName.style.fontFamily = "'Hind Siliguri', sans-serif";
        }
        if (brandTagline) {
            brandTagline.textContent = 'আমদানি রপ্তানি সংস্থা';
            brandTagline.style.letterSpacing = 'normal';
            brandTagline.style.textTransform = 'none';
            brandTagline.style.fontFamily = "'Hind Siliguri', sans-serif";
            brandTagline.style.fontSize = '12px';
            brandTagline.style.fontWeight = '600';
        }
        if (footerBrandName) footerBrandName.textContent = 'সানড্রি ব্লসম';
        if (footerCopyright) footerCopyright.textContent = 'সানড্রি ব্লসম';
        if (navLogin) navLogin.textContent = 'লগইন';
        if (drawerLogin) drawerLogin.textContent = 'লগইন';
        if (sInput) sInput.placeholder = 'পণ্য বা হস্তশিল্প অনুসন্ধান করুন...';
        if (msInput) msInput.placeholder = 'পণ্য বা হস্তশিল্প অনুসন্ধান করুন...';
        if (dsInput) dsInput.placeholder = 'পণ্য বা হস্তশিল্প অনুসন্ধান করুন...';
    } else {
        if (brandName) {
            brandName.textContent = "{{ $siteSettings['site_name'] ?? 'Sundry Blossom' }}";
            brandName.style.webkitTextStroke = '1px #000';
            brandName.style.textShadow = '1px 1px 0 #000';
            brandName.style.fontFamily = '';
        }
        if (brandTagline) {
            brandTagline.textContent = 'Import Export Agency';
            brandTagline.style.letterSpacing = '0.15em';
            brandTagline.style.textTransform = 'uppercase';
            brandTagline.style.fontFamily = '';
            brandTagline.style.fontSize = '';
            brandTagline.style.fontWeight = '';
        }
        if (footerBrandName) footerBrandName.textContent = "{{ $siteSettings['site_name'] ?? 'Sundry Blossom' }}";
        if (footerCopyright) footerCopyright.textContent = "{{ $siteSettings['site_name'] ?? 'Sundry Blossom' }}";
        if (navLogin) navLogin.textContent = 'Log In';
        if (drawerLogin) drawerLogin.textContent = 'Log In';
        if (sInput) sInput.placeholder = 'Search authentic Bangladeshi crafts...';
        if (msInput) msInput.placeholder = 'Search authentic crafts...';
        if (dsInput) dsInput.placeholder = 'Search products & crafts...';
    }
}

function handleLangSelect(lang) {
    var desktopMenu = document.getElementById('lang-menu-desktop');
    if (desktopMenu) desktopMenu.classList.add('hidden');
    var mobileMenu = document.getElementById('lang-menu-mobile');
    if (mobileMenu) mobileMenu.classList.add('hidden');
    var arrow = document.getElementById('lang-arrow-desktop');
    if (arrow) arrow.classList.remove('rotate-180');

    if (window.switchLanguage) {
        window.switchLanguage(lang);
    }
}

function toggleLangDropdown(e) {
    if (e && e.stopPropagation) e.stopPropagation();
    var menu = document.getElementById('lang-menu-desktop');
    var arrow = document.getElementById('lang-arrow-desktop');
    if (menu) {
        var isHidden = menu.classList.toggle('hidden');
        if (arrow) arrow.classList.toggle('rotate-180', !isHidden);
    }
}

function toggleMobileLangDropdown(e) {
    if (e && e.stopPropagation) e.stopPropagation();
    var menu = document.getElementById('lang-menu-mobile');
    if (menu) menu.classList.toggle('hidden');
}

function toggleMobileSearchBar() {
    var bar = document.getElementById('mobile-search-bar');
    if (bar) {
        var isHidden = bar.classList.toggle('hidden');
        if (!isHidden) {
            var input = document.getElementById('mobile-search-input');
            if (input) setTimeout(function() { input.focus(); }, 50);
        }
    }
}

// Close language menus and mobile search on outside click
document.addEventListener('click', function(e) {
    var desktopMenu = document.getElementById('lang-menu-desktop');
    var arrow = document.getElementById('lang-arrow-desktop');
    if (desktopMenu && !desktopMenu.classList.contains('hidden') && !e.target.closest('#desktop-lang-wrapper')) {
        desktopMenu.classList.add('hidden');
        if (arrow) arrow.classList.remove('rotate-180');
    }
    var mobileMenu = document.getElementById('lang-menu-mobile');
    if (mobileMenu && !mobileMenu.classList.contains('hidden') && !e.target.closest('#mobile-lang-wrapper')) {
        mobileMenu.classList.add('hidden');
    }
});

function handleSearchSubmit(e, inputId) {
    var input = document.getElementById(inputId);
    if (!input) return true;
    var query = input.value.trim();
    if (query.length < 1) {
        if (e && e.preventDefault) e.preventDefault();
        return false;
    }
    return true;
}
window.handleSearchSubmit = handleSearchSubmit;

document.addEventListener('DOMContentLoaded', function() {
    var transCookie = getGoogleTransCookie();
    var currentLang = (transCookie.includes('/bn') || transCookie === 'bn') ? 'bn' : 'en';
    updateLanguageUI(currentLang);
    window.updateLangSwitcherUI = updateLanguageUI;

    var allProducts = {!! json_encode(
        $headerProducts->map(function($p) {
            return [
                'name' => (string) ($p->name ?? ''),
                'slug' => (string) ($p->slug ?? ''),
                'url' => route('products.show', $p->slug),
                'image' => !empty($p->image) ? asset('storage/' . $p->image) : '',
            ];
        })->values()
    ) !!};

    function setupSearch(inputId, resultsId) {
        var input = document.getElementById(inputId);
        var results = document.getElementById(resultsId);
        if (!input || !results) return;

        // Prevent input blur before click registers on search suggestions
        results.addEventListener('mousedown', function(e) {
            e.preventDefault();
        });

        input.addEventListener('input', function() {
            var query = this.value.trim().toLowerCase();
            results.innerHTML = '';

            if (query.length < 1) {
                results.classList.add('hidden');
                return;
            }

            var matches = allProducts.filter(function(p) {
                return (p.name && p.name.toLowerCase().includes(query)) || (p.slug && p.slug.toLowerCase().includes(query));
            });

            if (matches.length === 0) {
                results.innerHTML = '<div class="px-4 py-3 text-sm text-slate-400">No matching products found</div>';
                results.classList.remove('hidden');
            } else {
                matches.slice(0, 8).forEach(function(p) {
                    var link = document.createElement('a');
                    link.href = p.url;
                    link.className = 'flex items-center gap-3 px-4 py-2.5 hover:bg-slate-50 transition-colors border-b border-slate-50 last:border-0';
                    
                    var imgHtml = p.image 
                        ? '<img src="' + p.image + '" alt="" class="w-8 h-8 rounded-lg object-cover shrink-0 border border-slate-100">'
                        : '<div class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center shrink-0 text-[#1B3B5A] text-xs font-bold">📦</div>';
                    
                    link.innerHTML = imgHtml + '<span class="text-sm text-[#1B3B5A] font-medium truncate">' + p.name + '</span>';
                    results.appendChild(link);
                });
                results.classList.remove('hidden');
            }
        });

        input.addEventListener('blur', function() {
            setTimeout(function() { results.classList.add('hidden'); }, 250);
        });

        input.addEventListener('focus', function() {
            if (this.value.trim().length >= 1) {
                this.dispatchEvent(new Event('input'));
            }
        });
    }

    // Attach search handlers to Desktop, Mobile Bar, and Drawer search inputs
    setupSearch('search-input', 'search-results');
    setupSearch('mobile-search-input', 'mobile-search-results');
    setupSearch('drawer-search-input', 'drawer-search-results');
});
</script>
