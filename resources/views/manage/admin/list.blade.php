@extends('layouts.manage-layout')

@section('content')
<div class="container-wrapper">
  <div class="subcontainer admin">
    <div class="content-wrapper">
      <h4>@lang('common.admin') - @lang('common.list')</h4>

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
          @include('components.table.grid-export',['model' => 'Admin'])
        </div>
      </div>
      
      @include('components.table.pagination', ['data' => $data])
      <table class="grid-table table table-striped table-bordered table-responsive-sm">
        @include('components.table.header',[
          'headers' => [
            'action' => ['sortable' => false, 'title' => trans('common.action')],
            'name' => ['sortable' => true, 'title' => trans('validation.attributes.name')],
            'username' => ['sortable' => true, 'title' => trans('validation.attributes.username')],
            'branch' => ['sortable' => true, 'title' => trans('validation.attributes.branch_id')],
            'phone' => ['sortable' => true, 'title' => trans('validation.attributes.phone')],
            'role' => ['sortable' => true, 'title' => trans('validation.attributes.role')],
            'email' => ['sortable' => true, 'title' => trans('validation.attributes.email')],
            'is_active' => ['sortable' => true, 'title' => trans('validation.attributes.is_active')],
            'reset_password' => ['sortable' => false, 'title' => trans('validation.attributes.password')],
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
            <td>{{$row->name}}</td>
            <td>{{$row->username}}</td>
            <td>{{$row->branch?->name}}</td>
            <td>{{$row->phone}}</td>
            <td>@lang('application-constant.ADMIN_ROLE.'.App\Helpers\ApplicationConstant::ADMIN_ROLE[$row->role])</td>
            <td>{{$row->email}}</td>
            <td>
              <form action="{{route('helpers.activation')}}"
                id="grid-action-activation-{{$row->id}}"
                method="POST"
              >
                @csrf
                <input type="hidden" name="model" value="Admin"/>
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
            <td>
              <form action="{{route('manage.admin.resetPasswordPost')}}"
                id="grid-action-reset-password-{{$row->id}}"
                method="POST"
              >
                @csrf
                <input type="hidden" name="id" value="{{$row->id}}"/>
              </form>
              <button class="btn btn-secondary"
                onClick="document.getElementById('grid-action-reset-password-{{$row->id}}').submit()">
                <i class="c_icon fas fa-recycle menu-icon"></i> @lang('common.reset')
              </button>
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
  @include('layouts.includes.title', ['title' => \Lang::get('common.admin') .' - '. \Lang::get('common.list')])
@endsection
