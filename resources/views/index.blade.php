@extends('frontend.layout.master')

@section('title', 'Sundry Blossom l Import Export Agency l Connecting your creation to global sales.')

@section('meta_description', 'Sundry Blossom | Import Export Agency')
@section('og_title', 'Sundry Blossom')
@section('og_description', 'Sundry Blossom | Import Export Agency')

@section('bg')
    <div class="w-full h-full">
        <img src="{{ asset('assets/images/bg.jpeg') }}" alt="" class="w-full h-full object-cover opacity-25">
    </div>
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
