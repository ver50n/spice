<ul class="nav nav-tabs" id="setting-tab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="account-tab" data-toggle="tab" data-target="#account" type="button" role="tab" aria-controls="account" aria-selected="true">@lang('common.account')</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="true">@lang('common.profile')</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="bank-account-tab" data-toggle="tab" data-target="#bank-account" type="button" role="tab" aria-controls="bank-account" aria-selected="true">@lang('common.bank-account')</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="notif-tab" data-toggle="tab" data-target="#notif" type="button" role="tab" aria-controls="notif" aria-selected="true">@lang('common.notification')</button>
  </li>
</ul>

<div class="tab-content">
  <br />
  <div class="tab-pane active" id="account" role="tabpanel" aria-labelledby="account-tab">
    <section class="card components__card-section-wrapper">
      <div class="card-header">
        <a data-toggle="collapse" href="#collapse-view__update-account"
          aria-expanded="true"
          aria-controls="collapse-view__update-account"
          id="view" class="d-block">
        <i class="c_icon fa fa-chevron-down pull-right"> </i> @lang('common.update-account')
        </a>
      </div>
      <div id="collapse-view__update-account" class="collapse show">
        <div class="card-body">
          @include('components.pages.account-edit-form', [
            'url' => route($routePrefix.'.updatePost', ['id' => $obj->id]),
            'actor' => 'admin'
          ])
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
          @include('components.pages.change-password-form', [
            'postUrl' => route($routePrefix.'.changePasswordPost', ['id' => $obj->id])
          ])
        </div>
      </div>
    </section>
  </div>

  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
    <section class="card components__card-section-wrapper">
      <div class="card-header">
        <a data-toggle="collapse" href="#collapse-view__profile-setting"
        aria-expanded="true"
        aria-controls="collapse-view__profile-setting"
        id="view" class="d-block">
        <i class="c_icon fa fa-chevron-down pull-right"></i> @lang('common.profile-setting')
        </a>
      </div>
      <div id="collapse-view__profile-setting" class="collapse show">
        <div class="card-body">
          @include('components.pages.profile-form', [
            'url' => route($routePrefix.'.updatePost', ['id' => $obj->id]),
            'actor' => 'admin'
          ])
        </div>
      </div>
    </section>
  </div>

  <div class="tab-pane fade" id="bank-account" role="tabpanel" aria-labelledby="bank-account-tab">
    <section class="card components__card-section-wrapper">
      <div class="card-header">
        <a data-toggle="collapse" href="#collapse-view__bank-account-setting"
        aria-expanded="true"
        aria-controls="collapse-view__bank-account-setting"
        id="view" class="d-block">
        <i class="c_icon fa fa-chevron-down pull-right"></i> @lang('common.bank-account-setting')
        </a>
      </div>
      <div id="collapse-view__bank-account-setting" class="collapse show">
        <div class="card-body">
          @include('components.pages.bank-account-form', ['url' => route($routePrefix.'.updatePost', ['id' => $obj->id])])
        </div>
      </div>
    </section>
  </div>

  <div class="tab-pane fade" id="notif" role="tabpanel" aria-labelledby="notif-tab">
    <section class="card components__card-section-wrapper">
      <div class="card-header">
        <a data-toggle="collapse" href="#collapse-view__notif-setting"
        aria-expanded="true"
        aria-controls="collapse-view__notif-setting"
        id="view" class="d-block">
        <i class="c_icon fa fa-chevron-down pull-right"></i> @lang('common.notif-setting')
        </a>
      </div>
      <div id="collapse-view__notif-setting" class="collapse show">
        <div class="card-body">
          <form action="{{route($routePrefix.'.updatePost', ['id' => $obj->id])}}"
            method="POST"
            enctype="multipart/form-data"
            autocomplete="off">
            @csrf
            <input type="hidden" name="nav" value="notif" />

            <div>
              <button type="submit" class="btn btn-outline-primary">
                <span class="action-icon">
                  <i class="c_icon fas fa-save menu-icon"></i> @lang('common.save')
                </span>
              </button>
            </div>
          </form>
        </div>
      </div>
    </section>
  </div>
  
  <div class="tab-pane fade" id="preference" role="tabpanel" aria-labelledby="preference-tab">
    <section class="card components__card-section-wrapper">
      <div class="card-header">
        <a data-toggle="collapse" href="#collapse-view__preference-setting"
        aria-expanded="true"
        aria-controls="collapse-view__preference-setting"
        id="view" class="d-block">
        <i class="c_icon fa fa-chevron-down pull-right"></i> @lang('common.preference-setting')
        </a>
      </div>
      <div id="collapse-view__preference-setting" class="collapse show">
        <div class="card-body">
          <form action="{{route($routePrefix.'.updatePost', ['id' => $obj->id])}}"
            method="POST"
            enctype="multipart/form-data"
            autocomplete="off">
            @csrf
            <input type="hidden" name="nav" value="preference" />

            <div>
              <button type="submit" class="btn btn-outline-primary">
                <span class="action-icon">
                  <i class="c_icon fas fa-save menu-icon"></i> @lang('common.save')
                </span>
              </button>
            </div>
          </form>
        </div>
      </div>
    </section>
  </div>

</div>

@push('javascript')
<script>
  $(document).ready(function() {
    $('#dob, #gojukai_at, #received_gohonzon_at, #shinjin_from, #passport_expirate_at').flatpickr({
      locale: "{{ \Session::get('locale') }}",
      dateFormat: "Y-m-d",
      disableMobile: true,
      maxDate: 'today'
    });

    $('#setting-tab li button#{{ request()->get('nav') }}-tab').tab('show');
  });
</script>
@endpush