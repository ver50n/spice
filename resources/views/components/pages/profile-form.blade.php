<form action="{{ $url }}"
  method="POST"
  enctype="multipart/form-data"
  autocomplete="off">
  @csrf
  <input type="hidden" name="nav" value="profile" />

  <fieldset>
    <legend>@lang('common.general')</legend>
    <hr />
    <div class="form-group">
      <label>@lang('validation.attributes.name') </label> <span class="e_required">*</span>
      <input class="form-control form-control-sm"
        type="text"
        name="name"
        value="{{ old('name') ? old('name') : $obj->name }}"
        placeholder="@lang('validation.attributes.name')"
        autocomplete="off"/>
      <span class="c_form__error-block">{{$errors->first('name')}}</span>
    </div>

    <div class="form-group">
      <label>@lang('validation.attributes.name_meaning') </label>
      <input class="form-control form-control-sm"
        type="text"
        name="name_meaning"
        value="{{ old('name_meaning') ? old('name_meaning') : $obj->name_meaning }}"
        placeholder="@lang('validation.attributes.name_meaning')"
        autocomplete="off"/>
      <span class="c_form__error-block">{{$errors->first('name_meaning')}}</span>
    </div>

    <div class="form-group">
      <label>@lang('validation.attributes.name_kanji') </label>
      <input class="form-control form-control-sm"
        type="text"
        name="name_kanji"
        value="{{ old('name_kanji') ? old('name_kanji') : $obj->name_kanji }}"
        placeholder="@lang('validation.attributes.name_kanji')"
        autocomplete="off"/>
      <span class="c_form__error-block">{{$errors->first('name_kanji')}}</span>
    </div>

    <div class="form-group">
      <label>@lang('validation.attributes.dob')</label> <span class="e_required">*</span>
      <input class="form-control form-control-sm"
        name="dob"
        id="dob"
        readOnly
        value="{{ old('dob') ? old('dob') : $obj->dob }}"
        placeholder="@lang('validation.attributes.dob')" />
      <span class="form-text text-muted">* @lang('validation.guidance.calendar_reference')</span>
      <span class="c_form__error-block">{{$errors->first('dob')}}</span>
    </div>

    <div class="form-group">
      <label>@lang('validation.attributes.nationality')</label> <span class="e_required">*</span>
      @php
        $oldValue = old('nationality') ? old('nationality') : $obj->nationality;
      @endphp
      <select name="nationality"
        id="nationality"
        class="form-control form-control-sm">
      @foreach(App\Helpers\ApplicationConstant::COUNTRY as $key => $value)
        <option value="{{$key}}" {{ $oldValue == $key ? 'selected' : '' }}>
          {{ $value }}
        </option>
      @endforeach
      </select>
    </div>

    <div class="form-group">
      <label>@lang('validation.attributes.gender')</label> <span class="e_required">*</span>
      @php
        $oldValue = old('gender') ? old('gender') : $obj->gender;
      @endphp
      <select name="gender"
        id="gender"
        class="form-control form-control-sm">
      @foreach(App\Helpers\ApplicationConstant::GENDER as $key => $value)
        <option value="{{$key}}" {{ $oldValue == $key ? 'selected' : '' }}>
          @lang('application-constant.GENDER.'.$value)
        </option>
      @endforeach
      </select>
    </div>

    <div class="form-group">
      <label>@lang('validation.attributes.phone')</label> <span class="e_required">*</span>
      <input class="form-control form-control-sm"
        name="phone"
        value="{{old('phone') ? old('phone') : $obj->phone}}"
        placeholder="@lang('validation.attributes.phone')" />
      <span class="form-text text-muted">* @lang('validation.guidance.without_hyphen')</span>
      <span class="c_form__error-block">{{$errors->first('phone')}}</span>
    </div>

    <div class="form-group">
      <label>@lang('validation.attributes.address')</label> <span class="e_required">*</span>
      <textarea class="form-control form-control-sm"
        name="address"
        rows="5"
        placeholder="@lang('validation.attributes.address')">{{ old('address') ? old('address') : $obj->address }}</textarea>
      <span class="c_form__error-block">{{$errors->first('address')}}</span>
    </div>

    @if($actor == 'admin')
    <div class="form-group">
      <label>@lang('validation.attributes.note')</label>
      <textarea class="form-control form-control-sm"
        name="note"
        id="note">{{ old('note') ? old('note') : $obj->note }}</textarea>
      <span class="c_form__error-block">{{$errors->first('note')}}</span>
    </div>
    @endif

    <div class="form-group">
      <label>@lang('validation.attributes.user_note')</label> 
      <textarea class="form-control form-control-sm"
        name="user_note"
        id="user_note">{{ old('user_note') ? old('user_note') : $obj->user_note }}</textarea>
      <span class="c_form__error-block">{{$errors->first('user_note')}}</span>
    </div>
  </fieldset>

  @if(\App\Utils\UserRoleUtil::isOrganizationAdmin() || Auth::guard('web')->user()->status == 'registered')
  <fieldset>
    <div class="form-group">
      <label>@lang('validation.attributes.gojukai_in')</label>
      <input class="form-control form-control-sm"
        name="gojukai_in"
        id="gojukai_in"
        value="{{ old('gojukai_in') ? old('gojukai_in') : $obj->gojukai_in }}"
        placeholder="@lang('validation.attributes.gojukai_in')" />
      <span class="c_form__error-block">{{$errors->first('gojukai_in')}}</span>
    </div>

    <div class="form-group">
      <label>@lang('validation.attributes.gojukai_at')</label>
      <input class="form-control form-control-sm"
        name="gojukai_at"
        id="gojukai_at"
        readOnly
        value="{{ old('gojukai_at') ? old('gojukai_at') : $obj->gojukai_at }}"
        placeholder="@lang('validation.attributes.gojukai_at')" />
      <span class="form-text text-muted">* @lang('validation.guidance.calendar_reference')</span>
      <span class="c_form__error-block">{{$errors->first('gojukai_at')}}</span>
    </div>

    <div class="form-group">
      <label>@lang('validation.attributes.received_okatagi_gohonzon_in')</label>
      <input class="form-control form-control-sm"
        name="received_okatagi_gohonzon_in"
        id="received_okatagi_gohonzon_in"
        value="{{ old('received_okatagi_gohonzon_in') ? old('received_okatagi_gohonzon_in') : $obj->received_okatagi_gohonzon_in }}"
        placeholder="@lang('validation.attributes.received_okatagi_gohonzon_in')" />
      <span class="c_form__error-block">{{$errors->first('received_okatagi_gohonzon_in')}}</span>
    </div>

    <div class="form-group">
      <label>@lang('validation.attributes.received_okatagi_gohonzon_at')</label>
      <input class="form-control form-control-sm"
        name="received_okatagi_gohonzon_at"
        id="received_okatagi_gohonzon_at"
        readOnly
        value="{{ old('received_okatagi_gohonzon_at') ? old('received_okatagi_gohonzon_at') : $obj->received_okatagi_gohonzon_at }}"
        placeholder="@lang('validation.attributes.received_okatagi_gohonzon_at')" />
      <span class="form-text text-muted">* @lang('validation.guidance.calendar_reference')</span>
      <span class="c_form__error-block">{{$errors->first('received_okatagi_gohonzon_at')}}</span>
    </div>

    <div class="form-group">
      <label>@lang('validation.attributes.received_tokubetsu_gohonzon_in')</label>
      <input class="form-control form-control-sm"
        name="received_tokubetsu_gohonzon_in"
        id="received_tokubetsu_gohonzon_in"
        value="{{ old('received_tokubetsu_gohonzon_in') ? old('received_tokubetsu_gohonzon_in') : $obj->received_tokubetsu_gohonzon_in }}"
        placeholder="@lang('validation.attributes.received_tokubetsu_gohonzon_in')" />
      <span class="c_form__error-block">{{$errors->first('received_tokubetsu_gohonzon_in')}}</span>
    </div>

    <div class="form-group">
      <label>@lang('validation.attributes.received_tokubetsu_gohonzon_at')</label>
      <input class="form-control form-control-sm"
        name="received_tokubetsu_gohonzon_at"
        id="received_tokubetsu_gohonzon_at"
        readOnly
        value="{{ old('received_tokubetsu_gohonzon_at') ? old('received_tokubetsu_gohonzon_at') : $obj->received_tokubetsu_gohonzon_at }}"
        placeholder="@lang('validation.attributes.received_tokubetsu_gohonzon_at')" />
      <span class="form-text text-muted">* @lang('validation.guidance.calendar_reference')</span>
      <span class="c_form__error-block">{{$errors->first('received_tokubetsu_gohonzon_at')}}</span>
    </div>

    <div class="form-group">
      <label>@lang('validation.attributes.received_omamori_gohonzon_in')</label>
      <input class="form-control form-control-sm"
        name="received_omamori_gohonzon_in"
        id="received_omamori_gohonzon_in"
        value="{{ old('received_omamori_gohonzon_in') ? old('received_omamori_gohonzon_in') : $obj->received_omamori_gohonzon_in }}"
        placeholder="@lang('validation.attributes.received_omamori_gohonzon_in')" />
      <span class="c_form__error-block">{{$errors->first('received_omamori_gohonzon_in')}}</span>
    </div>

    <div class="form-group">
      <label>@lang('validation.attributes.received_omamori_gohonzon_at')</label>
      <input class="form-control form-control-sm"
        name="received_omamori_gohonzon_at"
        id="received_omamori_gohonzon_at"
        readOnly
        value="{{ old('received_omamori_gohonzon_at') ? old('received_omamori_gohonzon_at') : $obj->received_omamori_gohonzon_at }}"
        placeholder="@lang('validation.attributes.received_omamori_gohonzon_at')" />
      <span class="form-text text-muted">* @lang('validation.guidance.calendar_reference')</span>
      <span class="c_form__error-block">{{$errors->first('received_omamori_gohonzon_at')}}</span>
    </div>

    <div class="form-group">
      <label>@lang('validation.attributes.received_ita_gohonzon_in')</label>
      <input class="form-control form-control-sm"
        name="received_ita_gohonzon_in"
        id="received_ita_gohonzon_in"
        value="{{ old('received_ita_gohonzon_in') ? old('received_ita_gohonzon_in') : $obj->received_ita_gohonzon_in }}"
        placeholder="@lang('validation.attributes.received_ita_gohonzon_in')" />
      <span class="c_form__error-block">{{$errors->first('received_ita_gohonzon_in')}}</span>
    </div>

    <div class="form-group">
      <label>@lang('validation.attributes.received_ita_gohonzon_at')</label>
      <input class="form-control form-control-sm"
        name="received_ita_gohonzon_at"
        id="received_ita_gohonzon_at"
        readOnly
        value="{{ old('received_ita_gohonzon_at') ? old('received_ita_gohonzon_at') : $obj->received_ita_gohonzon_at }}"
        placeholder="@lang('validation.attributes.received_ita_gohonzon_at')" />
      <span class="form-text text-muted">* @lang('validation.guidance.calendar_reference')</span>
      <span class="c_form__error-block">{{$errors->first('received_ita_gohonzon_at')}}</span>
    </div>

    <div class="form-group">
      <label>@lang('validation.attributes.shinjin_from')</label>
      <input class="form-control form-control-sm"
        name="shinjin_from"
        id="shinjin_from"
        readOnly
        value="{{ old('shinjin_from') ? old('shinjin_from') : $obj->shinjin_from }}"
        placeholder="@lang('validation.attributes.shinjin_from')" />
      <span class="form-text text-muted">* @lang('validation.guidance.calendar_reference')</span>
      <span class="c_form__error-block">{{$errors->first('shinjin_from')}}</span>
    </div>
  </fieldset>
  @endif

  <fieldset>
    <legend>@lang('common.personal-identification')</legend>
    <hr />
    <div class="form-group">
      <label>@lang('validation.attributes.identification_number')</label> <span class="e_required">*</span>
      <input class="form-control form-control-sm"
        name="identification_number"
        id="identification_number"
        readOnly
        value="{{ old('identification_number') ? old('identification_number') : $obj->identification_number }}"
        placeholder="@lang('validation.attributes.identification_number')" />
      <span class="c_form__error-block">{{$errors->first('identification_number')}}</span>
    </div>
  <div>
    <button type="submit" class="btn btn-outline-primary">
      <span class="action-icon">
        <i class="c_icon fas fa-save menu-icon"></i> @lang('common.save')
      </span>
    </button>
  </div>
</form>