@extends('layouts.manage-layout')

@section('content')
<h4>@lang('common.report') @lang('common.payment-request-service')</h4>
<div class="container-wrapper">
  <div class="subcontainer report-payment-request-service">
    <section class="card components__card-section-wrapper">
      <div class="card-header"><i class="c_icon fas fa-filter menu-icon"></i> @lang('common.filter')</div>
      <div class="card-body">
        <form action="{{route($routePrefix.'.payment-request-service')}}" method="GET">

          <div class="form-group">
            <label>@lang('validation.attributes.service_id')</label>
            <select class="form-control form-control-sm "
              id="service_id"
              name="filters[service_id]">
            <option></option>
            @foreach(\App\Models\Service::sortAsc()->get() as $service)
              <option value="{{ $service->id }}"
                {{ $obj->service_id == $service->id ? 'selected' : '' }}
                >{{ $service->name }}</option>
            @endforeach
            </select>
          </div>

          <div class="form-group">
            <label>@lang('validation.attributes.payment_type')</label>
            <select name="filters[payment_type]"
              class="form-control form-control-sm">
              <option></option>
              @foreach(App\Helpers\ApplicationConstant::PAYMENT_TYPE as $key => $value)
                <option value="{{$key}}" {{ $obj->payment_type == $key ? 'selected' : '' }}>
                  @lang('application-constant.PAYMENT_TYPE.'.$value)
                </option>
              @endforeach
            </select>
            <span class="c_form__error-block">{{$errors->first('payment_type')}}</span>
          </div>

          <div class="form-group">
            <label>@lang('validation.attributes.bank_account_id')</label>
            <select name="filters[bank_account_id]"
              class="form-control form-control-sm">
              <option></option>
              @foreach(App\Models\BankAccount::get() as $bankAccount)
                <option value="{{$bankAccount->id}}" {{ $obj->bank_account_id == $bankAccount->id ? 'selected' : '' }}>
                  {{$bankAccount->getUniqueLabelAttribute()}}
                </option>
              @endforeach
            </select>
            <span class="c_form__error-block">{{$errors->first('bank_account_id')}}</span>
          </div>
          
          <div class="form-group">
            <label>@lang('validation.attributes.pay_at')</label>

            <div class="form-row">
              <div class="col-md-4 mb-3">
                <input class="form-control form-control-sm"
                  name="filters[pay_at_start]"
                  id="pay_at_start"
                  autocomplete="off"
                  value="{{old('pay_at_start') ? old('pay_at_start') : $obj->pay_at_start}}" />
              </div>
              <div class="col-md-4 mb-3">
                <input class="form-control form-control-sm"
                  name="filters[pay_at_end]"
                  id="pay_at_end"
                  autocomplete="off"
                  value="{{old('pay_at_end') ? old('pay_at_end') : $obj->pay_at_end}}" />
              </div>
            </div>
          </div>

          <div>
            <button type="submit" class="btn btn-success" name="export_type" value="filter">
              <span class="action-icon">
                <i class="c_icon fas fa-filter menu-icon"></i> @lang('common.filter')
              </span>
            </button>
            <button type="submit" class="btn btn-success" name="export_type" value="export_by_service_and_place">
              <span class="action-icon">
                <i class="c_icon fas fa-file-export menu-icon"></i> @lang('common.export-by-service-and-place')
              </span>
            </button>
            <a href="{{route($routePrefix.'.payment-request-service')}}">
              <button type="button" class="btn btn-outline-secondary reset-filter">
                <span class="action-icon">
                  <i class="c_icon fas fa-sync-alt menu-icon"></i> @lang('common.reset')
                </span>
              </button>
            </a>
          </div>
        </form>
      </div>
    </section>
  </div>
</div>
@if($data)

<table class="grid-table table table-striped table-bordered table-responsive-sm">
  @include('components.table.header',[
    'headers' => [
      'payment_code' => ['sortable' => true, 'title' => trans('validation.attributes.payment_code')],
      'service_id' => ['sortable' => true, 'title' => trans('validation.attributes.service_id')],
      'user_id' => ['sortable' => true, 'title' => trans('validation.attributes.user_id')],
      'pay_at' => ['sortable' => true, 'title' => trans('validation.attributes.pay_at')],
      'payment_type' => ['sortable' => true, 'title' => trans('validation.attributes.payment_type')],
      'amount' => ['sortable' => true, 'title' => trans('validation.attributes.amount')],
    ]
  ])
  <tbody>
  @php $totalIdr = 0; $totalJpy = 0; @endphp
  @foreach($data as $row)
    <tr>
      <td>{{$row->payment_code}}</td>
      <td>{{$row->service->name}}</td>
      <td>{{$row->payment->user->name}}</td>
      <td>{{$row->payment->pay_at}}</td>
      <td>@lang('application-constant.PAYMENT_TYPE.'.App\Helpers\ApplicationConstant::PAYMENT_TYPE[$row->payment->payment_type])</td>
      <td>{{\App\Utils\NumberUtil::currencyFormat($row->amount, $row->payment->currency)}}</td>
    </tr>
    
    @php
    if($row->payment->currency == "IDR")
      $totalIdr += $row->amount;
    if($row->payment->currency == "JPY")
      $totalJpy += $row->amount;
    @endphp
  @endforeach
  </tbody>
</table>

<h6>@lang('common.total'): {{ \App\Utils\NumberUtil::currencyFormat($totalIdr, 'IDR') }} | {{ \App\Utils\NumberUtil::currencyFormat($totalJpy, 'JPY') }}</h6>
@endif
@endsection

@section('title')
  @include('layouts.includes.title', ['title' => \Lang::get('common.report')." ".\Lang::get('common.payment-request-service')])
@endsection

@push('javascript')
<script>
  $( function() {
    $("#pay_at_start, #pay_at_end").flatpickr({
      locale: "{{ \Session::get('locale') }}",
      dateFormat: "Y-m-d",
      disableMobile: true
    });
  });
</script>
@endpush