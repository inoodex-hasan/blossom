@extends('frontend.layout.master')

@section('title', 'Sundry Blossom - Handcrafted & Sustainable Goods')

@section('bg')
    <div class="w-full h-full bg-[#fdf6f0] bg-[radial-gradient(#e5e7eb_1px,transparent_1px)] [background-size:24px_24px] opacity-40"></div>
@endsection

@section('hero')
    @include('frontend.layout.hero')
    @include('frontend.layout.tagline')
@endsection

@section('content')
    @include('frontend.layout.style-function')
    @include('frontend.layout.products')
@endsection

@section('journey')
    @include('frontend.layout.journey')
    @include('frontend.layout.cta')
@endsection
