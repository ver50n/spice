<section class="c_login-form">
  <form action="{{ $registerUrl }}" method="POST">
    @csrf
    <div class="form-wrapper">
      <h4>@lang('common.registration')</h4>
      <hr />
      <div class="form-group">
        <label>@lang('validation.attributes.identification_number') </label> <span class="e_required">*</span>
        <input class="form-control form-control-sm"
          name="identification_number"
          id="identification_number"
          value="{{ old('identification_number') }}"
          placeholder="@lang('validation.attributes.identification_number')"
          autocomplete="off"/>
        <span class="form-text text-muted">* @lang('validation.guidance.identity_entry')</span>
        <span class="c_form__error-block">{{$errors->first('identification_number')}}</span>
      </div>
      <div class="form-group">
        <label>@lang('validation.attributes.name') </label> <span class="e_required">*</span>
        <input class="form-control form-control-sm"
          name="name"
          id="name"
          value="{{ old('name') }}"
          placeholder="@lang('validation.attributes.name')"
          autocomplete="off"/>
        <span class="c_form__error-block">{{$errors->first('name')}}</span>
      </div>
      <div class="form-group">
        <label>@lang('validation.attributes.username') </label> <span class="e_required">*</span>
        <input class="form-control form-control-sm"
          type="text"
          name="username"
          value="{{old('username')}}"
          placeholder="@lang('validation.attributes.username')"
          autocomplete="off"/>
        <span class="form-text text-muted">* @lang('validation.guidance.alphanumeric_small_only')</span>
        <span class="c_form__error-block">{{$errors->first('username')}}</span>
      </div>
      <div class="form-group">
        <label>@lang('validation.attributes.email') </label> <span class="e_required">*</span>
        <input class="form-control form-control-sm"
          type="text"
          name="email"
          value="{{old('email')}}"
          placeholder="@lang('validation.attributes.email')"
          autocomplete="off"/>
        <span class="c_form__error-block">{{$errors->first('email')}}</span>
      </div>
      <div class="form-group">
        <label>@lang('validation.attributes.password') </label> <span class="e_required">*</span>
        
        <div class="input-group">
          <div class="input-group-append">
            <input class="form-control form-control-sm password-type"
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
        <label>@lang('validation.attributes.confirm_password') </label> <span class="e_required">*</span>
        
        <div class="input-group">
          <div class="input-group-append">
            <input class="form-control form-control-sm password-type"
              type="password"
              name="confirm_password"
              id="confirm_password"
              value="{{old('confirm_password')}}"
              placeholder="@lang('validation.attributes.confirm_password')"
              autocomplete="off"/>
            <span class="input-group-text"><i class="fa fa-eye password-icon" aria-hidden="true"></i></span>
          </div>
        </div>
        <span class="form-text text-muted">* @lang('validation.guidance.alphanumeric_symbol')</span>
        <span class="c_form__error-block">{{$errors->first('confirm_password')}}</span>
      </div>

      <div class="form-group">
        <label>@lang('validation.attributes.place_id')</label> <span class="e_required">*</span>
        @php
          $oldValue = old('place_id');
        @endphp
        <select name="place_id"
          class="form-control form-control-sm">
          @foreach(App\Models\Place::get() as $place)
          <option value="{{$place->id}}" {{ $oldValue == $place->id ? 'selected' : '' }}>
              {{$place->complete_label}}
            </option>
          @endforeach
        </select>
        <span class="c_form__error-block">{{$errors->first('place_id')}}</span>
      </div>

      <div>
        <button class="btn btn-outline-primary"> <i class="fas fa-clipboard-list menu-icon"></i> @lang('common.registration')</button>
        <a href="{{ route('member.login') }}">
          <button type="button" class="btn btn-outline-primary"> <i class="fas fa-sign-in-alt menu-icon"></i> @lang('common.login')</button>
        </a>
      </div>
    </div>
  </form>
</section>