@extends('layouts.front-layout')

@section('content')
<!-- Hero Section -->
<header class="hero" style="background: url('images/header-background.jpg') center/cover no-repeat;">
  <div class="hero-content">
    <h1>Bumbu Cantik</h1>
    <p>Temukan cita rasa dengan bahan segar dan alami.</p>
    <a href="{{ route('about') }}"><button>Pelajari Lebih Lanjut</button></a>
  </div>
</header>

<!-- About Section -->
<section class="about">
  <h2>Tentang Kami</h2>
  <p><strong>Bumbu Cantik</strong> telah berdiri sejak tahun 1999 dengan melayani penjualan rempah skala rumah hingga restoran dan pesta. Menjual aneka bumbu basah segar setiap hari dan resep yang bisa disesuaikan dengan permintaan. Menerima bumbu vegetarian juga.</p>
</section>

<!-- Services Section -->
<section class="services">
  <h2>Layanan Kami</h2>
  <div class="service-grid">
    <div class="service-card">
      <h3>Rempah Segar</h3>
      <p>Menyediakan berbagai rempah alami pilihan langsung dari petani.</p>
    </div>
    <div class="service-card">
      <h3>Bumbu Olahan</h3>
      <p>Bumbu siap pakai untuk kebutuhan dapur dan usaha kuliner.</p>
    </div>
    <div class="service-card">
      <h3>Jasa Giling</h3>
      <p>Layanan giling rempah segar untuk hasil yang lebih autentik.</p>
    </div>
  </div>
</section>

<!-- Gallery Section -->
<section class="gallery">
  <h2>Galeri Produk</h2>
  <div class="gallery-grid">
    <div class="gallery-item"></div>
    <div class="gallery-item"></div>
    <div class="gallery-item"></div>
    <div class="gallery-item"></div>
    <div class="gallery-item"></div>
    <div class="gallery-item"></div>
  </div>
</section>
@endsection

@section('title')
  @include('layouts.includes.title', ['title' => 'Bumbu Cantik - Rempah Segar dan Bumbu Olahan'])
@endsection
