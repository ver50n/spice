@extends('layouts.drawer-layout')

@section('content')
<div class="container-wrapper">
  <div class="drawer-wrapper">
    <div class="product-list">
      <h3>Kasir</h3>
      <hr />
      <div class="product-search">
        <div class="input-group product-search">
          <input type="text" class="form-control" id="product-search-text" placeholder="Nama Produk">
          <div class="input-group-append" id="clear-product-search-text">
            <span class="input-group-text"><i class="fa-solid fa-trash"></i></span>
          </div>
        </div>
      </div>

      <div class="table-product-wrapper">
        <table class="table" id="table-product">
          <thead>
            <tr>
              <th>Foto</th>
              <th>Produk</th>
            </tr>
          </thead>
          <tbody>
          @foreach(\App\Models\Product::get() as $product)
            <tr>
              <td class="product-image"><div class="product-img" style="background: url('/images/{{ $product->product_thumbnail }}') center; width: 100px; height: 100px; background-size: cover;"></div></td>
              <td class="product-name-wrapper">
                <span class="product-category"><small><i>@lang('application-constant.PRODUCT_CATEGORY.'.App\Helpers\ApplicationConstant::PRODUCT_CATEGORY[$product->product_category])</i></small></span><br />
                <span class="product-name">{{$product->product_name}}</span><br />
                <div class="product-variant-wrapper">
                @foreach($product->productVariants as $variant)
                @if($variant->variant_name == 'custom')
                  <input type="text" class="form-control form-control-sm" placeholder="Berat" />
                  <input type="text" class="form-control form-control-sm" placeholder="Harga" />
                  <button type="button" class="btn btn-primary product-variant"
                    data-variant-id="{{$variant->id}}"
                    data-variant-category="@lang('application-constant.PRODUCT_CATEGORY.'.App\Helpers\ApplicationConstant::PRODUCT_CATEGORY[$product->product_category])"
                    data-variant-name="{{$product->product_name.' ('.$variant->variant_name.') '}}"
                    data-variant-qty="1"
                    data-variant-price="{{$variant->variant_price}}">{{$variant->variant_name}}</button>
                @else
                  <button type="button" class="btn btn-primary product-variant"
                    data-variant-id="{{$variant->id}}"
                    data-variant-category="@lang('application-constant.PRODUCT_CATEGORY.'.App\Helpers\ApplicationConstant::PRODUCT_CATEGORY[$product->product_category])"
                    data-variant-name="{{$product->product_name.' ('.$variant->variant_name.') '}}"
                    data-variant-qty="1"
                    data-variant-price="{{$variant->variant_price}}">{{$variant->variant_name}}<br /> {{\App\Utils\NumberUtil::currencyFormat($variant->variant_price)}}</button>
                @endif
                @endforeach
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

    <div class="cart">
      <div class="register-status">
        <h4>Penjualan Hari ini : Rp. 209.000</h4>
        <h4>Cash Terakhir : Rp. 100.000</h4>
        <h4>Status : 
        <button type="button" class="btn btn-danger" id="cancel-cart"><i class='fa-solid fa-scale-unbalanced'></i> (Rp. -109.000)</button></h4>
      </div>

      <br />

      <table class="table cart-items">
        <thead>
          <tr>
            <th>Produk / Varian</th>
            <th>Qty</th>
            <th>Harga</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody id="cart-items-body">
        </tbody>
      </table>
      
      <hr />
      
      <div class="cart-summary">
        <table class="table cart-summary">
          <tbody>
            <tr><td>Grand Total</td><td>Rp. <span class="grand-total"></span></td></tr>
            <tr>
              <td>Jumlah Bayar</td>
              <td class="pay-amount">
              <div class="input-group pay-amount-wrapper">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa-solid fa-rupiah-sign"></i></span>
                </div>
                <input type="number" class="form-control" id="pay-amount" required>
              </td>
            </tr>
            <tr><td>Kembalian</td><td>Rp. <span id="change-amount"></span></td></tr>
          </tbody>
        </table>
      </div>

      <hr />
      
      <button type="button" class="btn btn-danger" id="cancel-cart"><i class='fa-solid fa-xmark'></i> Cancel</button>
      <button type="button" class="btn btn-primary" id="checkout-cart"><i class='fa-solid fa-basket-shopping'></i> Checkout</button>
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#update-cash" id="cancel-cart"><i class='fa-solid fa-money-bills'></i> Perbaharui Cash</button>
      <button type="button" class="btn btn-secondary" id="cancel-cart"><i class='fa-solid fa-floppy-disk'></i> Simpan Riwayat</button>
    </div>
  </div>
