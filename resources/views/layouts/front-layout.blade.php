<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

  @yield('title')
  @include('layouts.includes.front.asset')
  @include('layouts.includes.front.header')
  </head>
  <body>
    <!-- Navbar -->
    @include('layouts.includes.front.navbar')

    @yield('content')
    <!-- Contact CTA -->
    <section class="contact">
      <h2>Hubungi Kami</h2>
      <p>Ingin bekerja sama atau memesan produk kami? Hubungi tim kami sekarang!</p>
      <div class="contact-buttons">
        <a href="contact.html" class="btn-light">WhatsApp</a>
        <a href="contact.html" class="btn-dark">Email Kami</a>
      </div>
    </section>

    <!-- Footer -->
    <footer>
      © <span id="year"></span> Bumbu Cantik. All Rights Reserved.
    </footer>

  </body>
</html>