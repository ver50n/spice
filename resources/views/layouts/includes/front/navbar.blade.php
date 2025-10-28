<nav class="navbar">
  <div class="nav-container">
    <a href="i{{ route('landing') }}" class="logo" style="display: flex; align-items: center; gap: 8px;">
      <img src="{{ mix('images/logo.png') }}" width="35" alt="Bumbu Cantik Logo" />
      <span style="display: flex; align-items: center;">Bumbu Cantik</span>
    </a>
    <button class="nav-toggle">☰</button>
    <ul class="nav-menu">
      <li><a href="{{ route('landing') }}" class="active">Home</a></li>
      <li><a href="{{ route('products') }}">Product</a></li>
      <li><a href="{{ route('about') }}">About Us</a></li>
      <li><a href="{{ route('contact') }}">Contact</a></li>
    </ul>
  </div>
</nav>