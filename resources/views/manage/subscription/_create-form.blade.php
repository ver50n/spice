<section class="component__create-form">
  <form action="{{route($routePrefix.'.createPost')}}"
    method="POST"
    enctype="multipart/form-data"
    autocomplete="off">
    @csrf
    <div class="form-group">
      <label>@lang('validation.attributes.customer_id')</label> <span class="e_required">*</span>
      <select name="customer_id"
        class="form-control form-control-sm">
        @php
          $oldValue = old('customer_id');
        @endphp
        @foreach(App\Models\Customer::get() as $customer)
          <option value="{{$customer->id}}" {{ $oldValue == $customer->id ? 'selected' : '' }}>
            {{$customer->name}}
          </option>
        @endforeach
      </select>
      <span class="c_form__error-block">{{$errors->first('customer_id')}}</span>
    </div>

    <div class="form-group">
      <label>@lang('validation.attributes.handover_method')</label> <span class="e_required">*</span>
      <select name="handover_method"
        class="form-control form-control-sm">
        @foreach(App\Helpers\ApplicationConstant::HANDOVER_METHOD as $key => $value)
          <option value="{{$key}}"
            {{ old('handover_method') == $key ? 'selected' : '' }}
          >
            @lang('application-constant.HANDOVER_METHOD.'.$value)
          </option>
        @endforeach
      </select>
      <span class="c_form__error-block">{{$errors->first('handover_method')}}</span>
    </div>
    
    <div class="form-group">
      <label>@lang('validation.attributes.handover_time')</label>
      <input class="form-control form-control-sm"
        name="handover_time"
        id="handover_time"
        value="{{old('handover_time')}}"
        placeholder="@lang('validation.attributes.handover_time')" />
      <span class="c_form__error-block">{{$errors->first('handover_time')}}</span>
    </div>
    
    <div class="form-group">
      <label>@lang('validation.attributes.note')</label>
      <textarea class="form-control form-control-sm"
        name="note"
        rows="5"
        placeholder="@lang('validation.attributes.note')">{{ old('note') }}</textarea>
      <span class="c_form__error-block">{{$errors->first('note')}}</span>
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
    $('#handover_time').flatpickr({
      locale: "{{ \Session::get('locale') }}",
      noCalendar: true,
      enableTime: true,
      dateFormat: "H:i",
      time_24hr: true,
      disableMobile: true
    });
  });
</script>
@endpush
