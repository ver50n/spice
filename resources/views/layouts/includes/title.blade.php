@php
  $default = config('app.name');
  $title = isset($title) ? $title : $default;
  $title .= ' - '.Lang::get('common.brand-desc');
@endphp
<title>{{ $title }}</title>