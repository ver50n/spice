<section class="c_login-form">
  <form action="{{ $postUrl }}" method="POST">
    @csrf
    <input type="hidden" name="nav" value="account" />
    <div class="form-wrapper">
      <h4>@lang('common.change-password')</h4>
      <div class="form-group">
        <label>@lang('validation.attributes.password') </label> <span class="e_required">*</span>
        <input class="form-control form-control-sm"
          type="password"
          name="password"
          value="{{old('password')}}"
          placeholder="@lang('validation.attributes.password') "
          autocomplete="off"/>
        <span class="form-text text-muted">* @lang('validation.guidance.alphanumeric_symbol')</span>
        <span class="c_form__error-block">{{$errors->first('password')}}</span>
      </div>
      <div class="form-group">
        <label>@lang('validation.attributes.confirm_password') </label> <span class="e_required">*</span>
        <input class="form-control form-control-sm"
          type="password"
          name="confirm_password"
          value="{{old('confirm_password')}}"
          placeholder="@lang('validation.attributes.confirm_password')"
          autocomplete="off"/>
        <span class="form-text text-muted">* @lang('validation.guidance.alphanumeric_symbol')</span>
        <span class="c_form__error-block">{{$errors->first('confirm_password')}}</span>
      </div>
      <div>
        <button class="btn btn-outline-primary">
          <i class="c_icon fas fa-save menu-icon"></i> @lang('common.save')
        </button>
      </div>
    </div>
  </form>
</section>