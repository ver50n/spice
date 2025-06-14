@extends('layouts.manage-layout')

@section('content')
  <div class="container-wrapper">
    <div class="subcontainer mailTemplate">
      <div class="content-wrapper">
        <h4>@lang('common.bank-account') - @lang('common.list')</h4>

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
            @include('components.table.grid-export',['model' => 'BankAccount'])
          </div>
        </div>

        @include('components.table.pagination', ['data' => $data])
        <table class="grid-table table table-striped table-bordered table-responsive-sm">
          @include('components.table.header',[
            'headers' => [
              'action' => ['sortable' => false, 'title' => trans('common.action')],
              'bank_name' => ['sortable' => true, 'title' => trans('validation.attributes.bank_name')],
              'branch_name' => ['sortable' => true, 'title' => trans('validation.attributes.branch_name')],
              'account_number' => ['sortable' => true, 'title' => trans('validation.attributes.account_number')],
              'account_name' => ['sortable' => true, 'title' => trans('validation.attributes.account_name')],
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
              <td>{{$row->bank_name}}</td>
              <td>{{$row->branch_name}}</td>
              <td>{{$row->account_number}}</td>
              <td>{{$row->account_name}}</td>
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
  @include('layouts.includes.title', ['title' => \Lang::get('common.bank-account') .' - '. \Lang::get('common.list')])
@endsection
