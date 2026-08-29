@extends('frontend.layout.master')

@section('title', '403 - Access Forbidden | ' . ($siteSettings['site_name'] ?? 'Sundry Blossom'))

@section('content')
<section class="min-h-[70vh] flex items-center justify-center py-20 px-5 sm:px-10">
    <div class="max-w-xl w-full text-center">
        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-orange-100 text-orange-800 text-xs font-semibold uppercase tracking-widest mb-6">
            <span class="w-2 h-2 rounded-full bg-orange-500"></span>
            Error 403
        </div>

        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-serif text-[#1B3B5A] mb-4">
            Access Restricted
        </h1>

        <p class="text-base sm:text-lg text-slate-600 leading-relaxed mb-8">
            You do not have permission to view this resource or perform this action.
        </p>

        <div class="flex flex-wrap items-center justify-center gap-3.5">
            <a href="{{ route('home') }}" 
               class="inline-flex items-center gap-2 bg-[#1B3B5A] hover:bg-[#152e46] text-white font-medium text-sm px-6 py-3 rounded-xl transition shadow-md">
                <span>Return to Homepage</span>
            </a>
        </div>
    </div>
</section>
@endsection
