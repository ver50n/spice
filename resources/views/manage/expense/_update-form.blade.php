<section class="component__update-form">
  <form action="{{route($routePrefix.'.updatePost', ['id' => $obj->id])}}"
    method="POST"
    enctype="multipart/form-data"
    autocomplete="off">
    @csrf
    <div class="form-group">
      <label>@lang('validation.attributes.transaction_cd')</label>
      <input class="form-control form-control-sm"
        name="transaction_cd"
        value="{{old('transaction_cd') ? old('transaction_cd') : $obj->transaction_cd}}"
        placeholder="@lang('validation.attributes.transaction_cd')" />
      <span class="c_form__error-block">{{$errors->first('transaction_cd')}}</span>
    </div>

    <div class="form-group">
      <label>@lang('validation.attributes.expense_category')</label> <span class="e_required">*</span>
      <select name="expense_category"
        class="form-control form-control-sm">
        @php
          $oldValue = old('expense_category') ? old('expense_category') : $obj->expense_category;
        @endphp
        @foreach(App\Helpers\ApplicationConstant::EXPENSE_CATEGORY as $key => $value)
          <option value="{{$key}}" {{ $oldValue == $key ? 'selected' : '' }}>
            @lang('application-constant.EXPENSE_CATEGORY.'.$value)
          </option>
        @endforeach
      </select>
      <span class="c_form__error-block">{{$errors->first('expense_category')}}</span>
    </div>

    <div class="form-group">
      <label>@lang('validation.attributes.expense_name')</label> <span class="e_required">*</span>
      <input class="form-control form-control-sm"
        name="expense_name"
        value="{{old('expense_name') ? old('expense_name') : $obj->expense_name}}"
        placeholder="@lang('validation.attributes.expense_name')" />
      <span class="c_form__error-block">{{$errors->first('expense_name')}}</span>
    </div>

    <div class="form-group">
      <label>@lang('validation.attributes.expense_amount')</label>
      <input class="form-control form-control-sm"
        type="number"
        name="expense_amount"
        value="{{old('expense_amount') ? old('expense_amount') : $obj->expense_amount}}"
        placeholder="@lang('validation.attributes.expense_amount')" />
      <span class="c_form__error-block">{{$errors->first('expense_amount')}}</span>
    </div>

    <div class="form-group">
      <label>@lang('validation.attributes.expense_at')</label> <span class="e_required">*</span>
      <input class="form-control form-control-sm"
        name="expense_at"
        value="{{old('expense_at') ? old('expense_at') : $obj->expense_at}}"
        placeholder="@lang('validation.attributes.expense_at')" />
      <span class="c_form__error-block">{{$errors->first('expense_at')}}</span>
    </div>

    <div class="form-group">
      <label>@lang('validation.attributes.pay_at')</label> <span class="e_required">*</span>
      <input class="form-control form-control-sm"
        name="pay_at"
        value="{{old('pay_at') ? old('pay_at') : $obj->pay_at}}"
        placeholder="@lang('validation.attributes.pay_at')" />
      <span class="c_form__error-block">{{$errors->first('pay_at')}}</span>
    </div>
    
    <div class="form-group">
      <label>@lang('validation.attributes.note')</label>
      <textarea class="form-control form-control-sm"
        name="note"
        rows="5"
        placeholder="@lang('validation.attributes.note')">{{ old('note') ? old('note') : $obj->note }}</textarea>
      <span class="c_form__error-block">{{$errors->first('note')}}</span>
    </div>

    <div class="form-group">
      <label>@lang('validation.attributes.expense_status')</label> <span class="e_required">*</span>
      <select name="expense_status"
        class="form-control form-control-sm">
        @php
          $oldValue = old('expense_status') ? old('expense_status') : $obj->expense_status;
        @endphp
        @foreach(App\Helpers\ApplicationConstant::EXPENSE_STATUS as $key => $value)
          <option value="{{$key}}" {{ $oldValue == $key ? 'selected' : '' }}>
            @lang('application-constant.EXPENSE_STATUS.'.$value)
          </option>
        @endforeach
      </select>
      <span class="c_form__error-block">{{$errors->first('expense_status')}}</span>
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

@push('javascript')
<script>
  $(document).ready(function() {
    $('#expense_at').flatpickr({
      locale: "{{ \Session::get('locale') }}",
      dateFormat: "Y-m-d",
      disableMobile: true,
      maxDate: 'today'
    });
  });
</script>
@endpush