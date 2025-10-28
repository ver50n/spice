@extends('layouts.manage-layout')

@section('content')
<div class="container-wrapper">
  <div class="subcontainer place">
    <div class="content-wrapper">
      <h4>@lang('common.subscription') - @lang('common.list')</h4>

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
          @include('components.table.grid-export',['model' => 'Subscription'])
        </div>
      </div>

      @include('components.table.pagination', ['data' => $data])
      <table class="grid-table table table-striped table-bordered table-responsive-sm">
        @include('components.table.header',[
          'headers' => [
            'action' => ['sortable' => false, 'title' => trans('common.action')],
            'customer_id' => ['sortable' => true, 'title' => trans('validation.attributes.customer_id')],
            'handover_time' => ['sortable' => true, 'title' => trans('validation.attributes.handover_time')],
            'subscription_amount' => ['sortable' => true, 'title' => trans('validation.attributes.subscription_amount')],
            'subscription_qty' => ['sortable' => true, 'title' => trans('validation.attributes.subscription_qty')],
            'subscription_subtotal' => ['sortable' => true, 'title' => trans('validation.attributes.subscription_subtotal')],
            'note' => ['sortable' => true, 'title' => trans('validation.attributes.note')],
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
            <td>{{$row->customer->name}}</td>
            <td>{{$row->handover_time}}</td>
            <td>{{\App\Utils\NumberUtil::currencyFormat($row->subscription_amount)}}</td>
            <td>{{$row->subscription_qty}}</td>
            <td>{{$row->subscription_subtotal}}</td>
            <td>{!! nl2br($row->note) !!}</td>
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
  @include('layouts.includes.title', ['title' => \Lang::get('common.subscription') .' - '. \Lang::get('common.list')])
@endsection
