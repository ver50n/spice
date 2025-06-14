<section class="component__create-form">
  <form action="{{route($routePrefix.'.createPost')}}"
    method="POST"
    enctype="multipart/form-data"
    autocomplete="off">
    @csrf
    
    <div class="form-group">
      <label>@lang('validation.attributes.product_name')</label> <span class="e_required">*</span>
      <input class="form-control form-control-sm"
        name="product_name"
        value="{{old('product_name')}}"
        placeholder="@lang('validation.attributes.product_name')" />
      <span class="c_form__error-block">{{$errors->first('product_name')}}</span>
    </div>
    
    <div class="form-group">
      <label>@lang('validation.attributes.product_category')</label> <span class="e_required">*</span>
      @php
        $oldValue = old('product_category');
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
    </div>
  </form>
</section>