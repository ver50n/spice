@extends('layouts.manage-layout')
@section('content')
  <h4>@lang('common.asset') - @lang('common.view')</h4>
	<div class="grid-action-wrapper">
		<div class="grid-action">
			<a href="{{route($routePrefix.'.list')}}">
				<button class="btn btn-outline-secondary">
		      <i class="c_icon fas fa-receipt menu-icon"></i> @lang('common.list')
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
              <th><label>@lang('validation.attributes.asset_cd')</label></th>
              <td><label>{{$obj->asset_cd}}</label></td>
            </tr>
            <tr>
              <th><label>@lang('validation.attributes.asset_category')</label></th>
              <td><label>@lang('application-constant.ASSET_CATEGORY.'.App\Helpers\ApplicationConstant::ASSET_CATEGORY[$obj->asset_category])</label></td>
            </tr>
            <tr>
              <th><label>@lang('validation.attributes.asset_name')</label></th>
              <td><label>{{$obj->asset_name}}</label></td>
            </tr>
            <tr>
              <th><label>@lang('validation.attributes.purchase_cd')</label></th>
              <td><label>{{$obj->purchase_cd}}</label></td>
            </tr>
            <tr>
              <th><label>@lang('validation.attributes.initial_price')</label></th>
              <td><label>{{\App\Utils\NumberUtil::currencyFormat($obj->initial_price)}}</label></td>
            </tr>
            <tr>
              <th><label>@lang('validation.attributes.current_price')</label></th>
              <td><label>{{\App\Utils\NumberUtil::currencyFormat($obj->current_price)}}</label></td>
            </tr>
            <tr>
              <th><label>@lang('validation.attributes.purchase_dt')</label></th>
              <td><label>{{$obj->purchase_dt}}</label></td>
            </tr>
            <tr>
              <th><label>@lang('validation.attributes.lifespan')</label></th>
              <td><label>{{$obj->lifespan}}</label></td>
            </tr>
            <tr>
              <th><label>@lang('validation.attributes.expire_dt')</label></th>
              <td><label>{{$obj->expire_dt}}</label></td>
            </tr>
            <tr>
              <th><label>@lang('validation.attributes.desc')</label></th>
              <td><label>{!! nl2br($obj->desc) !!}</label></td>
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
              <th><label>@lang('validation.attributes.asset_status')</label></th>
              <td><label>@lang('application-constant.ASSET_STATUS.'.App\Helpers\ApplicationConstant::ASSET_STATUS[$obj->asset_status])</label></td>
            </tr>
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
  @include('layouts.includes.title', ['title' => \Lang::get('common.asset') .' - '. \Lang::get('common.view')])
@endsection