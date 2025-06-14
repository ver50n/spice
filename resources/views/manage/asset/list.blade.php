@extends('layouts.manage-layout')

@section('content')
<div class="container-wrapper">
  <div class="subcontainer place">
    <div class="content-wrapper">
      <h4>@lang('common.asset') - @lang('common.list')</h4>

      <div class="grid-action-wrapper">
        <div class="grid-action">
          @include($viewPrefix.'._filter', ['obj' => $obj])
        </div>
        
        <div class="grid-action">
          @include('components.table.grid-export',['model' => 'Asset'])
        </div>
      </div>

      @include('components.table.pagination', ['data' => $data])
      <table class="grid-table table table-striped table-bordered table-responsive-sm">
        @include('components.table.header',[
          'headers' => [
            'action' => ['sortable' => false, 'title' => trans('common.action')],
            'asset_category' => ['sortable' => true, 'title' => trans('validation.attributes.asset_category')],
            'asset_name' => ['sortable' => true, 'title' => trans('validation.attributes.asset_name')],
            'initial_price' => ['sortable' => true, 'title' => trans('validation.attributes.initial_price')],
            'purchase_dt' => ['sortable' => true, 'title' => trans('validation.attributes.purchase_dt')],
            'asset_status' => ['sortable' => true, 'title' => trans('validation.attributes.asset_status')],
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
            <td>@lang('application-constant.ASSET_CATEGORY.'.App\Helpers\ApplicationConstant::ASSET_CATEGORY[$row->asset_category])</td>
            <td>{{$row->asset_name}} ({{$row->asset_cd}})</td>
            <td>{{\App\Utils\NumberUtil::currencyFormat($row->initial_price)}} ({{\App\Utils\NumberUtil::currencyFormat($row->current_price)}})</td>
            <td>{{$row->purchase_dt.' - '.$row->expire_dt}}</td>
            <td>@lang('application-constant.ASSET_STATUS.'.App\Helpers\ApplicationConstant::ASSET_STATUS[$row->asset_status])</td>
            <td>
              <form action="{{route('helpers.activation')}}"
                id="grid-action-activation-{{$row->id}}"
                method="POST"
              >
                @csrf
                <input type="hidden" name="model" value="Asset"/>
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
  @include('layouts.includes.title', ['title' => \Lang::get('common.asset') .' - '. \Lang::get('common.list')])
@endsection
