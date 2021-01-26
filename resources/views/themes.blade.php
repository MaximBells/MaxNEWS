@extends('layouts.app')

@section('content')
<form action="{{ url('theme_create') }}" method="GET" class="form-horizontal">
  {{ csrf_field() }}
  <!-- Кнопка добавления задачи -->
  <div class="form-group">

      <button type="submit" class="btn btn-success pull-right" id="addNew">
        <i class="fa fa-plus"></i> Добавить тему
      </button>

  </div>
</form>
<table class="table table-hover task-table">
<thead class="thead-inverse">
  <th>Тема</th>
  <th>&nbsp;</th>
</thead>
 <tbody>
  @foreach ($themes as $theme)
   <tr>

     <!-- Имя задачи -->
     <td class="table-text">
       <div>{{ $theme->themename }}</div>
     </td>
     <td>
       <!-- TODO: Кнопка Смотреть -->
       <form action="{{ url('delete_theme/'.$theme->id) }}" method="POST">
         {{ csrf_field() }}
         {{ method_field('DELETE') }}
         <button type="submit" class="btn btn-danger">
           <i class="fa fa-trash"></i> Удалить
         </button>

       </form>
     </td>

   </tr>
  @endforeach
 </tbody>
  </table>
  <div class="emptySpace">
    ©MaxNEWS
  </div>
@endsection
