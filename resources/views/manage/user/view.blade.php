@extends('layouts.manage-layout')
@section('content')
  <h4>@lang('common.user') - @lang('common.view')</h4>
	<div class="grid-action-wrapper">
		<div class="grid-action">
			<a href="{{route($routePrefix.'.list')}}">
				<button class="btn btn-outline-secondary">
		      <i class="c_icon fas fa-receipt menu-icon"></i> @lang('common.list')
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
      @if($obj->status == 'registered' && $obj->is_verify_request == 4)
      <a href="{{ route('manage.user.approve-user-verification', [
            'id' => $obj->id,
            ]) }}">
        <button class="btn btn-success">
          <i class="c_icon fas fa-check menu-icon"></i> @lang('common.approve')
        </button>
      </a>
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
              <th><label>@lang('validation.attributes.id')</label></th>
              <td><label>{{$obj->id}}</label></td>
            </tr>
            <tr>
              <th><label>@lang('validation.attributes.uniq')</label></th>
              <td><label>{{$obj->uniq}}</label></td>
            </tr>
            <tr>
              <th><label>@lang('validation.attributes.username')</label></th>
              <td><label>{{$obj->username}}</label></td>
            </tr>
            <tr>
              <th><label>@lang('validation.attributes.name')</label></th>
              <td><label>{{$obj->name}}</label></td>
            </tr>
            <tr>
              <th><label>@lang('validation.attributes.gender')</label></th>
              <td><label>@lang('application-constant.GENDER.'.App\Helpers\ApplicationConstant::GENDER[$obj->gender])</label></td>
            </tr>
            <tr>
              <th><label>@lang('validation.attributes.email')</label></th>
              <td><label>{{$obj->email}}</label></td>
            </tr>
            <tr>
              <th><label>@lang('validation.attributes.phone')</label></th>
              <td><label>{{$obj->phone}}</label></td>
            </tr>
            <tr>
              <th><label>@lang('validation.attributes.dob')</label></th>
              <td><label>{{$obj->dob}}</label></td>
            </tr>
            <tr>
              <th><label>@lang('validation.attributes.gojukai_at')</label></th>
              <td><label>{{$obj->gojukai_at}}</label></td>
            </tr>
            <tr>
              <th><label>@lang('validation.attributes.address')</label></th>
              <td><label>{!! nl2br($obj->address) !!}</label></td>
            </tr>
            <tr>
              <th><label>@lang('validation.attributes.place_id')</label></th>
              <td><label>{{$obj->place->organization}} - {{$obj->place->sentra}} - {{$obj->place->cetya}}</label></td>
            </tr>
            <tr>
              <th><label>@lang('validation.attributes.note')</label></th>
              <td><label>{!! nl2br($obj->note) !!}</label></td>
            </tr>
            <tr>
              <th><label>@lang('validation.attributes.user_note')</label></th>
              <td><label>{!! nl2br($obj->user_note) !!}</label></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="card components__card-section-wrapper">
    <div class="card-header">
      <a data-toggle="collapse" href="#collapse-view__pic-info"
        aria-expanded="true"
        aria-controls="collapse-view__pic-info"
        id="view" class="d-block">
        <i class="c_icon fa fa-chevron-down pull-right menu-icon"></i> @lang('common.pic-info')</i>
      </a>
    </div>
    <div id="collapse-view__pic-info" class="collapse show">
      <div class="card-body">
        <table class="table table-bordered table-striped table-hover table-condensed">
          <thead>
            <tr>
              <th><label>@lang('validation.attributes.role')</label></th>
              <th><label>@lang('validation.attributes.place_id')</label></th>
              <th><label>@lang('validation.attributes.is_active')</label></th>
            </tr>
          </thead>
          <tbody>
            @foreach($obj->placePics as $pic)
            <tr>
              <td><label>@lang('application-constant.PLACE_PIC_ROLE.'.App\Helpers\ApplicationConstant::PLACE_PIC_ROLE[$pic->role])</label></td>
              <td><label>{{$pic->place->complete_label}}</label></td>
              <td><label>@lang('application-constant.YES_NO.'.App\Helpers\ApplicationConstant::YES_NO[$pic->is_active])</label></td>
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
  @include('layouts.includes.title', ['title' => \Lang::get('common.user') .' - '. \Lang::get('common.view')])
@endsection