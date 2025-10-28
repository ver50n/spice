@extends('layouts.manage-layout')
@section('content')
  <h4>@lang('common.product') - @lang('common.view')</h4>
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
        <input type="hidden" name="model" value="Product"/>
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
              <th><label>@lang('validation.attributes.product_category')</label></th>
              <td><label>@lang('application-constant.PRODUCT_CATEGORY.'.App\Helpers\ApplicationConstant::PRODUCT_CATEGORY[$obj->product_category])</label></td>
            </tr>
            <tr>
              <th><label>@lang('validation.attributes.product_name')</label></th>
              <td><label>{{$obj->product_name}}</label></td>
            </tr>
            <tr>
              <th><label>@lang('validation.attributes.purchase_price')</label></th>
              <td><label>{{$obj->purchase_price}}</label></td>
            </tr>
            <tr>
              <th><label>@lang('validation.attributes.sell_price')</label></th>
              <td><label>{{$obj->sell_price}}</label></td>
            </tr>
            <tr>
              <th><label>@lang('validation.attributes.product_thumbnail')</label></th>
              <td><label>
                @if($obj->product_thumbnail)
                <a href="{{ \App\Utils\FileUtil::getImageUrl('product', $obj->product_thumbnail, 's3') }}" target="_blank">
                  <img src="{{ \App\Utils\FileUtil::getImageUrl('product', $obj->product_thumbnail, 's3') }}" class="preview-image" />
                </a>
                @endif
              </label></td>
            </tr>
            <tr>
              <th><label>@lang('validation.attributes.product_desc')</label></th>
              <td><label>{!! nl2br($obj->product_desc) !!}</label></td>
            </tr>
            <tr>
              <th><label>@lang('validation.attributes.is_sell_to_customer')</label></th>
              <td><label>@lang('application-constant.YES_NO.'.App\Helpers\ApplicationConstant::YES_NO[$obj->is_sell_to_customer])</label></td>
            </tr>
            <tr>
              <th><label>@lang('validation.attributes.is_show_in_landing')</label></th>
              <td><label>@lang('application-constant.YES_NO.'.App\Helpers\ApplicationConstant::YES_NO[$obj->is_show_in_landing])</label></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>
  
  <section class="card components__card-section-wrapper">
    <div class="card-header">
      <a data-toggle="collapse" href="#collapse-view__variant-info"
        aria-expanded="true"
        aria-controls="collapse-view__variant-info"
        id="view" class="d-block">
        <i class="c_icon fa fa-chevron-down pull-right menu-icon"></i> @lang('common.variant-info')</label></i>
      </a>
    </div>
    <div id="collapse-view__variant-info" class="collapse show">
      <div class="card-body">
        <table class="grid-table table table-striped table-bordered table-responsive-sm">
          <thead>
            <tr>
              <th>@lang('validation.attributes.variant_name')</th>
              <th>@lang('validation.attributes.variant_price')</th>
              <th>@lang('validation.attributes.variant_stock')</th>
              <th>@lang('validation.attributes.is_active')</th>
            </tr>
          </thead>
          <tbody>
          @foreach($obj->productVariants as $variant)
            <tr>
              <td>{{ $variant->variant_name }}</td>
              <td>{{ \App\Utils\NumberUtil::currencyFormat($variant->variant_price) }}</td>
              <td>{{ \App\Utils\NumberUtil::numberFormat($variant->variant_stock) }}</td>
              <td>@lang('application-constant.YES_NO.'.App\Helpers\ApplicationConstant::YES_NO[$variant->is_active])</td>
            </tr>
          @endforeach
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
  @include('layouts.includes.title', ['title' => \Lang::get('common.product') .' - '. \Lang::get('common.view')])
@endsection