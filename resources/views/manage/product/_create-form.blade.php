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
    
    <div class="form-group">
      <label>@lang('validation.attributes.purchase_price')</label> <span class="e_required">*</span>
      <input class="form-control form-control-sm"
        name="purchase_price"
        value="{{old('purchase_price')}}"
        placeholder="@lang('validation.attributes.purchase_price')" />
      <span class="c_form__error-block">{{$errors->first('purchase_price')}}</span>
    </div>
    
    <div class="form-group">
      <label>@lang('validation.attributes.sell_price')</label> <span class="e_required">*</span>
      <input class="form-control form-control-sm"
        name="sell_price"
        value="{{old('sell_price')}}"
        placeholder="@lang('validation.attributes.sell_price')" />
      <span class="c_form__error-block">{{$errors->first('sell_price')}}</span>
    </div>
    
    <div class="form-group">
      <label>@lang('validation.attributes.product_thumbnail')</label> <span class="e_required">*</span>
      <input class="form-control form-control-sm"
        type="file"
        name="product_thumbnail"
        placeholder="@lang('validation.attributes.product_thumbnail')" />
      <span class="c_form__error-block">{{$errors->first('product_thumbnail')}}</span>
    </div>

    <div class="form-group">
      <label>@lang('validation.attributes.product_desc')</label>
      <textarea class="form-control form-control-sm"
        name="product_desc"
        id="product_desc">{{ old('product_desc') }}</textarea>
      <span class="c_form__error-block">{{$errors->first('product_desc')}}</span>
    </div>
    
    <div class="form-group">
      <label>@lang('validation.attributes.is_sell_to_customer')</label> <span class="e_required">*</span>
      @php
        $oldValue = old('is_sell_to_customer');
      @endphp
      <select class="form-control form-control-sm "
        name="is_sell_to_customer">
      @foreach(\App\Helpers\ApplicationConstant::YES_NO as $yesNo => $label)
        <option value="{{ $yesNo }}"
          {{ $oldValue == $yesNo ? 'selected' : '' }}
          >@lang('application-constant.YES_NO.'.$label)</option>
      @endforeach
      </select>
    </div>
    
    <div class="form-group">
      <label>@lang('validation.attributes.is_show_in_landing')</label> <span class="e_required">*</span>
      @php
        $oldValue = old('is_show_in_landing');
      @endphp
      <select class="form-control form-control-sm "
        name="is_show_in_landing">
      @foreach(\App\Helpers\ApplicationConstant::YES_NO as $yesNo => $label)
        <option value="{{ $yesNo }}"
          {{ $oldValue == $yesNo ? 'selected' : '' }}
          >@lang('application-constant.YES_NO.'.$label)</option>
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