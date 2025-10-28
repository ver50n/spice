@extends('layouts.manage-layout')
@section('content')
  <h4>@lang('common.subscription') - @lang('common.view')</h4>
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
              <th><label>@lang('validation.attributes.subscription_name')</label></th>
              <td><label>{{$obj->subscription_name}}</label></td>
            </tr>
            <tr>
              <th><label>@lang('validation.attributes.subscription_amount')</label></th>
              <td><label>{{\App\Utils\NumberUtil::currencyFormat($obj->subscription_amount)}}</label></td>
            </tr>
            <tr>
              <th><label>@lang('validation.attributes.subscription_at')</label></th>
              <td><label>{{$obj->subscription_at}}</label></td>
            </tr>
            <tr>
              <th><label>@lang('validation.attributes.pay_at')</label></th>
              <td><label>{{$obj->pay_at}}</label></td>
            </tr>
            <tr>
              <th><label>@lang('validation.attributes.note')</label></th>
              <td><label>{!! nl2br($obj->note) !!}</label></td>
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
              <th><label>@lang('validation.attributes.subscription_status')</label></th>
              <td><label>@lang('application-constant.EXPENSE_STATUS.'.App\Helpers\ApplicationConstant::EXPENSE_STATUS[$obj->subscription_status])</label></td>
            </tr>
            <tr>
              <th><label>@lang('validation.attributes.payment_status')</label></th>
              <td><label>@lang('application-constant.PAYMENT_STATUS.'.App\Helpers\ApplicationConstant::PAYMENT_STATUS[$obj->payment_status])</label></td>
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
  @include('layouts.includes.title', ['title' => \Lang::get('common.subscription') .' - '. \Lang::get('common.view')])
@endsection