@extends('layouts.app')

@section('content')
<div class="panel-body">
  <!-- Отображение ошибок проверки ввода -->
  @include('common.errors')
  <form action="{{ url('add') }}" method="POST" class="form-horizontal">
     {{ csrf_field() }}
    <div class="container">
      <label for="event">Заголовок</label>
      <input type="text" name="title" id="event-title" class="form-control" value="{{ old('title') }}" >
      <label for="event">Тема</label>
      <div >
      <select class="form-select" name="theme" id="event-theme">
      @foreach ($themes as $theme)
      <option value="{{$theme->themename}}">{{$theme->themename}}</option>
      @endforeach
    </select>
    </div>
      <br>
      <textarea name="message" id="event-message" class="form-control" placeholder="Введите текст сообщения..." value="{{ old('message') }}">
      </textarea>
      <button type="submit" class="btn btn-secondary" id="buttonForCreate">
        <i class="fa fa-plus"></i> Добавить
      </button>
    </div>
  </form>
</div>
@endsection