</div>

<div class="modal fade" id="update-cash"
  role="dialog"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="card">
        <div class="card-header"><i class="c_icon fas fa-file-pen menu-icon"></i> Perbaharui Cash</div>
        <div class="card-body">
          <form action="#"
            id="update-cash-form"
            method="POST"
            enctype="multipart/form-data"
            autocomplete="off">
            @csrf
            
            <table class="table table-update-cash">
              <thead>
                <tr>
                  <th>Pecahan</th>
                  <th>Qty</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                @php
                $grandTotalCash = 0;
                foreach($cash as $item) {
                @endphp
                <tr><td>Rp. {{$item['cash_id']}}</td><td><input type="number" class="cash-qty" data-id="{{$item['cash_id']}}" value="{{$item['cash_qty']}}" /></td><td>Rp. <span class="total">{{\App\Utils\NumberUtil::numberFormat($item['cash_total'])}}</span></td></tr>
                @php
                $grandTotalCash += $item['cash_total'];
                }
                @endphp
              </tbody>
              <tfoot>
                <tr>
                  <th scope="row" colspan="2">Grand Total</th>
                  <td>Rp. <span id="cash-grand-total">{{\App\Utils\NumberUtil::numberFormat($grandTotalCash)}}</span></td>
                </tr>
              </tfoot>
            </table>
            
            <hr />

            <button type="submit" class="btn btn-outline-primary">
              <span class="action-icon">
                <i class="c_icon fas fa-save menu-icon"></i> @lang('common.save')
              </span>
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('title')
  @include('layouts.includes.title', ['title' => \Lang::get('common.drawer')])
@endsection
<style>
  #app {
    margin: 0px;
  }
  .container-fluid {
    padding: 0px !important;
    background: #EFEFEF;
  }
  .drawer-wrapper {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    height: 100vh;
  }
  .table-product-wrapper {
    overflow: scroll;
    height: 100vh;
  }
  .product-list {
    flex: 0 40%;
    background: #F8F8F8;
    padding: 10px;
  }
  .product-search {
    margin-top: 10px;
    margin-bottom: 10px;
  }
  .product-image {
    width: 80px;
    height: 80px;
  }
  .product-variant-wrapper {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: left;
  }
  .product-variant {
    margin-right: 5px;
  }
  .table tr td {
    border: 0;
  }
  
  .cart {
    flex: 0 60%;
    background: #F8F8F8;
    padding: 10px;
  }
</style>

