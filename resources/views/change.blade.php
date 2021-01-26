@extends('layouts.app')

@section('content')
<div class="panel-body">
  <!-- Отображение ошибок проверки ввода -->
  @include('common.errors')
  <form action="{{ url('update/'.$event->id) }}" method="POST" class="form-horizontal">
     {{ csrf_field() }}

    <div class="container">
      <label for="event">Заголовок</label>
      <input type="text" name="title" id="event-title" class="form-control" value="{{$event->title}}">
      <label for="event">Тема</label>
      <div >
      <select class="form-select" name="theme" id="event-theme">
      @foreach ($themes as $theme)
      @if ($theme->themename == $event->theme)
        <option selected value="{{$theme->themename}}">{{$theme->themename}}</option>
      @else
        <option value="{{$theme->themename}}">{{$theme->themename}}</option>
      @endif
      @endforeach
    </select>
    </div>
      <br>
      <input type="text" name="message" id="event-message" class="form-control" placeholder="Введите текст сообщения..." value="{{$event->message}}">
      <button type="submit" class="btn btn-secondary" id="buttonForCreate">
        <i class="fa fa-plus"></i> Изменить
      </button>
    </div>
  </form>
</div>
@endsection
