<section class="component__update-form">
  <form action="{{route($routePrefix.'.updatePost', ['id' => $obj->id])}}"
    method="POST"
    enctype="multipart/form-data"
    autocomplete="off">
    @csrf

    <div class="form-group">
      <label>@lang('validation.attributes.supplier_id')</label> <span class="e_required">*</span>
      <select name="supplier_id"
        class="form-control form-control-sm">
        @php
          $oldValue = old('supplier_id') ? old('supplier_id') : $obj->supplier_id;
        @endphp
        @foreach(App\Models\Supplier::get() as $supplier)
          <option value="{{$supplier->id}}" {{ $oldValue == $supplier->id ? 'selected' : '' }}>
            {{$supplier->name}}
          </option>
        @endforeach
      </select>
      <span class="c_form__error-block">{{$errors->first('supplier_id')}}</span>
    </div>

    <div class="form-group">
      <label>@lang('validation.attributes.purchase_amount')</label>
      <input class="form-control form-control-sm"
        type="number"
        name="purchase_amount"
        value="{{old('purchase_amount') ? old('purchase_amount') : $obj->purchase_amount}}"
        placeholder="@lang('validation.attributes.purchase_amount')" />
      <span class="c_form__error-block">{{$errors->first('purchase_amount')}}</span>
    </div>

    <div class="form-group">
      <label>@lang('validation.attributes.purchase_at')</label> <span class="e_required">*</span>
      <input class="form-control form-control-sm"
        id="purchase_at"
        name="purchase_at"
        value="{{old('purchase_at') ? old('purchase_at') : $obj->purchase_at}}"
        placeholder="@lang('validation.attributes.purchase_at')" />
      <span class="c_form__error-block">{{$errors->first('purchase_at')}}</span>
    </div>

    <div class="form-group">
      <label>@lang('validation.attributes.note')</label>
      <textarea class="form-control form-control-sm"
        name="note"
        rows="5"
        placeholder="@lang('validation.attributes.note')">{{ old('note') ? old('note') : $obj->note }}</textarea>
      <span class="c_form__error-block">{{$errors->first('note')}}</span>
    </div>

    <div class="form-group">
      <label>@lang('validation.attributes.purchase_status')</label> <span class="e_required">*</span>
      <select name="purchase_status"
        class="form-control form-control-sm">
        @php
          $oldValue = old('purchase_status') ? old('purchase_status') : $obj->purchase_status;
        @endphp
        @foreach(App\Helpers\ApplicationConstant::EXPENSE_STATUS as $key => $value)
          <option value="{{$key}}" {{ $oldValue == $key ? 'selected' : '' }}>
            @lang('application-constant.EXPENSE_STATUS.'.$value)
          </option>
        @endforeach
      </select>
      <span class="c_form__error-block">{{$errors->first('purchase_status')}}</span>
    </div>
    
    <div>
      <button type="submit" class="btn btn-outline-primary">
        <span class="action-icon">
          <i class="c_icon fas fa-save menu-icon"></i> @lang('common.save')
        </span>
      </button>
      <button type="button"
        class="btn btn-outline-primary add"
        data-toggle="modal"
        data-target="#entry-purchase-item">
        <span class="action-icon">
          <i class="c_icon fas fa-add menu-icon"></i> @lang('common.entry-purchase-item')
        </span>
      </button>
    </div>
  </form>
  <hr />
  
  <table class="grid-table table table-striped table-bordered table-responsive-sm">
    @include('components.table.header',[
      'headers' => [
        'action' => ['sortable' => false, 'title' => trans('common.action')],
        'asset_id' => ['sortable' => true, 'title' => trans('validation.attributes.asset_id')],
        'product_id' => ['sortable' => true, 'title' => trans('validation.attributes.product_id')],
        'purchase_category' => ['sortable' => true, 'title' => trans('validation.attributes.purchase_category')],
        'purchase_price' => ['sortable' => true, 'title' => trans('validation.attributes.purchase_price')],
        'purchase_qty' => ['sortable' => true, 'title' => trans('validation.attributes.purchase_qty')],
        'expire_at' => ['sortable' => true, 'title' => trans('validation.attributes.expire_at')],
      ]
    ])
    <tbody>
    @foreach($obj->purchaseDetails as $detail)
      <tr>
        <td>
          <div class="icon-wrapper">
            <span class="action-icon edit" 
              data-toggle="modal"
              data-target="#entry-purchase-item">
              <i class="c_icon icon fas fa-pencil menu-icon" title="edit"></i>
            </span>
          </div>
          
          <div class="icon-wrapper">
            <span class="action-icon delete-prs"
              onClick="document.getElementById('delete-purchase-item-{{$detail->id}}').submit()">
              <i class="c_icon icon fas fa-trash menu-icon" title="delete"></i>
            </span>
          </div>
          <form action="{{ route($routePrefix.'.deletePurchaseItemPost', ['id' => $obj->id]) }}"
            id="delete-purchase-item-{{$detail->id}}"
            method="POST"
          >
            @csrf
            <input type="hidden" name="purchase_detail_id" class="purchase_detail_id" value="{{$detail->id}}" />
          </form>
        </td>
        <td>{{$detail->asset?->asset_name}}<input type="hidden" class="asset_id-ref" value="{{$detail->asset_id}}" /></td>
        <td>{{$detail->product?->product_name}}<input type="hidden" class="product_id-ref" value="{{$detail->product_id}}" /></td>
        <td>@lang('application-constant.PURCHASE_CATEGORY.'.App\Helpers\ApplicationConstant::PURCHASE_CATEGORY[$detail->purchase_category])<input type="hidden" class="purchase_category-ref" value="{{$detail->purchase_category}}" /></td>
        <td>{{\App\Utils\NumberUtil::currencyFormat($detail->purchase_price)}}<input type="hidden" class="purchase_price-ref" value="{{$detail->purchase_price}}" /></td>
        <td>{{\App\Utils\NumberUtil::numberFormat($detail->purchase_qty)}}<input type="hidden" class="purchase_qty-ref" value="{{$detail->purchase_qty}}" /></td>
        <td class="expire_at-ref">{{$detail->expire_at}}</td>
      </tr>
    @endforeach
    </tbody>
  </table>