@push('javascript')
<script>
  $('document').ready(function() {
    let cartItems = [];
    let grandTotal = 0;
    let cashGrandTotal = 0;
    let cash = {!! json_encode($cash, false) !!};
    
    $('#product-search-text').keyup(function() {
      searchProduct();
    });

    $('#clear-product-search-text').click(function() {
      $("#product-search-text").val("");
      searchProduct();
    });

    $('.product-variant').click(function() {
      addToCart($(this))
    });
    $('#cart-items-body').on('click', '.delete-item', function() {
      deleteCart($(this));
    });
    $('#cart-items-body').on('change', '.item-qty', function() {
      updateCart($(this));
    });
    $('#pay-amount').change(function() {
      calculateChange($(this));
    });
    $('.cash-qty').change(function() {
      updateCash($(this));
    });

    function searchProduct() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("product-search-text");
      filter = input.value.toUpperCase();
      table = document.getElementById("table-product");
      tr = table.getElementsByTagName("tr");

      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1];
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
      }
    }

    function addToCart(el) {
      let variantId = el.attr("data-variant-id");
      let variantName = el.attr("data-variant-name");
      let idx = cartItems.findIndex(function(item) {
        return item.variant_id == variantId
      });
      
      if (variantName.toLowerCase().includes("custom") || idx < 0) {
        let item = {
          'variant_id': variantId,
          'variant_category': el.attr("data-variant-category"),
          'variant_name': el.attr("data-variant-name"),
          'variant_qty': parseInt(el.attr("data-variant-qty")),
          'variant_price': parseInt(el.attr("data-variant-price")),
        }
        item.variant_total =  item.variant_qty * item.variant_price;
        cartItems.push(item);
      } else {
        cartItems[idx].variant_qty += 1;
        cartItems[idx].variant_total = cartItems[idx].variant_qty * cartItems[idx].variant_price;
      }
      renderCart();
    }

    function updateCart(el) {
      let qty = el.val();
      let variantId = el.attr("data-variant-id");
      let idx = cartItems.findIndex(function(item) {
        return item.variant_id == variantId
      });
      cartItems[idx].variant_qty = qty;
      cartItems[idx].variant_total = cartItems[idx].variant_qty * cartItems[idx].variant_price;
      renderCart();
    }

    function deleteCart(el) {
      let variantId = el.attr("data-variant-id");
      let idx = cartItems.findIndex(function(item) {
        return item.variant_id == variantId
      });
      cartItems.splice(idx, 1);
      renderCart();
    }

    function renderCart() {
      $('#cart-items-body').html("");
      grandTotal = 0;
      cartItems.forEach(item => {
        grandTotal += item.variant_total;
        let tr = "";
        tr += "<tr>"
          tr += "<td class='item-name'><span><small><i>" + item.variant_category + "</i></small><br />" + item.variant_name +  "</span></td>";
          tr += "<td class='item-qty-wrapper'>";
            tr += "<div class='input-group'>";
              tr += "<input type='number' class='form-control item-qty' data-variant-id='" + item.variant_id +"' required value='" + item.variant_qty + "'>";
              tr += "<div class='input-group-append delete-item' data-variant-id='" + item.variant_id +"'>";
                tr += "<span class='input-group-text'><i class='fa-solid fa-trash'></i></span>";
              tr += "</div>";
            tr += "</div>";
          tr += "</td>";
          tr += "<td>";
            tr += "<div class='input-group mb-2'>";
              tr += "<div class='input-group-prepend'>";
                tr += "<div class='input-group-text'>Rp. </div>";
              tr += "</div>";
              tr += "<input type='number' class='form-control' id='inlineFormInputGroup' value='"+item.variant_price+"' required>";
            tr += "</div>";
          tr += "</td>";
          tr += "<td class='item-total'>Rp. " + parseInt(item.variant_total).toLocaleString('id') + "</td>";
        tr += "</tr>";
        $('#cart-items-body').append(tr);
      });
      $('.grand-total').html(parseInt(grandTotal).toLocaleString('id'));
    }

    function calculateChange(el) {
      paidAmount = el.val();
      $('#change-amount').html(parseInt(paidAmount - grandTotal).toLocaleString('id'));
    }

    function updateCash(el) {
      let cashId = el.attr('data-id');
      let idx = cash.findIndex(function(item) {
        return item.cash_id == cashId
      });
      let qty = el.val();
      let total = qty * cashId;
      cash[idx].cash_qty = qty;
      cash[idx].cash_total = total;

      el.parent().parent().find('.total').html(parseInt(total).toLocaleString('id'));
      updateCashGrandTotal();
    }

    function updateCashGrandTotal() {
      cashGrandTotal = 0;
      cash.forEach(item => {
        cashGrandTotal += item.cash_total
      });
      $('#cash-grand-total').html(parseInt(cashGrandTotal).toLocaleString('id'));
    }
  });
</script>
@endpush
