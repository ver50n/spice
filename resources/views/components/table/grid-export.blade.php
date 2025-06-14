
<form id="grid-export-form" action="{{ route('helpers.export', Request::query()) }}" method="POST">
  @csrf
  <input type="hidden" name="model" value="{{ $model }}" />
  <button type="submit" class="btn btn-outline-secondary">
    <i class="c_icon fas fa-file-csv menu-icon"></i> @lang('common.export')
  </button>
  <!-- <input type="hidden" id="os_type" name="os_type" value="windows" />
  <div class="btn-group" role="group">
    <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
      <i class="c_icon fas fa-file-csv menu-icon"></i> @lang('common.export')
    </button>
    <div class="dropdown-menu">
      <a class="dropdown-item" onClick="event.preventDefault(); document.getElementById('os_type').value = 'windows';document.getElementById('grid-export-form').submit();"><i class="c_icon fab fa-windows menu-icon"></i> Windows</a>
      <a class="dropdown-item" onClick="event.preventDefault(); document.getElementById('os_type').value = 'mac';document.getElementById('grid-export-form').submit();"><i class="c_icon fab fa-apple menu-icon"></i> Mac</a>
    </div>
  </div> -->
</form>