<section class="component__update-form">
  <form action="{{route($routePrefix.'.updatePost', ['id' => $obj->id])}}"
    method="POST"
    enctype="multipart/form-data"
    autocomplete="off">
    @csrf
    <div class="form-group">
      <label>@lang('validation.attributes.role')</label> <span class="e_required">*</span>
      @php
        $oldValue = old('role') ? old('role') : $obj->role;
      @endphp
      <select class="form-control form-control-sm "
        name="role">
      @foreach(\App\Helpers\ApplicationConstant::ADMIN_ROLE as $role => $label)
        <option value="{{ $role }}"
          {{ $oldValue == $role ? 'selected' : '' }}
          >@lang('application-constant.ADMIN_ROLE.'.$label)</option>
      @endforeach
      </select>
    </div>
    <div class="form-group">
      <label>@lang('validation.attributes.branch_id')</label> <span class="e_required">*</span>
      @php
        $oldValue = old('branch_id') ? old('branch_id') : $obj->branch_id;
      @endphp
      <select class="form-control form-control-sm branch_id"
        id="branch_id"
        name="branch_id">
      @foreach(\App\Models\Branch::get() as $branch)
        <option value="{{ $branch->id }}"
          {{ $oldValue == $branch->id ? 'selected' : '' }}
          >{{ $branch->name }}</option>
      @endforeach
      </select>
    </div>
    <div class="form-group">
      <label>@lang('validation.attributes.id_number')</label> <span class="e_required">*</span>
      <input class="form-control form-control-sm"
        name="id_number"
        value="{{old('id_number') ? old('id_number') : $obj->id_number}}"
        placeholder="@lang('validation.attributes.id_number')" />
      <span class="c_form__error-block">{{$errors->first('id_number')}}</span>
    </div>
    <div class="form-group">
      <label>@lang('validation.attributes.name')</label> <span class="e_required">*</span>
      <input class="form-control form-control-sm"
        name="name"
        value="{{old('name') ? old('name') : $obj->name}}"
        placeholder="@lang('validation.attributes.name')" />
      <span class="c_form__error-block">{{$errors->first('name')}}</span>
    </div>
    <div class="form-group">
      <label>@lang('validation.attributes.username')</label> <span class="e_required">*</span>
      <input class="form-control form-control-sm"
        name="username"
        value="{{old('username') ? old('username') : $obj->username}}"
        placeholder="@lang('validation.attributes.username')" />
      <span class="c_form__error-block">{{$errors->first('username')}}</span>
    </div>
    <div class="form-group">
      <label>@lang('validation.attributes.dob')</label> <span class="e_required">*</span>
      <input class="form-control form-control-sm"
        name="dob"
        id="dob"
        readOnly
        value="{{ old('dob') ? old('dob') : $obj->dob }}"
        placeholder="@lang('validation.attributes.dob')" />
      <span class="form-text text-muted">* @lang('validation.guidance.calendar_reference')</span>
      <span class="c_form__error-block">{{$errors->first('dob')}}</span>
    </div>
    <div class="form-group">
      <label>@lang('validation.attributes.gender')</label> <span class="e_required">*</span>
      @php
        $oldValue = old('gender') ? old('gender') : $obj->gender;
      @endphp
      <select name="gender"
        id="gender"
        class="form-control form-control-sm">
      @foreach(App\Helpers\ApplicationConstant::GENDER as $key => $value)
        <option value="{{$key}}" {{ $oldValue == $key ? 'selected' : '' }}>
          @lang('application-constant.GENDER.'.$value)
        </option>
      @endforeach
      </select>
    </div>
    <div class="form-group">
      <label>@lang('validation.attributes.phone')</label> <span class="e_required">*</span>
      <input class="form-control form-control-sm"
        name="phone"
        value="{{old('phone') ? old('phone') : $obj->phone}}"
        placeholder="@lang('validation.attributes.phone')" />
      <span class="form-text text-muted">* @lang('validation.guidance.without_hyphen')</span>
      <span class="c_form__error-block">{{$errors->first('phone')}}</span>
    </div>
    <div class="form-group">
      <label>@lang('validation.attributes.address')</label> <span class="e_required">*</span>
      <textarea class="form-control form-control-sm"
        name="address"
        rows="5"
        placeholder="@lang('validation.attributes.address')">{{ old('address') ? old('address') : $obj->address }}</textarea>
      <span class="c_form__error-block">{{$errors->first('address')}}</span>
    </div>
    <div class="form-group">
      <label>@lang('validation.attributes.start_work_at')</label> <span class="e_required">*</span>
      <input class="form-control form-control-sm"
        name="start_work_at"
        id="start_work_at"
        readOnly
        value="{{ old('start_work_at') ? old('start_work_at') : $obj->start_work_at }}"
        placeholder="@lang('validation.attributes.start_work_at')" />
      <span class="form-text text-muted">* @lang('validation.guidance.calendar_reference')</span>
      <span class="c_form__error-block">{{$errors->first('start_work_at')}}</span>
    </div>
    <div class="form-group">
      <label>@lang('validation.attributes.end_work_at')</label>
      <input class="form-control form-control-sm"
        name="end_work_at"
        id="end_work_at"
        readOnly
        value="{{ old('end_work_at') ? old('end_work_at') : $obj->end_work_at }}"
        placeholder="@lang('validation.attributes.end_work_at')" />
      <span class="form-text text-muted">* @lang('validation.guidance.calendar_reference')</span>
      <span class="c_form__error-block">{{$errors->first('end_work_at')}}</span>
    </div>
    <div class="form-group">
      <label>@lang('validation.attributes.salary')</label> <span class="e_required">*</span>
      <input class="form-control form-control-sm"
        type="number"
        name="salary"
        value="{{old('salary') ? old('salary') : $obj->salary}}"
        placeholder="@lang('validation.attributes.salary')" />
      <span class="c_form__error-block">{{$errors->first('salary')}}</span>
    </div>
    <div class="form-group">
      <label>@lang('validation.attributes.email')</label>
      <input class="form-control form-control-sm"
        type="email"
        name="email"
        value="{{old('email') ? old('email') : $obj->email}}"
        placeholder="@lang('validation.attributes.email')" />
      <span class="c_form__error-block">{{$errors->first('email')}}</span>
    </div>
    <div class="form-group">
      <label>@lang('validation.attributes.password')</label>
      <input class="form-control form-control-sm"
        type="password"
        name="password"
        placeholder="@lang('validation.attributes.password')" />
      <span class="c_form__error-block">{{$errors->first('password')}}</span>
    </div>
    <div class="form-group">
      <label>@lang('validation.attributes.confirm_password')</label>
      <input class="form-control form-control-sm"
        type="password"
        name="confirm_password"
        placeholder="@lang('validation.attributes.confirm_password')" />
      <span class="c_form__error-block">{{$errors->first('confirm_password')}}</span>
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

@push('javascript')
<script>
  $(document).ready(function() {
    $('#dob, #start_work_at, #end_work_at').flatpickr({
      locale: "{{ \Session::get('locale') }}",
      dateFormat: "Y-m-d",
      disableMobile: true,
      maxDate: 'today'
    });
  });
</script>
@endpush