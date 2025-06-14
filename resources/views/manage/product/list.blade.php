@extends('layouts.manage-layout')

@section('content')
<div class="container-wrapper">
  <div class="subcontainer product">
    <div class="content-wrapper">
      <h4>@lang('common.product') - @lang('common.list')</h4>

      <div class="grid-action-wrapper">
        <div class="grid-action">
          @include($viewPrefix.'._filter', ['obj' => $obj])
        </div>
        
        <div class="grid-action">
          <a href="{{route($routePrefix.'.create')}}">
            <button class="btn btn-outline-secondary">
              <i class="c_icon fas fa-plus menu-icon"></i> @lang('common.create')
            </button>
          </a>
        </div>
        
        <div class="grid-action">
          @include('components.table.grid-export',['model' => 'Product'])
        </div>
      </div>

      @include('components.table.pagination', ['data' => $data])
      <table class="grid-table table table-striped table-bordered table-responsive-sm">
        @include('components.table.header',[
          'headers' => [
            'action' => ['sortable' => false, 'title' => trans('common.action')],
            'product_category' => ['sortable' => true, 'title' => trans('validation.attributes.product_category')],
            'product_name' => ['sortable' => true, 'title' => trans('validation.attributes.product_name')],
            'variant_name' => ['sortable' => true, 'title' => trans('validation.attributes.variant_name')],
            'is_active' => ['sortable' => true, 'title' => trans('validation.attributes.is_active')],
          ]
        ])
        <tbody>
        @foreach($data as $row)
          <tr>
            <td>
              <div class="icon-wrapper">
                <a href="{{route($routePrefix.'.view', ['id' => $row->id])}}">
                  <span class="action-icon">
                    <i class="c_icon icon fas fa-eye menu-icon" title="view"></i>
                  </span>
                </a>
              </div>
              <div class="icon-wrapper">
                <a href="{{route($routePrefix.'.update', ['id' => $row->id])}}">
                  <span class="action-icon">
                    <i class="c_icon icon fas fa-edit menu-icon" title="edit"></i>
                  </span>
                </a>
              </div>
            </td>
            <td>@lang('application-constant.PRODUCT_CATEGORY.'.App\Helpers\ApplicationConstant::PRODUCT_CATEGORY[$row->product_category])</td>
            <td>{{$row->product_name}}</td>
            <td>
            @foreach($row->productVariants as $variant)
              <button type="button" class="btn btn-secondary">{{$variant->variant_name}}<br /> {{\App\Utils\NumberUtil::currencyFormat($variant->variant_price)}}</button>
            @endforeach
            </td>
            <td>
              <form action="{{route('helpers.activation')}}"
                id="grid-action-activation-{{$row->id}}"
                method="POST"
              >
                @csrf
                <input type="hidden" name="model" value="Product"/>
                <input type="hidden" name="id" value="{{$row->id}}"/>
              </form>
              @if($row->is_active == 0)
              <button class="btn btn-success"
                onClick="document.getElementById('grid-action-activation-{{$row->id}}').submit()">
                <i class="c_icon fas fa-check menu-icon"></i> @lang('common.activate')
              </button>
              @else
              <button class="btn btn-danger"
                onClick="document.getElementById('grid-action-activation-{{$row->id}}').submit()">
                <i class="c_icon fas fa-times menu-icon"></i> @lang('common.disactivate')
              </button>
              @endif
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
      @include('components.table.pagination', ['data' => $data])
    </div>
  </div>
</div>
@endsection

@section('title')
  @include('layouts.includes.title', ['title' => \Lang::get('common.product') .' - '. \Lang::get('common.list')])
@endsection
