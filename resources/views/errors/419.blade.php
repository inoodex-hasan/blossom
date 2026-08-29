@extends('frontend.layout.master')

@section('title', '419 - Page Expired | ' . ($siteSettings['site_name'] ?? 'Sundry Blossom'))

@section('content')
<section class="min-h-[70vh] flex items-center justify-center py-20 px-5 sm:px-10">
    <div class="max-w-xl w-full text-center">
        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-100 text-amber-800 text-xs font-semibold uppercase tracking-widest mb-6">
            <span class="w-2 h-2 rounded-full bg-amber-500"></span>
            Error 419
        </div>

        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-serif text-[#1B3B5A] mb-4">
            Session Expired
        </h1>

        <p class="text-base sm:text-lg text-slate-600 leading-relaxed mb-8">
            Your security token has expired due to inactivity. Please refresh the page and try submitting your request again.
        </p>

        <div class="flex flex-wrap items-center justify-center gap-3.5">
            <button onclick="window.location.reload()" 
               class="inline-flex items-center gap-2 bg-[#03a8f4] hover:bg-[#0284c7] text-white font-medium text-sm px-6 py-3 rounded-xl transition shadow-md cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
                <span>Refresh Page</span>
            </button>

            <a href="{{ route('home') }}" 
               class="inline-flex items-center gap-2 bg-[#1B3B5A] hover:bg-[#152e46] text-white font-medium text-sm px-6 py-3 rounded-xl transition shadow-md">
                <span>Return to Homepage</span>
            </a>
        </div>
    </div>
</section>
@endsection
