@extends('layouts.manage-layout')

@section('content')
<div class="container-wrapper">
  <div class="subcontainer place">
    <div class="content-wrapper">
      <h4>@lang('common.expense') - @lang('common.list')</h4>

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
          @include('components.table.grid-export',['model' => 'Expense'])
        </div>
      </div>

      @include('components.table.pagination', ['data' => $data])
      <table class="grid-table table table-striped table-bordered table-responsive-sm">
        @include('components.table.header',[
          'headers' => [
            'action' => ['sortable' => false, 'title' => trans('common.action')],
            'expense_cd' => ['sortable' => true, 'title' => trans('validation.attributes.expense_cd')],
            'expense_category' => ['sortable' => true, 'title' => trans('validation.attributes.expense_category')],
            'expense_name' => ['sortable' => true, 'title' => trans('validation.attributes.expense_name')],
            'expense_amount' => ['sortable' => true, 'title' => trans('validation.attributes.expense_amount')],
            'expense_at' => ['sortable' => true, 'title' => trans('validation.attributes.expense_at')],
            'pay_at' => ['sortable' => true, 'title' => trans('validation.attributes.pay_at')],
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
            <td>{{$row->expense_cd}}</td>
            <td>@lang('application-constant.EXPENSE_CATEGORY.'.App\Helpers\ApplicationConstant::EXPENSE_CATEGORY[$row->expense_category])</td>
            <td>{{$row->expense_name}}</td>
            <td>{{\App\Utils\NumberUtil::currencyFormat($row->expense_amount)}}</td>
            <td>{{$row->expense_at}}</td>
            <td>{{$row->pay_at}}</td>
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
  @include('layouts.includes.title', ['title' => \Lang::get('common.expense') .' - '. \Lang::get('common.list')])
@endsection
