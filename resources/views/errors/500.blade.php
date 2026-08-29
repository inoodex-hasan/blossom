@extends('frontend.layout.master')

@section('title', '500 - Server Error | ' . ($siteSettings['site_name'] ?? 'Sundry Blossom'))

@section('content')
<section class="min-h-[70vh] flex items-center justify-center py-20 px-5 sm:px-10">
    <div class="max-w-xl w-full text-center">
        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-red-100 text-red-800 text-xs font-semibold uppercase tracking-widest mb-6">
            <span class="w-2 h-2 rounded-full bg-red-500"></span>
            Error 500
        </div>

        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-serif text-[#1B3B5A] mb-4">
            Something Went Wrong
        </h1>

        <p class="text-base sm:text-lg text-slate-600 leading-relaxed mb-8">
            We are experiencing a temporary issue on our server. Our team has been alerted and is working to restore services shortly.
        </p>

        <div class="flex flex-wrap items-center justify-center gap-3.5">
            <a href="{{ route('home') }}" 
               class="inline-flex items-center gap-2 bg-[#1B3B5A] hover:bg-[#152e46] text-white font-medium text-sm px-6 py-3 rounded-xl transition shadow-md">
                <span>Return to Homepage</span>
            </a>

            <a href="{{ route('contact') }}" 
               class="inline-flex items-center gap-2 bg-slate-200 hover:bg-slate-300 text-slate-800 font-medium text-sm px-6 py-3 rounded-xl transition">
                <span>Contact Support</span>
            </a>
        </div>
    </div>
</section>
@endsection
