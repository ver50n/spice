@extends('layouts.manage-layout')

@section('content')

<div class="container-wrapper">
  <section class="container">
    <div class="subcontainer dashboard">
      <div class="jumbotron">
        <h4>@lang('common.attention'):</h4>
        <ul style="color: red">
        </ul>
      </div>
    </div>
    <div class="subcontainer event-calendar">
      <h4>@lang('common.event'):</h4>
      <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/locales-all.min.js"></script>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css"></link>

      <script>
        document.addEventListener('DOMContentLoaded', function() {
          var calendarEl = document.getElementById('calendar');
          var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            dayMaxEvents: 3,
            locale: '{{ \Session::get('locale') }}',
            contentHeight:"auto",
            eventTimeFormat: { 
              hour: '2-digit',
              minute: '2-digit',
              hour12: false
            },
            eventClick: function (info) {
              window.location.href = "/manage/event/"+info.event.extendedProps.eventId+"/view";
            },
            events: '{{ route('helpers.load-event') }}',
          });
          calendar.render();
          $('.change-view').click(function() {
            view = $(this).attr("data");
            calendar.changeView(view);
          });
        });
      </script>

      <div class="btn-group" role="group" aria-label="Basic example">
        <button type="button" class="btn btn-secondary change-view" data="dayGridMonth"><i class="fas fa-calendar-alt"></i> @lang('common.calendar')</button>
        <button type="button" class="btn btn-secondary change-view" data="listMonth"><i class="fas fa-list"></i> @lang('common.list')</button>
      </div>
      <div id='calendar'></div>
    </div>

  </section>
</div>
@endsection

@section('title')
  @include('layouts.includes.title', ['title' => \Lang::get('common.dashboard')])
@endsection