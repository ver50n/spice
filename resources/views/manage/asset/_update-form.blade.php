<section class="component__update-form">
  <form action="{{route($routePrefix.'.updatePost', ['id' => $obj->id])}}"
    method="POST"
    enctype="multipart/form-data"
    autocomplete="off">
    @csrf

    <div class="form-group">
      <label>@lang('validation.attributes.branch_id')</label> <span class="e_required">*</span>
      <select name="branch_id"
        class="form-control form-control-sm">
        @php
          $oldValue = old('branch_id') ? old('branch_id') : $obj->branch_id;
        @endphp
        @foreach(App\Models\Branch::get() as $branch)
          <option value="{{$branch->id}}" {{ $oldValue == $branch->id ? 'selected' : '' }}>
            {{$branch->name}}
          </option>
        @endforeach
      </select>
      <span class="c_form__error-block">{{$errors->first('branch_id')}}</span>
    </div>
    <div class="form-group">
      <label>@lang('validation.attributes.asset_category')</label> <span class="e_required">*</span>
      <select name="asset_category"
        class="form-control form-control-sm">
        @php
          $oldValue = old('asset_category') ? old('asset_category') : $obj->asset_category;
        @endphp
        @foreach(App\Helpers\ApplicationConstant::ASSET_CATEGORY as $key => $value)
          <option value="{{$key}}" {{ $oldValue == $key ? 'selected' : '' }}>
            @lang('application-constant.ASSET_CATEGORY.'.$value)
          </option>
        @endforeach
      </select>
      <span class="c_form__error-block">{{$errors->first('asset_category')}}</span>
    </div>
    <div class="form-group">
      <label>@lang('validation.attributes.asset_name')</label> <span class="e_required">*</span>
      <input class="form-control form-control-sm"
        name="asset_name"
        id="asset_name"
        value="{{old('asset_name') ? old('asset_name') : $obj->asset_name}}"
        placeholder="@lang('validation.attributes.asset_name')" />
      <span class="c_form__error-block">{{$errors->first('asset_name')}}</span>
    </div>
    <div class="form-group">
      <label>@lang('validation.attributes.initial_price')</label> <span class="e_required">*</span>
      <input class="form-control form-control-sm"
        type="number"
        name="initial_price"
        id="initial_price"
        value="{{old('initial_price') ? old('initial_price') : $obj->initial_price}}"
        placeholder="@lang('validation.attributes.initial_price')" />
      <span class="c_form__error-block">{{$errors->first('initial_price')}}</span>
    </div>
    <div class="form-group">
      <label>@lang('validation.attributes.current_price')</label> <span class="e_required">*</span>
      <input class="form-control form-control-sm"
        type="number"
        name="current_price"
        id="current_price"
        value="{{old('current_price') ? old('current_price') : $obj->current_price}}"
        placeholder="@lang('validation.attributes.current_price')" />
      <span class="c_form__error-block">{{$errors->first('current_price')}}</span>
    </div>
    <div class="form-group">
      <label>@lang('validation.attributes.lifespan')</label> <span class="e_required">*</span>
      <input class="form-control form-control-sm"
        type="number"
        name="lifespan"
        id="lifespan"
        value="{{old('lifespan') ? old('lifespan') : $obj->lifespan}}"
        placeholder="@lang('validation.attributes.lifespan')" />
      <span class="c_form__error-block">{{$errors->first('lifespan')}}</span>
    </div>
    <div class="form-group">
      <label>@lang('validation.attributes.asset_status')</label> <span class="e_required">*</span>
      <select name="asset_status"
        class="form-control form-control-sm">
        @php
          $oldValue = old('asset_status') ? old('asset_status') : $obj->asset_status;
        @endphp
        @foreach(App\Helpers\ApplicationConstant::ASSET_STATUS as $key => $value)
          <option value="{{$key}}" {{ $oldValue == $key ? 'selected' : '' }}>
            @lang('application-constant.ASSET_STATUS.'.$value)
          </option>
        @endforeach
      </select>
      <span class="c_form__error-block">{{$errors->first('asset_status')}}</span>
    </div>
    <div class="form-group">
      <label>@lang('validation.attributes.desc')</label>
      <textarea class="form-control form-control-sm"
        rows="5"
        name="desc"
        placeholder="@lang('validation.attributes.desc')">{{ old('desc') ? old('desc') : $obj->desc }}</textarea>
      <span class="c_form__error-block">{{$errors->first('desc')}}</span>
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