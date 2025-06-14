<section class="component__create-form">
  <form action="{{route($routePrefix.'.createPost')}}"
    method="POST"
    enctype="multipart/form-data"
    autocomplete="off">
    @csrf
    
    <div class="form-group">
      <label>@lang('validation.attributes.bank_code')</label>
      <input class="form-control form-control-sm"
        name="bank_code"
        value="{{old('bank_code')}}"
        placeholder="@lang('validation.attributes.bank_code')" />
      <span class="c_form__error-block">{{$errors->first('bank_code')}}</span>
    </div>
    <div class="form-group">
      <label>@lang('validation.attributes.bank_name')</label> <span class="e_required">*</span>
      <input class="form-control form-control-sm"
        name="bank_name"
        value="{{old('bank_name')}}"
        placeholder="@lang('validation.attributes.bank_name')" />
      <span class="c_form__error-block">{{$errors->first('bank_name')}}</span>
    </div>
    <div class="form-group">
      <label>@lang('validation.attributes.branch_code')</label>
      <input class="form-control form-control-sm"
        name="branch_code"
        value="{{old('branch_code')}}"
        placeholder="@lang('validation.attributes.branch_code')" />
      <span class="c_form__error-block">{{$errors->first('branch_code')}}</span>
    </div>
    <div class="form-group">
      <label>@lang('validation.attributes.branch_name')</label>
      <input class="form-control form-control-sm"
        name="branch_name"
        value="{{old('branch_name')}}"
        placeholder="@lang('validation.attributes.branch_name')" />
      <span class="c_form__error-block">{{$errors->first('branch_name')}}</span>
    </div>
    <div class="form-group">
      <label>@lang('validation.attributes.account_number')</label> <span class="e_required">*</span>
      <input class="form-control form-control-sm"
        name="account_number"
        id="account_number"
        value="{{old('account_number')}}"
        placeholder="@lang('validation.attributes.account_number')" />
      <span class="c_form__error-block">{{$errors->first('account_number')}}</span>
    </div>
    <div class="form-group">
      <label>@lang('validation.attributes.account_type')</label> <span class="e_required">*</span>
      <select name="account_type"
        class="form-control form-control-sm">
        @foreach(App\Helpers\ApplicationConstant::BANK_ACCOUNT_TYPE as $key => $value)
          <option value="{{$key}}"
            {{ old('account_type') == $key ? 'selected' : '' }}
          >
            @lang('application-constant.BANK_ACCOUNT_TYPE.'.$value)
          </option>
        @endforeach
      </select>
      <span class="c_form__error-block">{{$errors->first('account_type')}}</span>
    </div>
    <div class="form-group">
      <label>@lang('validation.attributes.account_name')</label> <span class="e_required">*</span>
      <input class="form-control form-control-sm"
        name="account_name"
        id="account_name"
        value="{{old('account_name')}}"
        placeholder="@lang('validation.attributes.account_name')" />
      <span class="c_form__error-block">{{$errors->first('account_name')}}</span>
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