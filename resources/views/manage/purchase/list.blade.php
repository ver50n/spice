@extends('layouts.manage-layout')

@section('content')
<div class="container-wrapper">
  <div class="subcontainer place">
    <div class="content-wrapper">
      <h4>@lang('common.purchase') - @lang('common.list')</h4>

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
          @include('components.table.grid-export',['model' => 'Purchase'])
        </div>
      </div>

      @include('components.table.pagination', ['data' => $data])
      <table class="grid-table table table-striped table-bordered table-responsive-sm">
        @include('components.table.header',[
          'headers' => [
            'action' => ['sortable' => false, 'title' => trans('common.action')],
            'purchase_cd' => ['sortable' => true, 'title' => trans('validation.attributes.purchase_cd')],
            'supplier_id' => ['sortable' => true, 'title' => trans('validation.attributes.supplier_id')],
            'purchase_amount' => ['sortable' => true, 'title' => trans('validation.attributes.purchase_amount')],
            'purchase_at' => ['sortable' => true, 'title' => trans('validation.attributes.purchase_at')],
            'purchase_status' => ['sortable' => true, 'title' => trans('validation.attributes.purchase_status')],
            'payment_status' => ['sortable' => true, 'title' => trans('validation.attributes.payment_status')],
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
            <td>{{$row->purchase_cd}}</td>
            <td>{{$row->supplier?->name}}</td>
            <td>{{$row->purchase_amount}}</td>
            <td>{{$row->purchase_at}}</td>
            <td>@lang('application-constant.PURCHASE_STATUS.'.App\Helpers\ApplicationConstant::PURCHASE_STATUS[$row->purchase_status])</td>
            <td>@lang('application-constant.PAYMENT_STATUS.'.App\Helpers\ApplicationConstant::PAYMENT_STATUS[$row->payment_status])</td>
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
  @include('layouts.includes.title', ['title' => \Lang::get('common.purchase') .' - '. \Lang::get('common.list')])
@endsection
