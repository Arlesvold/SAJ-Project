@extends('layouts.app')
@section('title', 'Galeri - Go Green School')
@section('content')
<section class='section-padding' style='margin-top:80px;'>
<div class='container'>
<div class='section-header text-center'>
<span class='section-subtitle'>Galeri Kami</span>
<h2 class='section-title'>Dokumentasi Kegiatan</h2>
</div>
<div class='gallery-grid' style='display:grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;'>
    <img src='https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=400&q=80' alt='Galeri' style='width:100%; border-radius:10px;'>
    <img src='https://images.unsplash.com/photo-1497435334941-8c899ee9e8e9?w=400&q=80' alt='Galeri' style='width:100%; border-radius:10px;'>
</div>
</div>
</section>
@endsection
