@extends('layouts.app')

@section('content')
<div class="panel-body">
  <!-- Отображение ошибок проверки ввода -->
  @include('common.errors')
  <form action="{{ url('update_user/'.$user->id) }}" method="POST" class="form-horizontal">
     {{ csrf_field() }}

    <div class="container">
      <label for="event">Имя пользователя</label>
      <input type="text" name="name" id="event-title" class="form-control" value="{{$user->name}}">
      <label for="event">Почта пользователя</label>
      <input type="text" name="email" id="event-title" class="form-control" value="{{$user->email}}">
      <label for="event">Тип пользователя</label>
      <div >
      <select class="form-select" name="usertype" id="event-message">

      @if ($user->usertype == 'admin')
      <option selected value="admin">Администратор</option>
      @else
      <option value="admin">Администратор</option>
      @endif

      @if ($user->usertype == 'redactor')
      <option selected value="redactor">Редактор</option>
      @else
      <option  value="redactor">Редактор</option>
      @endif

      @if ($user->usertype == 'user')
      <option selected value="user">Пользователь</option>
      @else
      <option value="user">Пользователь</option>
      @endif

    </select>
    </div>


      <button type="submit" class="btn btn-secondary" id="buttonForCreate">
        <i class="fa fa-plus"></i> Изменить
      </button>
    </div>
  </form>
</div>
@endsection
