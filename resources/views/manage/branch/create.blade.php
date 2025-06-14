@extends('layouts.manage-layout')
@section('content')
  <h4>@lang('common.branch') - @lang('common.create')</h4>
	<div class="grid-action-wrapper">
		<div class="grid-action">
			<a href="{{route($routePrefix.'.list')}}">
				<button class="btn btn-outline-secondary">
		      <i class="c_icon fas fa-receipt menu-icon"></i> @lang('common.list')
				</button>
			</a>
		</div>
  </div>
  <section class="card components__card-section-wrapper">
    <div class="card-header">
      <a data-toggle="collapse" href="#collapse-view__base-info"
        aria-expanded="true"
        aria-controls="collapse-view__base-info"
        id="view" class="d-block">
        <i class="c_icon fa fa-chevron-down pull-right"></i> @lang('common.basic-info')
      </a>
    </div>
    <div id="collapse-view__base-info" class="collapse show">
      <div class="card-body">
        <section class="component__create-form">
          <form action="{{route($routePrefix.'.createPost')}}"
            method="POST"
            enctype="multipart/form-data"
            autocomplete="off">
            @csrf
            <div class="form-group">
              <label>@lang('validation.attributes.name')</label> <span class="e_required">*</span>
              <input class="form-control form-control-sm"
                name="name"
                value="{{old('name')}}"
                placeholder="@lang('validation.attributes.name')" />
              <span class="c_form__error-block">{{$errors->first('name')}}</span>
            </div>

            <div class="form-group">
              <label>@lang('validation.attributes.address')</label> <span class="e_required">*</span>
              <textarea class="form-control form-control-sm"
                name="address"
                rows="5"
                placeholder="@lang('validation.attributes.address')">{{old('address')}}</textarea>
              <span class="c_form__error-block">{{$errors->first('address')}}</span>
            </div>

            <div class="form-group">
              <label>@lang('validation.attributes.phone')</label> <span class="e_required">*</span>
              <input class="form-control form-control-sm"
                name="phone"
                value="{{old('phone')}}"
                placeholder="@lang('validation.attributes.phone')" />
              <span class="form-text text-muted">* @lang('validation.guidance.without_hyphen')</span>
              <span class="c_form__error-block">{{$errors->first('phone')}}</span>
            </div>

            <div class="form-group">
              <label>@lang('validation.attributes.operation_day')</label> <span class="e_required">*</span>
              <input class="form-control form-control-sm"
                name="operation_day"
                value="{{old('operation_day')}}"
                placeholder="@lang('validation.attributes.operation_day')" />
              <span class="form-text text-muted">* 1 = senin, 2 = selasa ... 7 = minggu</span>
              <span class="c_form__error-block">{{$errors->first('operation_day')}}</span>
            </div>
            
            <div class="form-group">
              <label>@lang('validation.attributes.operation_start_time')</label> <span class="e_required">*</span>
              <input class="form-control form-control-sm"
                name="operation_start_time"
                id="operation_start_time"
                readOnly
                value="{{ old('operation_start_time') }}"
                placeholder="@lang('validation.attributes.operation_start_time')" />
              <span class="form-text text-muted">* @lang('validation.guidance.calendar_reference')</span>
              <span class="c_form__error-block">{{$errors->first('operation_start_time')}}</span>
            </div>

            <div class="form-group">
              <label>@lang('validation.attributes.operation_end_time')</label> <span class="e_required">*</span>
              <input class="form-control form-control-sm"
                name="operation_end_time"
                id="operation_end_time"
                readOnly
                value="{{ old('operation_end_time') }}"
                placeholder="@lang('validation.attributes.operation_end_time')" />
              <span class="form-text text-muted">* @lang('validation.guidance.calendar_reference')</span>
              <span class="c_form__error-block">{{$errors->first('operation_end_time')}}</span>
            </div>

            <div class="form-group">
              <label>@lang('validation.attributes.map_url')</label> <span class="e_required">*</span>
              <input class="form-control form-control-sm"
                name="map_url"
                value="{{old('map_url')}}"
                placeholder="@lang('validation.attributes.map_url')" />
              <span class="c_form__error-block">{{$errors->first('map_url')}}</span>
            </div>
            
            <div class="form-group">
              <label>@lang('validation.attributes.announcement')</label>
              <textarea class="form-control form-control-sm"
                name="announcement"
                rows="5"
                placeholder="@lang('validation.attributes.announcement')">{{ old('announcement') }}</textarea>
              <span class="c_form__error-block">{{$errors->first('announcement')}}</span>
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
      </div>
    </div>
  </section>
@endsection

@section('title')
  @include('layouts.includes.title', ['title' => \Lang::get('common.branch') .' - '. \Lang::get('common.create')])
@endsection

@push('javascript')
<script>
  $(document).ready(function() {
    $('#operation_start_time, #operation_end_time').flatpickr({
      locale: document.documentElement.lang,
      noCalendar: true,
      enableTime: true,
      dateFormat: "H:i",
      time_24hr: true,
      disableMobile: true
    });
  });
</script>
@endpush