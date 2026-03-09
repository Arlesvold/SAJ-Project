@extends('layouts.app')

@section('title', 'Go Green School - Sekolah Hijau untuk Masa Depan')

@section('content')
    {{-- Hero Section --}}
    @include('sections.hero')

    {{-- Eco Stats Strip --}}
    @include('sections.eco-strip')

    {{-- Programs Section --}}
    @include('sections.programs')

    {{-- Info Highlight --}}
    @include('sections.info-highlight')

    {{-- Gallery Section --}}
    @include('sections.gallery')

    {{-- Quick Access --}}
    @include('sections.quick-access')

    {{-- News Section --}}
    @include('sections.news')

    {{-- CTA Section --}}
    @include('sections.cta')

    {{-- Partners Section --}}
    @include('sections.partners')
@endsection
