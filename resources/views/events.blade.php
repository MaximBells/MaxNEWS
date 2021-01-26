@extends('layouts.app')

@section('content')

<div class="panel-body" id="bodyForEvent">
  <!-- Отображение ошибок проверки ввода -->
  @include('common.errors')
  @if (!Auth::guest())
  <form action="{{ url('event') }}" method="POST" class="form-horizontal">
    {{ csrf_field() }}
    <!-- Кнопка добавления задачи -->
    <div class="form-group">

        <button type="submit" class="btn btn-success pull-right" id="addNew">
          <i class="fa fa-plus"></i> Добавить новость
        </button>

    </div>
  </form>
@endif

<form action="{{ url('sort') }}" method="post" class="form-horizontal">
{{ csrf_field()}}
<div class="form-group" style="text-align: left;">
  <button type="submit" class="btn btn-outline-success pull-right" id="sort" >
    <i class="fa fa-plus"></i> Показать только
  </button>
  <select class="form-select" aria-label="Default select example" style="color: #28a745; border-color: #28a745; height: 30px; padding-bottom: 5px;" name="theme" id="sort">
  <option selected value="all">Все</option>
  @foreach ($themes as $theme)
  <option value="{{$theme->themename}}">{{$theme->themename}}</option>
  @endforeach
</select>
</form>
</div>


<table class="table table-hover task-table">
<thead class="thead-inverse">
  <th>Заголовок</th>
  <th>Тема</th>
  <th>&nbsp;</th>
</thead>
 <tbody>
  @foreach ($events as $event)
   <tr>

     <!-- Имя задачи -->
     <td class="table-text">
       <div>{{ $event->title }}</div>
     </td>
     <td class="table-text">
       <div> {{$event->theme}} </div>
     </td>
     <td>
       <!-- TODO: Кнопка Смотреть -->
       <form action="{{ url('watch/'.$event->id) }}" method="GET">
         {{ csrf_field() }}

         <button type="submit" class="btn btn-primary">
           <i class="fa fa-trash"></i> Посмотреть полностью
         </button>

       </form>
     </td>

   </tr>
  @endforeach
 </tbody>
  </table>
</div>
<div class="emptySpace">
  ©MaxNEWS
</div>
@endsection
