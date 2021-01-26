@extends('layouts.app')

@section('content')
<div class="panel-body">
  <!-- Отображение ошибок проверки ввода -->
  @include('common.errors')
  <form action="{{ url('add_theme') }}" method="POST" class="form-horizontal">
    {{ csrf_field() }}
    <div class="container">
      <h2>Создание темы</h2>
        <textarea  name="theme" id="event-message" class="form-control" placeholder="Введите название темы" value="{{ old('theme') }}">
        </textarea>
        <button type="submit" class="btn btn-secondary" id="buttonForCreate">
          <i class="fa fa-plus"></i> Создать
        </button>

    </div>
  </form>


</div>
@endsection
