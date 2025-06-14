<section class="component__create-form">
  <form action="{{route($routePrefix.'.createPost')}}"
    method="POST"
    enctype="multipart/form-data"
    autocomplete="off">
    @csrf

    <div class="form-group">
      <label>@lang('validation.attributes.supplier_id')</label> <span class="e_required">*</span>
      <select name="supplier_id"
        class="form-control form-control-sm">
        @php
          $oldValue = old('supplier_id');
        @endphp
        @foreach(App\Models\Supplier::get() as $supplier)
          <option value="{{$supplier->id}}" {{ $oldValue == $supplier->id ? 'selected' : '' }}>
            {{$supplier->name}}
          </option>
        @endforeach
      </select>
      <span class="c_form__error-block">{{$errors->first('supplier_id')}}</span>
    </div>

    <div class="form-group">
      <label>@lang('validation.attributes.purchase_amount')</label> <span class="e_required">*</span>
      <input class="form-control form-control-sm"
        type="number"
        name="purchase_amount"
        value="{{old('purchase_amount')}}"
        placeholder="@lang('validation.attributes.purchase_amount')" />
      <span class="c_form__error-block">{{$errors->first('purchase_amount')}}</span>
    </div>

    <div class="form-group">
      <label>@lang('validation.attributes.purchase_at')</label> <span class="e_required">*</span>
      <input class="form-control form-control-sm"
        id="purchase_at"
        name="purchase_at"
        value="{{old('purchase_at')}}"
        placeholder="@lang('validation.attributes.purchase_at')" />
      <span class="c_form__error-block">{{$errors->first('purchase_at')}}</span>
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
    $('#purchase_at').flatpickr({
      locale: "{{ \Session::get('locale') }}",
      dateFormat: "Y-m-d",
      disableMobile: true,
      maxDate: 'today'
    });
  });
</script>
@endpush
