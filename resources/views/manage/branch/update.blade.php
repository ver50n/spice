@extends('layouts.manage-layout')
@section('content')
  <h4>@lang('common.branch') - @lang('common.update')</h4>
	<div class="grid-action-wrapper">
		<div class="grid-action">
			<a href="{{route($routePrefix.'.list')}}">
				<button class="btn btn-outline-secondary">
		      <i class="c_icon fas fa-receipt menu-icon"></i> @lang('common.list')
				</button>
			</a>
		</div>
		<div class="grid-action">
			<a href="{{route($routePrefix.'.create')}}">
				<button class="btn btn-outline-secondary">
		      <i class="c_icon fas fa-plus menu-icon"></i> @lang('common.create')
				</button>
			</a>
		</div>
		<div class="grid-action">
			<a href="{{route($routePrefix.'.update', ['id' => $obj->id])}}">
				<button class="btn btn-outline-secondary">
		      <i class="c_icon fas fa-edit menu-icon"></i> @lang('common.update')
				</button>
			</a>
		</div>
		<div class="grid-action">
			<a href="{{route($routePrefix.'.view', ['id' => $obj->id])}}">
				<button class="btn btn-outline-secondary">
		      <i class="c_icon fas fa-eye menu-icon"></i> @lang('common.view')
				</button>
			</a>
		</div>
		<div class="grid-action">
			<form action="{{route('helpers.activation')}}"
				id="grid-action-activation"
				method="POST"
			>
				@csrf
        <input type="hidden" name="model" value="Place"/>
        <input type="hidden" name="id" value="{{$obj->id}}"/>
			</form>
      @if($obj->is_active == 0)
      <button class="btn btn-success"
        onClick="document.getElementById('grid-action-activation').submit()">
        <i class="c_icon fas fa-check menu-icon"></i> @lang('common.activate')
      </button>
      @else
      <button class="btn btn-danger"
        onClick="document.getElementById('grid-action-activation').submit()">
        <i class="c_icon fas fa-times menu-icon"></i> @lang('common.disactivate')
      </button>
      @endif
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
        <section class="component__update-form">
          <form action="{{route($routePrefix.'.updatePost', ['id' => $obj->id])}}"
            method="POST"
            enctype="multipart/form-data"
            autocomplete="off">
            @csrf
            <div class="form-group">
              <label>@lang('validation.attributes.name')</label> <span class="e_required">*</span>
              <input class="form-control form-control-sm"
                name="name"
                value="{{old('name') ? old('name') : $obj->name}}"
                placeholder="@lang('validation.attributes.name')" />
              <span class="c_form__error-block">{{$errors->first('name')}}</span>
            </div>
            
            <div class="form-group">
              <label>@lang('validation.attributes.address')</label> <span class="e_required">*</span>
              <textarea class="form-control form-control-sm"
                rows="5"
                name="address"
                placeholder="@lang('validation.attributes.address')">{{ old('address') ? old('address') : $obj->address }}</textarea>
              <span class="c_form__error-block">{{$errors->first('address')}}</span>
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
              <label>@lang('validation.attributes.operation_day')</label> <span class="e_required">*</span>
              <input class="form-control form-control-sm"
                name="operation_day"
                value="{{old('operation_day') ? old('operation_day') : $obj->operation_day}}"
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
                value="{{ old('operation_start_time') ? old('operation_start_time') : $obj->operation_start_time }}"
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
                value="{{ old('operation_end_time') ? old('operation_end_time') : $obj->operation_end_time }}"
                placeholder="@lang('validation.attributes.operation_end_time')" />
              <span class="form-text text-muted">* @lang('validation.guidance.calendar_reference')</span>
              <span class="c_form__error-block">{{$errors->first('operation_end_time')}}</span>
            </div>
            
            <div class="form-group">
              <label>@lang('validation.attributes.map_url')</label>
              <input class="form-control form-control-sm"
                name="map_url"
                value="{{old('map_url') ? old('map_url') : $obj->map_url}}"
                placeholder="@lang('validation.attributes.map_url')" />
              <span class="c_form__error-block">{{$errors->first('map_url')}}</span>
            </div>

            <div class="form-group">
              <label>@lang('validation.attributes.announcement')</label>
              <textarea class="form-control form-control-sm"
                rows="5"
                name="announcement"
                placeholder="@lang('validation.attributes.announcement')">{{ old('announcement') ? old('announcement') : $obj->announcement }}</textarea>
              <span class="c_form__error-block">{{$errors->first('announcement')}}</span>
            </div>

            <div class="form-group">
              <label>@lang('validation.attributes.note')</label>
              <textarea class="form-control form-control-sm"
                rows="5"
                name="note"
                placeholder="@lang('validation.attributes.note')">{{ old('note') ? old('note') : $obj->note }}</textarea>
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
  @include('layouts.includes.title', ['title' => \Lang::get('common.branch') .' - '. \Lang::get('common.update')])
@endsection