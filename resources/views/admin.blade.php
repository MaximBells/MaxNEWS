@extends('layouts.app')

@section('content')

<table class="table table-hover task-table">
<thead class="thead-inverse">
  <th>Имя пользователя</th>
  <th>Почта</th>
  <th>Тип пользователя</th>
  <th>&nbsp;</th>

</thead>
 <tbody>
  @foreach ($users as $user)
   <tr>

     <!-- Имя задачи -->
     <td class="table-text">
       <div>{{ $user->name }}</div>
     </td>
     <td class="table-text">
       <div>{{ $user->email }}</div>
     </td>
     <td class="table-text">
       @if ($user->usertype == 'admin')
       <div>Администратор</div>
       @elseif ($user->usertype == 'redactor')
       <div>Редактор</div>
       @else
       <div>Пользователь</div>
       @endif
     </td>

     <td>
       <!-- TODO: Кнопка Смотреть -->
       <form action="{{ url('change_user/'.$user->id) }}" method="POST">
         {{ csrf_field() }}
         <button type="submit" class="btn btn-primary">
           <i class="fa fa-trash"></i> Изменить
         </button>

       </form>
     </td>



   </tr>
  @endforeach
 </tbody>
  </table>
@endsection
