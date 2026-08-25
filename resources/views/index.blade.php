@extends('frontend.layout.master')

@section('title', 'Sundry Blossom - Handcrafted & Sustainable Goods')

@section('bg')
    <img src="{{ asset('assets/images/bg.jpeg') }}" alt="" class="w-full h-full object-cover opacity-25">
@endsection

@section('hero')
    @include('frontend.layout.hero')
@endsection

@section('content')
    @include('frontend.layout.style-function')
    @include('frontend.layout.products')
@endsection

@section('journey')
    @include('frontend.layout.journey')
    @include('frontend.layout.cta')
@endsection
