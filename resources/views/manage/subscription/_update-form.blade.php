<section class="component__update-form">
  <form action="{{route($routePrefix.'.updatePost', ['id' => $obj->id])}}"
    method="POST"
    enctype="multipart/form-data"
    autocomplete="off">
    @csrf

    <div class="form-group">
      <label>@lang('validation.attributes.customer_id')</label> <span class="e_required">*</span>
      <select name="customer_id"
        class="form-control form-control-sm">
        @php
          $oldValue = old('customer_id') ? old('customer_id') : $obj->customer_id;
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
      <label>@lang('validation.attributes.subscription_amount')</label> <span class="e_required">*</span>
      <input class="form-control form-control-sm"
        type="number"
        name="subscription_amount"
        value="{{old('subscription_amount') ? old('subscription_amount') : $obj->subscription_amount}}"
        placeholder="@lang('validation.attributes.subscription_amount')" />
      <span class="c_form__error-block">{{$errors->first('subscription_amount')}}</span>
    </div>

    <div class="form-group">
      <label>@lang('validation.attributes.handover_method')</label> <span class="e_required">*</span>
      <select name="handover_method"
        class="form-control form-control-sm">
        @php
          $oldValue = old('handover_method') ? old('handover_method') : $obj->handover_method;
        @endphp
        @foreach(App\Helpers\ApplicationConstant::HANDOVER_METHOD as $key => $value)
          <option value="{{$key}}"
            {{ $oldValue == $key ? 'selected' : '' }}
          >
            @lang('application-constant.HANDOVER_METHOD.'.$value)
          </option>
        @endforeach
      </select>
      <span class="c_form__error-block">{{$errors->first('handover_method')}}</span>
    </div>
    
    <div class="form-group">
      <label>@lang('validation.attributes.handover_time')</label> <span class="e_required">*</span>
      <input class="form-control form-control-sm"
        id="handover_time"
        name="handover_time"
        value="{{old('handover_time') ? old('handover_time') : $obj->handover_time}}"
        placeholder="@lang('validation.attributes.handover_time')" />
      <span class="c_form__error-block">{{$errors->first('handover_time')}}</span>
    </div>

    <div class="form-group">
      <label>@lang('validation.attributes.note')</label>
      <textarea class="form-control form-control-sm"
        name="note"
        rows="5"
        placeholder="@lang('validation.attributes.note')">{{ old('note') ? old('note') : $obj->note }}</textarea>
      <span class="c_form__error-block">{{$errors->first('note')}}</span>
    </div>

    <div>
      <button type="submit" class="btn btn-outline-primary">
        <span class="action-icon">
          <i class="c_icon fas fa-save menu-icon"></i> @lang('common.save')
        </span>
      </button>
      <button type="button"
        class="btn btn-outline-primary add"
        data-toggle="modal"
        data-target="#entry-subscription-item">
        <span class="action-icon">
          <i class="c_icon fas fa-add menu-icon"></i> @lang('common.entry-subscription-item')
        </span>
      </button>
    </div>
  </form>
  <hr />
  
  <table class="grid-table table table-striped table-bordered table-responsive-sm">
    @include('components.table.header',[
      'headers' => [
        'action' => ['sortable' => false, 'title' => trans('common.action')],
        'variant_id' => ['sortable' => true, 'title' => trans('validation.attributes.variant_id')],
        'subscription_container' => ['sortable' => true, 'title' => trans('validation.attributes.subscription_container')],
        'subscription_qty' => ['sortable' => true, 'title' => trans('validation.attributes.subscription_qty')],
        'subscription_price' => ['sortable' => true, 'title' => trans('validation.attributes.subscription_price')],
        'subscription_subtotal' => ['sortable' => true, 'title' => trans('validation.attributes.subscription_subtotal')],
        'note' => ['sortable' => true, 'title' => trans('validation.attributes.note')],
      ]
    ])
    <tbody>
    @foreach($obj->subscriptionDetails as $detail)
      <tr>
        <td>
          <div class="icon-wrapper">
            <span class="action-icon edit" 
              data-toggle="modal"
              data-target="#entry-subscription-item">
              <i class="c_icon icon fas fa-pencil menu-icon" title="edit"></i>
            </span>
          </div>
          
          <div class="icon-wrapper">
            <span class="action-icon delete-prs"
              onClick="document.getElementById('delete-subscription-item-{{$detail->id}}').submit()">
              <i class="c_icon icon fas fa-trash menu-icon" title="delete"></i>
            </span>
          </div>
          <form action="{{ route($routePrefix.'.deleteSubscriptionItemPost', ['id' => $obj->id]) }}"
            id="delete-subscription-item-{{$detail->id}}"
            method="POST"
          >
            @csrf
            <input type="hidden" name="subscription_detail_id" class="subscription_detail_id" value="{{$detail->id}}" />
          </form>
        </td>
        <td>{{$detail->variant?->variantCompleteName()}}<input type="hidden" class="variant_id-ref" value="{{$detail->variant_id}}" /></td>
        <td>{{\App\Utils\NumberUtil::numberFormat($detail->subscription_container)}}<input type="hidden" class="subscription_container-ref" value="{{$detail->subscription_container}}" /></td>
        <td>{{\App\Utils\NumberUtil::currencyFormat($detail->subscription_price)}}<input type="hidden" class="subscription_price-ref" value="{{$detail->subscription_price}}" /></td>
        <td>{{\App\Utils\NumberUtil::numberFormat($detail->subscription_qty)}}<input type="hidden" class="subscription_qty-ref" value="{{$detail->subscription_qty}}" /></td>
        <td>{{\App\Utils\NumberUtil::currencyFormat($detail->subscription_subtotal)}}<input type="hidden" class="subscription_subtotal-ref" value="{{$detail->subscription_subtotal}}" /></td>
        <td class="note-ref">{{$detail->note}}</td>
      </tr>
    @endforeach
    </tbody>
  </table>
