@extends('layouts.manage-layout')

@section('content')
<h4>@lang('common.report') @lang('common.sotoba-daily')</h4>
<div class="container-wrapper">
  <div class="subcontainer report-sotoba-daily">
    <section class="card components__card-section-wrapper no-print">
      <div class="card-header"><i class="c_icon fas fa-filter menu-icon"></i> @lang('common.filter')</div>
      <div class="card-body">
        <form action="{{route($routePrefix.'.sotoba-daily')}}" method="GET">
          <div class="form-group">
            <label>@lang('validation.attributes.conducted_at')</label> <span class="e_required">*</span>
            <input class="form-control form-control-sm"
              name="filters[conducted_at]"
              id="conducted_at"
              readOnly
              value="{{ $obj->conducted_at }}"
              placeholder="@lang('validation.attributes.conducted_at')" />
            <span class="c_form__error-block">{{$errors->first('conducted_at')}}</span>
          </div>

          <div>
            <a href="{{route($routePrefix.'.sotoba-daily')}}">
              <button type="button" class="btn btn-outline-secondary reset-filter">
                <span class="action-icon">
                  <i class="c_icon fas fa-sync-alt menu-icon"></i> @lang('common.reset')
                </span>
              </button>
            </a>
            <button type="submit" class="btn btn-success">
              <span class="action-icon">
                <i class="c_icon fas fa-filter menu-icon"></i> @lang('common.filter')
              </span>
            </button>
            <button type="button" class="btn btn-success print">
              <span class="action-icon">
                <i class="c_icon fas fa-print menu-icon"></i> @lang('common.print')
              </span>
            </button>
            <button type="button" class="btn btn-success print-for-altar">
              <span class="action-icon">
                <i class="c_icon fas fa-print menu-icon"></i> @lang('common.print-for-altar')
              </span>
            </button>
            <button type="submit" class="btn btn-success"
              name="done" value="done">
              <span class="action-icon">
                <i class="c_icon fas fa-check-double menu-icon"></i> @lang('common.done')
              </span>
            </button>
          </div>
        </form>
      </div>
    </section>
    
    @include('pdf-layout.sotoba-daily', ['obj' => $obj])
  </div>
</div>
@endsection

@section('title')
  @include('layouts.includes.title', ['title' => \Lang::get('common.report')." ".\Lang::get('common.sotoba-daily')])
@endsection

@push('javascript')
<script>
  $( function() {
    $("#conducted_at").flatpickr({
      locale: "{{ \Session::get('locale') }}",
      dateFormat: "Y-m-d",
      disableMobile: true
    });
  });
</script>
@endpush