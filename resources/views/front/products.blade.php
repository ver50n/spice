@extends('layouts.front-layout')

@section('content')
<!-- Hero -->
<header class="hero small">
  <div class="hero-content">
    <h1>Produk Kami</h1>
    <p>Temukan berbagai rempah dan bumbu berkualitas dari Nusantara.</p>
  </div>
</header>

<!-- Filter Kategori -->
<section class="product-filter">
  <h2>Kategori</h2>
  <div class="filter-buttons">
    <button class="filter-btn active" data-category="all">Semua</button>
    <button class="filter-btn" data-category="raw">Rempah Segar</button>
    <button class="filter-btn" data-category="base">Bumbu Dasar</button>
    <button class="filter-btn" data-category="recipe">Bumbu Racik</button>
    <button class="filter-btn" data-category="mill">Jasa Giling</button>
  </div>
</section>



  @if(isset($products) && $products->count())
    <!-- Produk Grid -->
    <section class="product-grid">
      @foreach($products as $product)
        <div class="product-card" data-category="{{ $product->product_category }}" data-detail="{{ $product->id }}">
          <div class="product-img" style="background: url('/images/{{ $product->product_thumbnail }}')"></div>
          <h3>{{ $product->product_name }}</h3>
          <p>{{ \Illuminate\Support\Str::limit($product->product_desc ?? '', 80) }}</p>
        </div>
      @endforeach
    </div>
  @else
    <p>Tidak ada produk untuk ditampilkan.</p>
  @endif
</section>

<!-- Popup Modal Detail Produk -->
<div id="product-modal" class="modal">
  <div class="modal-content">
    <span class="close-btn">×</span>
    <div class="modal-image">
      <img id="modal-img" src="" alt="Produk" />
    </div>
    <div class="modal-info">
      <h2 id="modal-title">Nama Produk</h2>
      <p id="modal-category" class="category"></p>
      <p id="modal-price" class="price"></p>
      <p id="modal-desc" class="description"></p>
      
      <div id="modal-variants" class="variant-list"></div>
    </div>
  </div>
</div>
@endsection

@push('javascript')
<script>

  // Data Produk (bisa juga nanti dari database)
  const products = JSON.parse({!! $products_json !!});
  
  $(function() {
    var $filterButtons = $('.filter-btn');
    var $productCards = $('.product-card');

    $filterButtons.on('click', function() {
      $filterButtons.removeClass('active');
      var $btn = $(this).addClass('active');

      var category = $btn.attr('data-category');
      $productCards.each(function() {
        var $card = $(this);
        var cardCategory = $card.attr('data-category');
        if (category === 'all' || cardCategory === category) {
          $card.show();
        } else {
          $card.hide();
        }
      });
    });

    function openModal(index) {
      const product = products[index];
      document.getElementById('modal-title').textContent = product.product_name;
      document.getElementById('modal-category').textContent = `Kategori: ${product.product_category}`;
      document.getElementById('modal-price').textContent = product.product_price;
      document.getElementById('modal-desc').textContent = product.product_desc;
      document.getElementById('modal-img').src = '/images/'+product.product_thumbnail;

      // Buat daftar varian dan harga
      const variantContainer = document.getElementById('modal-variants');
      variantContainer.innerHTML = product.product_variants.map(v => `
        <div class="variant-item">
          <span class="variant-name">${v.variant_name}</span>
          <span class="variant-price">${v.variant_price}</span>
        </div>
      `).join('');

      document.getElementById('product-modal').classList.add('show');
      document.body.style.overflow = 'hidden';
    }

    function closeModal() {
      document.getElementById('product-modal').classList.remove('show');
      document.body.style.overflow = 'auto';
    }

    // Klik di luar modal untuk close
    $('#product-modal, .close-btn').on('click', function(e) {
      if (e.target === this) {
        closeModal();
      }
    });
    
    // Klik di luar modal untuk close
    $('.product-card').on('click', function(e) {
      openModal(this.getAttribute('data-detail') - 1);
    });
  });
</script>
@endpush

@section('title')
  @include('layouts.includes.title', ['title' => 'Bumbu Cantik - Rempah Segar dan Bumbu Olahan'])
@endsection