</section>

<section class="component__entry-form">
  <div class="modal fade" id="entry-purchase-item"
    role="dialog"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="card">
          <div class="card-header"><i class="c_icon fas fa-file-pen menu-icon"></i> @lang('common.entry-purchase-item')</div>
          <div class="card-body">
            <form action="{{ route($routePrefix.'.updatePurchaseItemPost', ['id' => $obj->id]) }}"
              id="update-purchase-item-form"
              method="POST"
              enctype="multipart/form-data"
              autocomplete="off">
              @csrf
              <input type="hidden" name="purchase_id" value="{{$obj->id}}" />
              <input type="hidden" name="purchase_detail_id" id="purchase_detail_id" />

              <div class="form-group">
                <label>@lang('validation.attributes.asset_id')</label>
                <select name="asset_id"
                  class="form-control form-control-sm"
                  id="asset_id">
                  <option></option>
                  @foreach(App\Models\Asset::get() as $asset)
                    <option value="{{$asset->id}}" {{ old('asset_id') == $asset->id ? 'selected' : '' }}>
                      {{ $asset->asset_name }}
                    </option>
                  @endforeach
                </select>
                <span class="c_form__error-block">{{$errors->first('asset_id')}}</span>
              </div>

              <div class="form-group">
                <label>@lang('validation.attributes.product_id')</label>
                <select name="product_id"
                  class="form-control form-control-sm"
                  id="product_id">
                  <option></option>
                  @foreach(App\Models\Product::get() as $product)
                    <option value="{{$product->id}}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                    {{ $product->product_name }} - {{ $product->product_name }}
                    </option>
                  @endforeach
                </select>
                <span class="c_form__error-block">{{$errors->first('product_id')}}</span>
              </div>

              <div class="form-group">
                <label>@lang('validation.attributes.purchase_category')</label> <span class="e_required">*</span>
                <select name="purchase_category"
                  class="form-control form-control-sm"
                  id="purchase_category">
                  @foreach(App\Helpers\ApplicationConstant::PURCHASE_CATEGORY as $key => $value)
                    <option value="{{$key}}" {{ old('purchase_category') == $key ? 'selected' : '' }}>
                      @lang('application-constant.PURCHASE_CATEGORY.'.$value)
                    </option>
                  @endforeach
                </select>
                <span class="c_form__error-block">{{$errors->first('purchase_category')}}</span>
              </div>

              <div class="form-group">
                <label>@lang('validation.attributes.purchase_price')</label> <span class="e_required">*</span>
                <div class="input-group mb-3">
                  <input class="form-control form-control-sm"
                    id="purchase_price"
                    type="number"
                    value="{{ old('purchase_price')}}"
                    name="purchase_price"
                    placeholder="@lang('validation.attributes.purchase_price')" />
                </div>
                <span class="c_form__error-block">{{$errors->first('purchase_price')}}</span>
              </div>

              <div class="form-group">
                <label>@lang('validation.attributes.purchase_qty')</label> <span class="e_required">*</span>
                <div class="input-group mb-3">
                  <input class="form-control form-control-sm"
                    id="purchase_qty"
                    type="number"
                    value="{{ old('purchase_qty')}}"
                    name="purchase_qty"
                    placeholder="@lang('validation.attributes.purchase_qty')" />
                </div>
                <span class="c_form__error-block">{{$errors->first('purchase_price')}}</span>
              </div>

              <div class="form-group">
                <label>@lang('validation.attributes.expire_at')</label>
                <div class="input-group mb-3">
                  <input class="form-control form-control-sm expire_at"
                    id="expire_at"
                    value="{{ old('expire_at')}}"
                    name="expire_at"
                    placeholder="@lang('validation.attributes.expire_at')" />
                </div>
                <span class="c_form__error-block">{{$errors->first('expire_at')}}</span>
              </div>

              <button type="button" class="btn btn-outline-primary reset">
                <span class="action-icon">
                  <i class="c_icon fas fa-sync menu-icon"></i> @lang('common.reset')
                </span>
              </button>
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
</section>


