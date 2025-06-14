@php
$bankAccount = $obj->bankAccount;
if(!$bankAccount)
  $bankAccount = new \App\Models\UserBankAccount();
@endphp
<form action="{{ $url }}"
  method="POST"
  enctype="multipart/form-data"
  autocomplete="off">
  @csrf
  <input type="hidden" name="nav" value="bank-account" />

  <div class="form-group">
    <label>@lang('validation.attributes.bank_code')</label>
    <input class="form-control form-control-sm"
      name="bank_code"
      id="bank_code"
      value="{{ old('bank_code') ? old('bank_code') : $bankAccount->bank_code }}"
      placeholder="@lang('validation.attributes.bank_code')" />
    <span class="c_form__error-block">{{$errors->first('bank_code')}}</span>
  </div>
  <div class="form-group">
    <label>@lang('validation.attributes.bank_name')</label> <span class="e_required">*</span>
    <input class="form-control form-control-sm"
      name="bank_name"
      id="bank_name"
      value="{{ old('bank_name') ? old('bank_name') : $bankAccount->bank_name }}"
      placeholder="@lang('validation.attributes.bank_name')" />
    <span class="c_form__error-block">{{$errors->first('bank_name')}}</span>
  </div>
  <div class="form-group">
    <label>@lang('validation.attributes.branch_code')</label>
    <input class="form-control form-control-sm"
      name="branch_code"
      id="branch_code"
      value="{{ old('branch_code') ? old('branch_code') : $bankAccount->branch_code }}"
      placeholder="@lang('validation.attributes.branch_code')" />
    <span class="c_form__error-block">{{$errors->first('branch_code')}}</span>
  </div>
  <div class="form-group">
    <label>@lang('validation.attributes.branch_name')</label>
    <input class="form-control form-control-sm"
      name="branch_name"
      id="branch_name"
      value="{{ old('branch_name') ? old('branch_name') : $bankAccount->branch_name }}"
      placeholder="@lang('validation.attributes.branch_name')" />
    <span class="c_form__error-block">{{$errors->first('branch_name')}}</span>
  </div>
  <div class="form-group">
    <label>@lang('validation.attributes.account_type')</label> <span class="e_required">*</span>
    @php
      $oldValue = old('account_type') ? old('account_type') : $bankAccount->account_type;
    @endphp
    <select name="account_type"
      id="account_type"
      class="form-control form-control-sm">
    @foreach(App\Helpers\ApplicationConstant::BANK_ACCOUNT_TYPE as $key => $value)
      <option value="{{$key}}" {{ $oldValue == $key ? 'selected' : '' }}>
        @lang('application-constant.BANK_ACCOUNT_TYPE.'.$value)
      </option>
    @endforeach
    </select>
    <span class="c_form__error-block">{{$errors->first('account_type')}}</span>
  </div>
  <div class="form-group">
    <label>@lang('validation.attributes.account_number')</label> <span class="e_required">*</span>
    <input class="form-control form-control-sm"
      name="account_number"
      id="account_number"
      value="{{ old('account_number') ? old('account_number') : $bankAccount->account_number }}"
      placeholder="@lang('validation.attributes.account_number')" />
    <span class="form-text text-muted">* @lang('validation.guidance.numeric')</span>
    <span class="c_form__error-block">{{$errors->first('account_number')}}</span>
  </div>
  <div class="form-group">
    <label>@lang('validation.attributes.account_name')</label> <span class="e_required">*</span>
    <input class="form-control form-control-sm"
      name="account_name"
      id="account_name"
      value="{{ old('account_name') ? old('account_name') : $bankAccount->account_name }}"
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