</section>

<section class="component__entry-form">
  <div class="modal fade" id="entry-subscription-item"
    role="dialog"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="card">
          <div class="card-header"><i class="c_icon fas fa-file-pen menu-icon"></i> @lang('common.entry-subscription-item')</div>
          <div class="card-body">
            <form action="{{ route($routePrefix.'.updateSubscriptionItemPost', ['id' => $obj->id]) }}"
              id="update-subscription-item-form"
              method="POST"
              enctype="multipart/form-data"
              autocomplete="off">
              @csrf
              <input type="hidden" name="subscription_id" value="{{$obj->id}}" />
              <input type="hidden" name="subscription_detail_id" id="subscription_detail_id" />

              <div class="form-group">
                <label>@lang('validation.attributes.variant_id')</label>
                <select name="variant_id"
                  class="form-control form-control-sm"
                  id="variant_id">
                  <option></option>
                  @foreach(App\Models\ProductVariant::get() as $variant)
                    <option value="{{$variant->id}}" {{ old('variant_id') == $variant->id ? 'selected' : '' }}>
                      {{ $variant->variantCompleteName() }}
                    </option>
                  @endforeach
                </select>
                <span class="c_form__error-block">{{$errors->first('variant_id')}}</span>
              </div>

              <div class="form-group">
                <label>@lang('validation.attributes.subscription_container')</label> <span class="e_required">*</span>
                <div class="input-group mb-3">
                  <input class="form-control form-control-sm"
                    id="subscription_container"
                    value="{{ old('subscription_container')}}"
                    name="subscription_container"
                    placeholder="@lang('validation.attributes.subscription_container')" />
                </div>
                <span class="c_form__error-block">{{$errors->first('subscription_container')}}</span>
              </div>

              <div class="form-group">
                <label>@lang('validation.attributes.subscription_price')</label> <span class="e_required">*</span>
                <div class="input-group mb-3">
                  <input class="form-control form-control-sm"
                    id="subscription_price"
                    type="number"
                    value="{{ old('subscription_price')}}"
                    name="subscription_price"
                    placeholder="@lang('validation.attributes.subscription_price')" />
                </div>
                <span class="c_form__error-block">{{$errors->first('subscription_price')}}</span>
              </div>

              <div class="form-group">
                <label>@lang('validation.attributes.subscription_qty')</label> <span class="e_required">*</span>
                <div class="input-group mb-3">
                  <input class="form-control form-control-sm"
                    id="subscription_qty"
                    type="number"
                    value="{{ old('subscription_qty')}}"
                    name="subscription_qty"
                    placeholder="@lang('validation.attributes.subscription_qty')" />
                </div>
                <span class="c_form__error-block">{{$errors->first('subscription_price')}}</span>
              </div>

              <div class="form-group">
                <label>@lang('validation.attributes.subscription_subtotal')</label> <span class="e_required">*</span>
                <div class="input-group mb-3">
                  <input class="form-control form-control-sm"
                    id="subscription_subtotal"
                    type="number"
                    value="{{ old('subscription_subtotal')}}"
                    readonly
                    name="subscription_subtotal"
                    placeholder="@lang('validation.attributes.subscription_subtotal')" />
                </div>
                <span class="c_form__error-block">{{$errors->first('subscription_subtotal')}}</span>
              </div>
              
              <div class="form-group">
                <label>@lang('validation.attributes.note')</label>
                <textarea class="form-control form-control-sm"
                  name="note"
                  rows="5"
                  placeholder="@lang('validation.attributes.note')">{{ old('note') }}</textarea>
                <span class="c_form__error-block">{{$errors->first('note')}}</span>
              </div>

              <button type="button" class="btn btn-outline-primary reset">
                <span class="action-icon">
                  <i class="c_icon fas fa-sync menu-icon"></i> @lang('common.reset')
                </span>
              </button>
              <button type="submit" class="btn btn-outline-primary">
                <span class="action-icon">
                  <i class="c_icon fas fa-save menu-icon"></i> @lang('common.save')
                </span>
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


