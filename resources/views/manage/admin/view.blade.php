@extends('layouts.manage-layout')
@section('content')
  <h4>@lang('common.admin') - @lang('common.view')</h4>
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
        <input type="hidden" name="model" value="Admin"/>
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
        <i class="c_icon fa fa-chevron-down pull-right menu-icon"></i> @lang('common.basic-info')
      </a>
    </div>
    <div id="collapse-view__base-info" class="collapse show">
      <div class="card-body">
        <table class="table table-bordered table-striped table-hover table-condensed">
          <tbody>
            <tr>
              <th><label>@lang('validation.attributes.id')</label></th>
              <td><label>{{$obj->id}}</label></td>
            </tr>
            <tr>
              <th><label>@lang('validation.attributes.id_number')</label></th>
              <td><label>{{$obj->id_number}}</label></td>
            </tr>
            <tr>
              <th><label>@lang('validation.attributes.branch')</label></th>
              <td><label>{{$obj->branch?->name}}</label></td>
            </tr>
            <tr>
              <th><label>@lang('validation.attributes.role')</label></th>
              <td><label>@lang('application-constant.ADMIN_ROLE.'.App\Helpers\ApplicationConstant::ADMIN_ROLE[$obj->role])</label></td>
            </tr>
            <tr>
              <th><label>@lang('validation.attributes.name')</label></th>
              <td><label>{{$obj->name}}</label></td>
            </tr>
            <tr>
              <th><label>@lang('validation.attributes.username')</label></th>
              <td><label>{{$obj->username}}</label></td>
            </tr>
            <tr>
              <th><label>@lang('validation.attributes.gender')</label></th>
              <td><label>@lang('application-constant.GENDER.'.App\Helpers\ApplicationConstant::GENDER[$obj->gender])</label></td>
            </tr>
            <tr>
              <th><label>@lang('validation.attributes.email')</label></th>
              <td><label>{{$obj->email}}</label></td>
            </tr>
            <tr>
              <th><label>@lang('validation.attributes.phone')</label></th>
              <td><label>{{$obj->phone}}</label></td>
            </tr>
            <tr>
              <th><label>@lang('validation.attributes.dob')</label></th>
              <td><label>{{$obj->dob}}</label></td>
            </tr>
            <tr>
              <th><label>@lang('validation.attributes.address')</label></th>
              <td><label>{!! nl2br($obj->address) !!}</label></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="card components__card-section-wrapper">
    <div class="card-header">
      <a data-toggle="collapse" href="#collapse-view__status-info"
        aria-expanded="true"
        aria-controls="collapse-view__status-info"
        id="view" class="d-block">
        <i class="c_icon fa fa-chevron-down pull-right menu-icon"></i> @lang('common.status-info')</label></i>
      </a>
    </div>
    <div id="collapse-view__status-info" class="collapse show">
      <div class="card-body">
        <table class="table table-bordered table-striped table-hover table-condensed">
          <tbody>
            <tr>
              <th><label>@lang('validation.attributes.is_active')</label></th>
              <td><label>@lang('application-constant.YES_NO.'.App\Helpers\ApplicationConstant::YES_NO[$obj->is_active])</label></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="card components__card-section-wrapper">
    <div class="card-header">
      <a data-toggle="collapse" href="#collapse-view__log-info"
        aria-expanded="true"
        aria-controls="collapse-view__log-info"
        id="view" class="d-block">
        <i class="c_icon fa fa-chevron-down pull-right menu-icon"></i> @lang('common.log-info')</i>
      </a>
    </div>
    <div id="collapse-view__log-info" class="collapse show">
      <div class="card-body">
        <table class="table table-bordered table-striped table-hover table-condensed">
          <tbody>
            <tr>
              <th><label>@lang('validation.attributes.created_at')</label></th>
              <td><label>{{$obj->created_at}}</label></td>
            </tr>
            <tr>
              <th><label>@lang('validation.attributes.updated_at')</label></th>
              <td><label>{{$obj->updated_at}}</label></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>
@endsection

@section('title')
  @include('layouts.includes.title', ['title' => \Lang::get('common.admin') .' - '. \Lang::get('common.view')])
@endsection