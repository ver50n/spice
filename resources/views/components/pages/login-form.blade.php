<section class="c_login-form">
  <form action="{{ $loginUrl }}" method="POST">
    @csrf
    <div class="form-wrapper">
      <h4>@lang('common.login')</h4>
      <hr />
      <div class="form-group">
        <label>@lang('validation.attributes.username') </label> <span class="e_required">*</span>
        <input class="form-control form-control-sm"
          type="text"
          name="username"
          value="{{old('username')}}"
          placeholder="@lang('validation.attributes.username') "
          autocomplete="off"/>
        <span class="form-text text-muted">* @lang('validation.guidance.alphanumeric')</span>
        <span class="c_form__error-block">{{$errors->first('username')}}</span>
      </div>
      <div class="form-group">
        <label>@lang('validation.attributes.password') </label> <span class="e_required">*</span>
        
        <div class="input-group">
          <div class="input-group-append">
            <input class="form-control form-control-sm  password-type"
              type="password"
              name="password"
              id="password"
              value="{{old('password')}}"
              placeholder="@lang('validation.attributes.password')"
              autocomplete="off"/>
            <span class="input-group-text"><i class="fa fa-eye password-icon" aria-hidden="true"></i></span>
          </div>
        </div>
        <span class="form-text text-muted">* @lang('validation.guidance.alphanumeric_symbol')</span>
        <span class="c_form__error-block">{{$errors->first('password')}}</span>
      </div>
      <div class="form-group">
        <span class="form-text text-muted" style="float: left;">
          <button class="btn btn-outline-primary"><i class="fas fa-sign-in-alt menu-icon"></i> @lang('common.login')</button>
          @if(isset($hasRegistration) && $hasRegistration)
          <a href="{{ route('member.register') }}">
            <button type="button" class="btn btn-outline-primary"> <i class="fas fa-clipboard-list menu-icon"></i> @lang('common.registration')</button>
          </a>
          @endif
        </span>
      </div>
    </div>
    <br />
  </form>
</section>