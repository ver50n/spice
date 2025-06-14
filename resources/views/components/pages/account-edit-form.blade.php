<section class="component__update-form">
  <form action="{{ $url }}"
    method="POST"
    enctype="multipart/form-data"
    autocomplete="off">
    @csrf
    <input type="hidden" name="nav" value="account" />
    
    <div class="form-group">
      <label>@lang('validation.attributes.username')</label> <span class="e_required">*</span>
      <input class="form-control form-control-sm"
        name="username"
        value="{{old('username') ? old('username') : $obj->username}}"
        placeholder="@lang('validation.attributes.username')" />
      <span class="form-text text-muted">* @lang('validation.guidance.alphanumeric')</span>
      <span class="c_form__error-block">{{$errors->first('username')}}</span>
    </div>

    <div class="form-group">
      <label>@lang('validation.attributes.email')</label> <span class="e_required">*</span>
      <input class="form-control form-control-sm"
        name="email"
        value="{{old('email') ? old('email') : $obj->email}}"
        placeholder="@lang('validation.attributes.email')" />
      <span class="c_form__error-block">{{$errors->first('email')}}</span>
    </div>

    @if(\App\Utils\UserRoleUtil::isOrganizationAdmin())
    <div class="form-group">
      <label>@lang('validation.attributes.place_id')</label> <span class="e_required">*</span>
      @php
        $oldValue = old('place_id') ? old('place_id') : $obj->place_id;
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
    @endif

    <div>
      <button type="submit" class="btn btn-outline-primary">
        <span class="action-icon">
          <i class="c_icon fas fa-save menu-icon"></i> @lang('common.save')
        </span>
      </button>
    </div>
  </form>
</section>