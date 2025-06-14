@extends('layouts.manage-layout')
@section('content')
<div class="container-wrapper">
  <div class="subcontainer user">
    <div class="content-wrapper">
      <h4>@lang('common.user') - @lang('common.list')</h4>

      <div class="grid-action-wrapper">
        <div class="grid-action">
          @include($viewPrefix.'._filter', ['obj' => $obj])
        </div>

        <div class="grid-action">
          @include('components.table.grid-export',['model' => 'User'])
        </div>
      </div>
      @include('components.table.pagination', ['data' => $data])
        <table class="grid-table table table-striped table-bordered table-responsive-sm">
          @include('components.table.header',[
            'headers' => [
              'action' => ['sortable' => false, 'title' => trans('common.action')],
              'name' => ['sortable' => true, 'title' => trans('validation.attributes.name')],
              'place_id' => ['sortable' => true, 'title' => trans('validation.attributes.place_id')],
              'username' => ['sortable' => true, 'title' => trans('validation.attributes.username')],
              'email' => ['sortable' => true, 'title' => trans('validation.attributes.email')],
              'phone' => ['sortable' => true, 'title' => trans('validation.attributes.phone')],
              'address' => ['sortable' => true, 'title' => trans('validation.attributes.address')],
              'status' => ['sortable' => true, 'title' => trans('validation.attributes.status')],
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
              </td>
              <td>{{$row->name}}</td>
              <td>{{$row->place->complete_label}}</td>
              <td>{{$row->username}}</td>
              <td>{{$row->email}}</td>
              <td>{{$row->phone}}</td>
              <td>{!! nl2br($row->address) !!}
              </td>
              <td>@lang('application-constant.USER_STATUS.'.$row->status)</td>
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
  @include('layouts.includes.title', ['title' => \Lang::get('common.user') .' - '. \Lang::get('common.list')])
@endsection
