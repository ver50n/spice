<section class="component__create-form">
  <form action="{{$createUserUrl}}"
    method="POST"
    enctype="multipart/form-data"
    autocomplete="off">
    @csrf

    <div class="form-group">
      <label>@lang('validation.attributes.identification_number') </label> <span class="e_required">*</span>
      <input class="form-control form-control-sm"
        name="identification_number"
        id="identification_number"
        value="{{ old('identification_number') }}"
        placeholder="@lang('validation.attributes.identification_number')"
        autocomplete="off"/>
      <span class="c_form__error-block">{{$errors->first('identification_number')}}</span>
    </div>
    
    <div class="form-group">
      <label>@lang('validation.attributes.name')</label> <span class="e_required">*</span>
      <input class="form-control form-control-sm"
        name="name"
        value="{{old('name')}}"
        placeholder="@lang('validation.attributes.name')" />
      <span class="c_form__error-block">{{$errors->first('name')}}</span>
    </div>
    
    <div class="form-group">
      <label>@lang('validation.attributes.username')</label> <span class="e_required">*</span>
      <input class="form-control form-control-sm"
        name="username"
        value="{{old('username')}}"
        placeholder="@lang('validation.attributes.username')" />
      <span class="c_form__error-block">{{$errors->first('username')}}</span>
    </div>

    <div class="form-group">
      <label>@lang('validation.attributes.email')</label> <span class="e_required">*</span>
      <input class="form-control form-control-sm"
        name="email"
        value="{{old('email')}}"
        placeholder="@lang('validation.attributes.email')" />
      <span class="c_form__error-block">{{$errors->first('email')}}</span>
    </div>

    <div class="form-group">
      <label>@lang('validation.attributes.place_id')</label> <span class="e_required">*</span>
      <select name="place_id"
        class="form-control form-control-sm">
        @foreach(App\Models\Place::get() as $place)
          <option value="{{$place->id}}"
            {{ old('place_id') == $place->id ? 'selected' : '' }}
          >
            {{$place->complete_label}}
          </option>
        @endforeach
      </select>
      <span class="c_form__error-block">{{$errors->first('place_id')}}</span>
    </div>

    <div class="form-group">
      <label>@lang('validation.attributes.password')</label> <span class="e_required">*</span>
      <input class="form-control form-control-sm"
        type="password"
        name="password"
        placeholder="@lang('validation.attributes.password')" />
      <span class="c_form__error-block">{{$errors->first('password')}}</span>
    </div>

    <div class="form-group">
      <label>@lang('validation.attributes.confirm_password')</label> <span class="e_required">*</span>
      <input class="form-control form-control-sm"
        type="password"
        name="confirm_password"
        placeholder="@lang('validation.attributes.confirm_password')" />
      <span class="c_form__error-block">{{$errors->first('confirm_password')}}</span>
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