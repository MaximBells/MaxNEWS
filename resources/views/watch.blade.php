@extends('layouts.app')

@section('content')
<div class="panel-body">
  <!-- Отображение ошибок проверки ввода -->
  @include('common.errors')
</div>
<h1>{{$event->title}}</h1>
<h2>{{$event->theme}}</h2>
<h3 class="eventAuthor">Автор: {{$event->users->pluck('name')->implode(', ')}}</h3>
<div class="forMessage">
<p><b>{{$event->message}}</b></p>
</div>
 <div class="btn-toolbar" role="toolbar" aria-label="First group">
   <div class="btn-group mr-2" role="group" aria-label="First group">
     @if (!Auth::guest())
@if (Auth::user()->id == $event->users->pluck('id')->implode(', ') || Auth::user()->usertype == 'admin')
<form action="{{ url('change/'.$event->id) }}" method="GET">
  {{ csrf_field() }}
  <button type="submit" class="btn btn-secondary  d-block mr-auto" id="buttonChange">
    <i class="fa fa-trash"></i> Изменить
  </button>
</form>
</div>
<div class="btn-group mr-2" role="group" aria-label="Second group">
<form action="{{ url('event/'.$event->id) }}" method="POST">
  {{ csrf_field() }}
  {{ method_field('DELETE') }}
  <button type="submit" class="btn btn-danger  d-block mr-auto">
    <i class="fa fa-trash"></i> Удалить
  </button>
</form>
@endif
@endif
</div>
</div>
@endsection
