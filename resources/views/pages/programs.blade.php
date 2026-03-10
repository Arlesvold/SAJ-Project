@extends('layouts.app')
@section('title', 'Program - Go Green School')
@section('content')
<section class='section-padding' style='margin-top:80px;'>
<div class='container'>
<div class='section-header text-center'>
<span class='section-subtitle'>Program Kami</span>
<h2 class='section-title'>Program Berkelanjutan</h2>
</div>
<div class='programs-grid'>
    <div class='program-card text-center'>
        <div class='program-icon'><i class='fas fa-recycle'></i></div>
        <h3>Bank Sampah</h3>
        <p>Program pemilahan dan daur ulang sampah yang melibatkan seluruh elemen sekolah.</p>
    </div>
    <div class='program-card text-center'>
        <div class='program-icon'><i class='fas fa-seedling'></i></div>
        <h3>Kebun Sekolah</h3>
        <p>Edukasi bercocok tanam organik untuk menumbuhkan kemandirian pangan.</p>
    </div>
</div>
</div>
</section>
@endsection