@push('javascript')
<script>
  $(document).ready(function() {
    $('.reset').click(function() {
      resetEntryForm();
    });

    $('.add').click(function() {
      resetEntryForm();
    });
    @if(old('subscription_detail_id') || session('error'))
      $('#entry-subscription-item').modal('show');
      $('#subscription_detail_id').val("{{old('subscription_detail_id')}}");
    @endif

    $('.edit').click(function() {
      parent = $(this).parent().parent().parent();

      $('#subscription_detail_id').val(parent.find('.subscription_detail_id').val());
      $('#variant_id').val(parent.find('.variant_id-ref').val());
      $('#subscription_container').val(parent.find('.subscription_container-ref').html());
      $('#subscription_price').val(parent.find('.subscription_price-ref').html());
      $('#subscription_qty').val(parent.find('.subscription_qty-ref').html());
      $('#subscription_subtotal').val(parent.find('.subscription_subtotal-ref').html());
      $('#note').val(parent.find('.note-ref').html());
    });

    $('#subscription_qty, #subscription_price').on('change', function() {
      recalculateSubtotal();
    });

    function recalculateSubtotal() {
      let price = parseFloat($('#subscription_price').val()) || 0;
      let qty = parseFloat($('#subscription_qty').val()) || 0;
      let subtotal = price * qty;
      $('#subscription_subtotal').val(subtotal);
    };

    function resetEntryForm() {
      $('#subscription_detail_id').val("");
      $('#subscription_container').val("");
      $('#subscription_price').val("");
      $('#subscription_qty').val("");
      $('#subscription_subtotal').val("");
      $('#note').val("");
    };

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