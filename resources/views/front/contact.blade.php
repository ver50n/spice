@extends('layouts.front-layout')

@section('content')
<header class="hero small">
  <div class="hero-content">
    <h1>Hubungi Kami</h1>
    <p>Kami siap melayani Anda dengan sepenuh hati.</p>
  </div>
</header>

<section class="contact-form-section">
  <h2>Kirim Pesan</h2>
  <form class="contact-form">
    <input type="text" placeholder="Nama Lengkap" required>
    <input type="email" placeholder="Email" required>
    <input type="tel" placeholder="Nomor Telepon" required>
    <textarea placeholder="Pesan Anda" required></textarea>
    <button type="submit">Kirim</button>
  </form>
</section>

<section class="contact-info">
  <h2>Informasi Kontak</h2>
  <p><strong>Alamat: </strong> Jl. Veteran No. 73, Tanjung Balai Asahan, Sumatera Utara</p>
  <p><strong>Web: </strong> info@bumbu-cantik.com</p>
  <p><strong>Telepon:</strong> +62 852 6106 3334</p>
</section>
@endsection

@section('title')
  @include('layouts.includes.title', ['title' => 'Bumbu Cantik - Rempah Segar dan Bumbu Olahan'])
@endsection