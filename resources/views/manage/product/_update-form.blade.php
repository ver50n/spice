<section class="component__update-form">
  <form action="{{route($routePrefix.'.updatePost', ['id' => $obj->id])}}"
    method="POST"
    enctype="multipart/form-data"
    autocomplete="off">
    @csrf
    
    <div class="form-group">
      <label>@lang('validation.attributes.product_name')</label> <span class="e_required">*</span>
      <input class="form-control form-control-sm"
        name="product_name"
        value="{{old('product_name') ? old('product_name') : $obj->product_name}}"
        placeholder="@lang('validation.attributes.product_name')" />
      <span class="c_form__error-block">{{$errors->first('product_name')}}</span>
    </div>
    
    <div class="form-group">
      <label>@lang('validation.attributes.product_category')</label> <span class="e_required">*</span>
      @php
        $oldValue = old('product_category') ? old('product_category') : $obj->product_category;
      @endphp
      <select class="form-control form-control-sm "
        name="product_category">
      @foreach(\App\Helpers\ApplicationConstant::PRODUCT_CATEGORY as $productCategory => $label)
        <option value="{{ $productCategory }}"
          {{ $oldValue == $productCategory ? 'selected' : '' }}
          >@lang('application-constant.PRODUCT_CATEGORY.'.$label)</option>
      @endforeach
      </select>
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
        data-target="#entry-variant-item">
        <span class="action-icon">
          <i class="c_icon fas fa-add menu-icon"></i> @lang('common.entry-variant-item')
        </span>
      </button>
    </div>
  </form>
  <hr />

  <table class="grid-table table table-striped table-bordered table-responsive-sm">
    @include('components.table.header',[
      'headers' => [
        'action' => ['sortable' => false, 'title' => trans('common.action')],
        'variant_name' => ['sortable' => true, 'title' => trans('validation.attributes.variant_name')],
        'variant_price' => ['sortable' => true, 'title' => trans('validation.attributes.variant_price')],
      ]
    ])
    <tbody>
    @foreach($obj->productVariants as $variant)
      <tr>
        <td>
          <div class="icon-wrapper">
            <span class="action-icon edit" 
              data-toggle="modal"
              data-target="#entry-variant-item">
              <i class="c_icon icon fas fa-pencil menu-icon" title="edit"></i>
            </span>
          </div>
          
          <div class="icon-wrapper">
            <span class="action-icon delete-prs"
              onClick="document.getElementById('delete-variant-item-{{$variant->id}}').submit()">
              <i class="c_icon icon fas fa-trash menu-icon" title="delete"></i>
            </span>
          </div>
          <form action="{{ route($routePrefix.'.deleteVariantItemPost', ['id' => $obj->id, 'variant_id' => $variant->id]) }}"
            id="delete-variant-item-{{$variant->id}}"
            method="POST"
          >
            @csrf
          </form>
          <input type="hidden" class="product_variant_id" value="{{$variant->id}}" />
        </td>
        <td class="variant_name-ref">{{$variant->variant_name}}</td>
        <td class="variant_price-ref">{{$variant->variant_price}}</td>
      </tr>
    @endforeach
    </tbody>
  </table>
</section>

<section class="component__entry-form">
  <div class="modal fade" id="entry-variant-item"
    role="dialog"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="card">
          <div class="card-header"><i class="c_icon fas fa-file-pen menu-icon"></i> @lang('common.entry-variant-item')</div>
          <div class="card-body">
            <form action="{{ route($routePrefix.'.updateVariantItemPost', ['id' => $obj->id]) }}"
              id="update-variant-item-form"
              method="POST"
              enctype="multipart/form-data"
              autocomplete="off">
              @csrf
              <input type="hidden" name="product_id" value="{{$obj->id}}" />
              <input type="hidden" name="product_variant_id" id="product_variant_id" />

              <div class="form-group">
                <label>@lang('validation.attributes.variant_name')</label> <span class="e_required">*</span>
                <div class="input-group mb-3">
                  <input class="form-control form-control-sm"
                    id="variant_name"
                    value="{{ old('variant_name') }}"
                    name="variant_name"
                    placeholder="@lang('validation.attributes.variant_name')" />
                </div>
                <span class="c_form__error-block">{{$errors->first('variant_name')}}</span>
              </div>

              <div class="form-group">
                <label>@lang('validation.attributes.variant_price')</label> <span class="e_required">*</span>
                <div class="input-group mb-3">
                  <input class="form-control form-control-sm"
                    id="variant_price"
                    value="{{ old('variant_price')}}"
                    name="variant_price"
                    placeholder="@lang('validation.attributes.variant_price')" />
                </div>
                <span class="c_form__error-block">{{$errors->first('variant_price')}}</span>
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
  $(function() {
    $('.reset').click(function() {
      resetEntryForm();
    });

    $('.add').click(function() {
      resetEntryForm();
    });
    @if(old('product_variant_id') || session('error'))
      $('#entry-variant-item').modal('show');
      $('#product_variant_id').val("{{old('product_variant_id')}}");
    @endif

    $('.edit').click(function() {
      parent = $(this).parent().parent().parent();

      $('#product_variant_id').val(parent.find('.product_variant_id').val());
      $('#variant_name').val(parent.find('.variant_name-ref').html());
      $('#variant_price').val(parent.find('.variant_price-ref').html());
    });

    function resetEntryForm() {
      $('#variant_name').val("");
      $('#variant_price').val("");
    };

  });
</script>
@endpush