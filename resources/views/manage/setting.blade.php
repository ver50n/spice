@extends('layouts.manage-layout')
@section('content')
<h4>@lang('common.setting')</h4>

<section class="card components__card-section-wrapper">
	<div class="card-header">
		<a data-toggle="collapse" href="#collapse-view__update-account"
		aria-expanded="true"
		aria-controls="collapse-view__update-account"
		id="view" class="d-block">
		<i class="c_icon fa fa-chevron-down pull-right"></i> @lang('common.update-account')
		</a>
	</div>
	<div id="collapse-view__update-account" class="collapse show">
		<div class="card-body">
      <section class="component__update-form">
        <form action="{{route('manage.saveSetting')}}"
          method="POST"
          enctype="multipart/form-data"
          autocomplete="off">
          @csrf
          <div class="form-group">
            <label>@lang('validation.attributes.username')</label> <span class="e_required">*</span>
            <input class="form-control form-control-sm"
              name="username"
              value="{{old('username') ? old('username') : $obj->username}}"
              placeholder="@lang('validation.attributes.username')" />
            <span class="c_form__error-block">{{$errors->first('username')}}</span>
          </div>

          <div class="form-group">
            <label>@lang('validation.attributes.email')</label> <span class="e_required">*</span>
            <input class="form-control form-control-sm"
              name="email"
              value="{{old('email') ? old('email') : $obj->email}}"
              placeholder="@lang('validation.attributes.email')" />
            <span class="c_form__error-block">{{$errors->first('email')}}</span>
          </div>
          <div>
            <button type="submit" class="btn btn-outline-primary">
              <span class="action-icon">
                <i class="c_icon fas fa-save menu-icon"></i> @lang('common.save')
              </span>
            </button>
          </div>
        </form>
      </section>
    </div>
	</div>
</section>

<section class="card components__card-section-wrapper">
	<div class="card-header">
		<a data-toggle="collapse" href="#collapse-view__change-password"
		aria-expanded="true"
		aria-controls="collapse-view__change-password"
		id="view" class="d-block">
		<i class="c_icon fa fa-chevron-down pull-right"></i> @lang('common.change-password')
		</a>
	</div>
	<div id="collapse-view__change-password" class="collapse show">
		<div class="card-body">
			@include('components.pages.change-password-form', ['postUrl' => route('manage.change-password-post')])
		</div>
	</div>
</section>
@endsection

@section('title')
  @include('layouts.includes.title', ['title' => \Lang::get('common.setting')])
@endsection