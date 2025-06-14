@extends('layouts.manage-layout')

@section('content')
<div class="container-wrapper">
  <section class="container">
    <div class="subcontainer login-form">
      @include('components.pages.login-form', [
        'loginUrl' => route('manage.login-post')
      ])
    </div>
  </section>
</div>
@endsection

@section('title')
  @include('layouts.includes.title', ['title' => 'ログイン'])
@endsection