@push('javascript')
<script>
  $(document).ready(function() {
    $('.reset').click(function() {
      resetEntryForm();
    });

    $('.add').click(function() {
      resetEntryForm();
    });
    @if(old('purchase_detail_id') || session('error'))
      $('#entry-purchase-item').modal('show');
      $('#purchase_detail_id').val("{{old('purchase_detail_id')}}");
    @endif

    $('.edit').click(function() {
      parent = $(this).parent().parent().parent();
      console.log(parent.html());
      console.log(parent.find('.purchase_category-ref').val());

      $('#purchase_detail_id').val(parent.find('.purchase_detail_id').val());
      $('#asset_id').val(parent.find('.asset_id-ref').val());
      $('#purchase_category').val(parent.find('.purchase_category-ref').val());
      $('#product_id').val(parent.find('.product_id-ref').val());
      $('#purchase_price').val(parent.find('.purchase_price-ref').html());
      $('#purchase_qty').val(parent.find('.purchase_qty-ref').html());
      $('#expire_at').val(parent.find('.expire_at-ref').html());
    });

    function resetEntryForm() {
      $('#purchase_detail_id').val("");
      $('#purchase_category').val("");
      $('#purchase_price').val("");
      $('#purchase_qty').val("");
      $('#expire_at').val("");
    };

    $('#purchase_at, .expire_at').flatpickr({
      locale: document.documentElement.lang,
      enableTime: true,
      dateFormat: "Y-m-d H:i",
      time_24hr: true,
      disableMobile: true
    });

  });
</script>
@endpush