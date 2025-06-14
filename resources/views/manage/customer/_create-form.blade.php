<section class="component__create-form">
  <form action="{{route($routePrefix.'.createPost')}}"
    method="POST"
    enctype="multipart/form-data"
    autocomplete="off">
    @csrf
    <div class="form-group">
      <label>@lang('validation.attributes.name')</label> <span class="e_required">*</span>
      <input class="form-control form-control-sm"
        name="name"
        value="{{old('name')}}"
        placeholder="@lang('validation.attributes.name')" />
      <span class="c_form__error-block">{{$errors->first('name')}}</span>
    </div>
    <div class="form-group">
      <label>@lang('validation.attributes.phone')</label> <span class="e_required">*</span>
      <input class="form-control form-control-sm"
        name="phone"
        value="{{old('phone')}}"
        placeholder="@lang('validation.attributes.phone')" />
      <span class="form-text text-muted">* @lang('validation.guidance.without_hyphen')</span>
      <span class="c_form__error-block">{{$errors->first('phone')}}</span>
    </div>
    <div class="form-group">
      <label>@lang('validation.attributes.address')</label> <span class="e_required">*</span>
      <textarea class="form-control form-control-sm"
        name="address"
        rows="5"
        placeholder="@lang('validation.attributes.address')">{{ old('address') }}</textarea>
      <span class="c_form__error-block">{{$errors->first('address')}}</span>
    </div>
    <div class="form-group">
      <label>@lang('validation.attributes.email')</label>
      <input class="form-control form-control-sm"
        name="email"
        value="{{old('email')}}"
        placeholder="@lang('validation.attributes.email')" />
      <span class="c_form__error-block">{{$errors->first('email')}}</span>
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