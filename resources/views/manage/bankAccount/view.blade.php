@extends('layouts.manage-layout')
@section('content')
  <h4>@lang('common.bank-account') - @lang('common.view')</h4>
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
              <th><label>@lang('validation.attributes.bank_code')</label></th>
              <td><label>{{$obj->bank_code}}</label></td>
            </tr>
            <tr>
              <th><label>@lang('validation.attributes.bank_name')</label></th>
              <td><label>{{$obj->bank_name}}</label></td>
            </tr>
            <tr>
              <th><label>@lang('validation.attributes.branch_code')</label></th>
              <td><label>{{$obj->branch_code}}</label></td>
            </tr>
            <tr>
              <th><label>@lang('validation.attributes.branch_name')</label></th>
              <td><label>{{$obj->branch_name}}</label></td>
            </tr>
            <tr>
              <th><label>@lang('validation.attributes.account_number')</label></th>
              <td><label>{{$obj->account_number}}</label></td>
            </tr>
            <tr>
              <th><label>@lang('validation.attributes.account_type')</label></th>
              <td><label>@lang('application-constant.BANK_ACCOUNT_TYPE.'.$obj->account_type)</label></td>
            </tr>
            <tr>
              <th><label>@lang('validation.attributes.account_name')</label></th>
              <td><label>{{$obj->account_name}}</label></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>
@endsection

@section('title')
  @include('layouts.includes.title', ['title' => \Lang::get('common.bank-account') .' - '. \Lang::get('common.view')])
@endsection