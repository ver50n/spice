<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('title')
    @include('layouts.includes.manage.asset')
    @include('layouts.includes.manage.header')
  </head>

  <body>
    <div id="app" class="global-wrapper">
      @include('layouts.includes.manage.navbar')
      <div class="overlay"></div>
      <div class="container-fluid">
        @if(session('notify'))
        <div class="alert alert-warning">
          <button type="button" class="close" onclick="$('.alert').hide()">
            <span aria-hidden="true">&times;</span>
          </button>
          <b>
          @foreach(session('notify')['list'] as $notify)
            @if(!$loop->first)
              <br />
            @endif
            {!! $notify !!}
          @endforeach
          </b>
        </div>
        @endif

        @if(session('success'))
        <div class="alert alert-success">
          <strong>@lang('common.success') : </strong>{{session('success')}}
          <button type="button" class="close" onclick="$('.alert').hide()">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger">
          <strong>@lang('common.error') : </strong>{{session('error')}}
          <button type="button" class="close" onclick="$('.alert').hide()">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif
        @yield('content')
        @include('layouts.includes.manage.footer')
      </div>
    </div>
  </body>
  @yield('modal')
  
</html>