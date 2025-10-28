@extends('layouts.front-layout')
@section('content')
<!-- Hero Section -->
<header class="hero small">
  <div class="hero-content">
    <h1>Tentang Kami</h1>
    <p>Perjalanan panjang dalam menghadirkan rempah berkualitas sejak 1995.</p>
  </div>
</header>

<!-- Company Story -->
<section class="about-page-section">
  <div class="about-content">
    <h2>Cerita Kami</h2>
    <p>
      <strong>Bumbu Cantik</strong> berdiri sejak tahun 1995 sebagai usaha keluarga
      kecil yang menjual rempah segar di pasar tradisional. Dalam perjalanannya,
      kami tumbuh menjadi penyedia rempah dan bumbu berkualitas yang dipercaya
      pelanggan di dalam dan luar negeri.
    </p>
    <p>
      Kami berkomitmen untuk selalu menjaga keaslian rasa Nusantara melalui
      bahan-bahan alami, segar, dan tanpa pengawet. Dengan jaringan petani lokal,
      kami memastikan setiap rempah yang sampai ke dapur Anda memiliki kualitas terbaik.
    </p>
  </div>
</section>

<!-- Vision & Mission -->
<section class="vision-mission">
  <div class="vm-container">
    <div class="vm-card">
      <h3>Visi</h3>
      <p>
        Menjadi penyedia rempah dan bumbu alami terkemuka yang membawa cita rasa
        Nusantara ke seluruh dunia.
      </p>
    </div>
    <div class="vm-card">
      <h3>Misi</h3>
      <ul>
        <li>Mendukung petani lokal Indonesia.</li>
        <li>Menyediakan produk rempah alami berkualitas.</li>
        <li>Menghadirkan cita rasa autentik Nusantara ke pelanggan global.</li>
        <li>Memberikan pelayanan terbaik bagi semua pelanggan.</li>
      </ul>
    </div>
  </div>
</section>

<!-- Team Section -->
<section class="team">
  <h2>Tim Kami</h2>
  <div class="team-grid">
    <div class="team-member">
      <div class="photo"></div>
      <h4>Hendra Kho</h4>
      <p>Founder & CEO</p>
    </div>
    <div class="team-member">
      <div class="photo"></div>
      <h4>Siti Rahma</h4>
      <p>Head of Production</p>
    </div>
    <div class="team-member">
      <div class="photo"></div>
      <h4>Andi Saputra</h4>
      <p>Marketing Manager</p>
    </div>
  </div>
</section>
@endsection

@section('title')
  @include('layouts.includes.title', ['title' => 'Bumbu Cantik - Rempah Segar dan Bumbu Olahan'])
@endsection