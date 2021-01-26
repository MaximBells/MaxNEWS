@extends('layouts.app')

@section('content')
<div class="panel-body">
  <!-- Отображение ошибок проверки ввода -->
  @include('common.errors')
  <form action="{{ url('add_blog') }}" method="POST" class="form-horizontal">
    {{ csrf_field() }}
    <div class="container">
        <textarea  name="message" id="event-message" class="form-control" placeholder="Введите текст блога..." value="{{ old('message') }}">
        </textarea>
        <button type="submit" class="btn btn-secondary" id="buttonForCreate">
          <i class="fa fa-plus"></i> Написать
        </button>

    </div>
  </form>


</div>
@endsection
