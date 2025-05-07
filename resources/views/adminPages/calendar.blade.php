@extends('layouts.tenant_admin_layout') 

@section('title', 'Calendar')
@section('page-title', 'Calendar')

@section('Admin_layout_content')
<div class="card">
  <div class="card-body">
    <div id="calendar" style="height: 600px;"></div> 
  </div>
</div>
@endsection

@push('styles')
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css' rel='stylesheet' />
@endpush

@push('scripts')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                height: 'auto'
            });

            calendar.render();
        });
    </script>
@endpush
