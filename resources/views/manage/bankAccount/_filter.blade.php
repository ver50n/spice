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
                <label>@lang('validation.attributes.bank_name')</label>
                <input class="form-control form-control-sm"
                  name="filters[bank_name]"
                  value="{{$obj->bank_name}}"
                  autocomplete="off" />
              </div>
              <div class="form-group">
                <label>@lang('validation.attributes.branch_name')</label>
                <input class="form-control form-control-sm"
                  name="filters[branch_name]"
                  value="{{$obj->branch_name}}"
                  autocomplete="off" />
              </div>
              <div class="form-group">
                <label>@lang('validation.attributes.account_number')</label>
                <input class="form-control form-control-sm"
                  name="filters[account_number]"
                  value="{{$obj->account_number}}"
                  autocomplete="off" />
              </div>
              <div class="form-group">
                <label>@lang('validation.attributes.account_name')</label>
                <input class="form-control form-control-sm"
                  name="filters[account_name]"
                  value="{{$obj->account_name}}"
                  autocomplete="off" />
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