@extends('layouts.app')

@section('content')
<div class="panel-body">
  <!-- Отображение ошибок проверки ввода -->
  @if (!Auth::guest())
  @include('common.errors')
  <form action="{{ url('blogs_create') }}" method="GET" class="form-horizontal">
    {{ csrf_field() }}
    <!-- Кнопка добавления задачи -->
    <div class="form-group">

        <button type="submit" class="btn btn-success pull-right" id="addNew">
          <i class="fa fa-plus"></i> Добавить блог
        </button>

    </div>
  </form>
@endif

  @foreach ($blogs as $blog)
  <div class="twit">
    <p class="author">
      <img src="https://i08.fotocdn.net/s121/21e9e7c76c556e45/user_l/2772715174.jpg" alt="Профиль" class="image">
      {{$blog->users->where('id',$blog->userid)->first()->name}}
    </p>
    <div class="message">
      {{$blog->message}}
    </div>
  </div>
  @if (!Auth::guest())



  <form action="{{ url('like/'.$blog->id) }}" method="GET" class="form-horizontal">
    {{ csrf_field() }}
  @if (DB::table('votes')->where('blog_id',$blog->id)->where('user_id',Auth::user()->id)->value('user_id') == Auth::user()->id)
  <button type="submit" class="btn btn-danger" id="icon" >
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 2.748l-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"></path>
                </svg>
                {{$blog->likes}}
  </button>
@else
<button type="submit" class="btn btn-outline-danger" id="icon" >
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M8 2.748l-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"></path>
              </svg>
              {{$blog->likes}}
</button>
@endif
</form>

@if (Auth::user()->usertype == 'admin' || Auth::user()->id == $blog->userid)
<form action="{{ url('delete_blog/'.$blog->id) }}" method="POST">
  {{ csrf_field() }}
  {{ method_field('DELETE') }}
  <button type="submit" class="btn btn-outline-danger  d-block mr-auto" id="icon">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
      </svg>
  </button>
</form>
@endif



  @endif
  @endforeach



<div class="emptySpace">
  ©MaxNEWS
</div>


</div>
@endsection
