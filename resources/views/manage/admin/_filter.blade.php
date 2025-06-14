<section class="component__filter-form">
  <button type="button"
    class="btn btn-outline-secondary"
    data-toggle="modal"
    data-target="#filter-popup">
    <span class="action-icon">
      <i class="c_icon fas fa-filter menu-icon"></i> @lang('common.filter')
    </span>
  </button>
  <div class="modal fade" id="filter-popup"
    tabindex="-1"
    role="dialog"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="card">
          <div class="card-header"><i class="c_icon fas fa-filter menu-icon"></i> @lang('common.filter')</div>
          <div class="card-body">
            <form action="{{route($routePrefix.'.list')}}" method="GET">

              <div class="form-group">
                <label>@lang('validation.attributes.name')</label>
                <input class="form-control form-control-sm"
                  name="filters[name]"
                  value="{{$obj->name}}"
                  autocomplete="off" />
              </div>
              <div class="form-group">
                <label>@lang('validation.attributes.username')</label>
                <input class="form-control form-control-sm"
                  name="filters[username]"
                  value="{{$obj->username}}"
                  autocomplete="off" />
              </div>
              <div class="form-group">
                <label>@lang('validation.attributes.email')</label>
                <input class="form-control form-control-sm"
                  name="filters[email]"
                  value="{{$obj->email}}"
                  autocomplete="off" />
              </div>
              <div class="form-group">
                <label>@lang('validation.attributes.role')</label> <span class="e_required">*</span>
                @php
                  $oldValue = $obj->role;
                @endphp
                <select class="form-control form-control-sm "
                  name="filters[role]">
                  <option value=""></option>
                @foreach(\App\Helpers\ApplicationConstant::ADMIN_ROLE as $role => $label)
                  <option value="{{ $role }}"
                    {{ $oldValue == $role ? 'selected' : '' }}
                    >@lang('application-constant.ADMIN_ROLE.'.$label)</option>
                @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>@lang('validation.attributes.is_active')</label>
                <select name="filters[is_active]"
                  class="form-control form-control-sm">
                  <option value=""></option>
                @foreach(App\Helpers\ApplicationConstant::YES_NO as $val => $label)
                  <option value="{{$val}}" {{ (string)$obj->is_active == $val ? 'selected' : '' }}>
                    @lang('application-constant.YES_NO.'.$label)
                  </option>
                @endforeach
                </select>
              </div>
              <div>
                <button type="submit" class="btn btn-success">
                  <span class="action-icon">
                    <i class="c_icon fas fa-filter menu-icon"></i> @lang('common.filter')
                  </span>
                </button>
                <a href="{{route($routePrefix.'.list')}}">
                  <button type="button" class="btn btn-outline-secondary reset-filter">
                    <span class="action-icon">
                      <i class="c_icon fas fa-sync-alt menu-icon"></i> @lang('common.reset')
                    </span>
                  </button>
                </a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>