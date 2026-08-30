@php
    $tagline = $siteSettings['site_tagline'] ?? 'Connecting Your Creations to Global Sales';
@endphp

<section class="py-4 sm:py-5 overflow-hidden bg-[#e08a45] select-none border-y border-amber-600/30">
    <div class="relative whitespace-nowrap overflow-hidden flex">
        <div class="animate-marquee inline-flex items-center shrink-0">
            @for ($i = 0; $i < 6; $i++)
                <span class="font-serif text-base sm:text-lg md:text-xl lg:text-2xl font-bold tracking-tight text-white mx-6 sm:mx-10 inline-flex items-center gap-4">
                    <span>{{ $tagline }}</span>
                    <span class="text-amber-200 text-xs">✦</span>
                </span>
            @endfor
        </div>
        <div class="animate-marquee inline-flex items-center shrink-0" aria-hidden="true">
            @for ($i = 0; $i < 6; $i++)
                <span class="font-serif text-base sm:text-lg md:text-xl lg:text-2xl font-bold tracking-tight text-white mx-6 sm:mx-10 inline-flex items-center gap-4">
                    <span>{{ $tagline }}</span>
                    <span class="text-amber-200 text-xs">✦</span>
                </span>
            @endfor
        </div>
    </div>

    <style>
        @keyframes marquee {
            0% { transform: translateX(0%); }
            100% { transform: translateX(-50%); }
        }
        .animate-marquee {
            animation: marquee 24s linear infinite;
        }
        .animate-marquee:hover {
            animation-play-state: paused;
        }
    </style>
</section>
