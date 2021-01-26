<?php

  use App\Task;
  use App\Event;
  use App\Theme;
  use App\Blog;
  use App\User;
  use App\Vote;
  use Illuminate\Http\Request;
  use  App\Http\Controllers\Controller;

  /**
   * Вывести панель с задачами
   */
   Route::get('/admin', function(){
     $users = User::orderBy('created_at', 'asc')->get();
     return view('admin', [
       'users' => $users
     ]);
   });
   Route::get('/themes', function() {
     $themes = Theme::orderBy('created_at', 'asc')->get();
     return view('themes', [
       'themes'=>$themes
     ]);
   });
   Route::post('/sort', function (Request $request){
     if ($request->theme == 'all') {
       return redirect('/');
     } else {
       $themeSort = $request->theme;
       $themes = Theme::orderBy('created_at', 'asc')->get();
       $events = DB::table('events')->where('theme',$themeSort)->orderBy('created_at', 'asc')->get();
       return view('events', [
         'events'=> $events,
         'themes' => $themes
       ]);
     }
   });
   Route::get('/', function () {
     $events = Event::orderBy('created_at', 'asc')->get();
     $themes = Theme::orderBy('created_at', 'asc')->get();

  return view('events', [
    'events' => $events,
    'themes' => $themes
  ]);
   });

   Route::get('/blogs', function () {
     $blogs = Blog::orderBy('created_at', 'asc')->get();
     return view('blogs', [
       'blogs' => $blogs
     ]);
   });

   Route::get('/blogs_create', function() {
     return view('blogs_create');
   });
   Route::get('theme_create', function() {
     return view('theme_create');
   });

  Route::get('/t', function () {
    $tasks = Task::orderBy('created_at', 'asc')->get();

 return view('tasks', [
   'tasks' => $tasks
 ]);
  });

  /**
   * Добавить новую задачу
   */
  Route::post('/task', function (Request $request) {
    $validator = Validator::make($request->all(), [
   'name' => 'required|max:255',
 ]);

 if ($validator->fails()) {
   return redirect('/')
     ->withInput()
     ->withErrors($validator);
 }

    $task = new Task;
    $task->name = $request->name;
    $task->save();

  return redirect('/');
  });
  Route::post('/event', function (Request $request) {
    return redirect('create');
  });
  Route::post('/add_theme', function (Request $request){
    $validator = Validator::make($request->all(), [
   'theme' => 'required',

]);
if ($validator->fails()) {
  return redirect('/theme_create')
    ->withInput()
    ->withErrors($validator);
}
  $theme = new Theme;
  $theme->themename = $request->theme;
  $theme->save();
  return redirect('/themes');
});


  Route::post('/add_blog', function (Request $request){
    $validator = Validator::make($request->all(), [
   'message' => 'required',
 ]);
 if ($validator->fails()) {
   return redirect('/blogs_create')
     ->withInput()
     ->withErrors($validator);
 }

 $blog = new Blog;
  $blog->message = $request->message;
  $blog->userid = Auth::user()->id;
  $user = User::findOrFail(Auth::user()->id);
  $blog->save();
  $id = DB::table('blogs')->max('id');
  $blog = Blog::find($id);
  $user->blogs()->attach($blog);

return redirect('/blogs');
});
  Route::post('/add', function (Request $request) {
    $validator = Validator::make($request->all(), [
   'title' => 'required|max:32',
   'theme' => 'required|max:64',
   'message' => 'required',
 ]);

 if ($validator->fails()) {
   return redirect('/create')
     ->withInput()
     ->withErrors($validator);
 }

    $event = new Event;
    $id = DB::table('events')->max('id');
    $event->title = $request->title;
    $event->theme = $request->theme;
    $event->message = $request->message;
    $event->save();
    $user = User::findOrFail(Auth::user()->id);
    $id = DB::table('events')->max('id');
    $event = Event::findOrFail($id);
    $user->events()->attach($event);

  return redirect('/');
  });
  Route::get('/create', function () {
    $themes = Theme::orderBy('created_at', 'asc')->get();
    return view('create', [
      'themes' => $themes
    ]);
  });
  Route::get('/watch/{id}', 'Controller@show');
  Route::get('/like/{blog}', function (Blog $blog){
      $blog_id = $blog->id;
      $user_id = Auth::user()->id;
      $blog = Blog::findOrFail($blog_id);
      $result = DB::table('votes')->where('blog_id', $blog->id)->where('user_id',$user_id)->count();
      if ($result>0) {
        $blog->likes = $blog->likes - 1;
        DB::table('votes')->where('blog_id', $blog->id)->where('user_id', $user_id)->delete();
        $blog->save();
      } else {
        $like = new Vote;
        $blog->likes = $blog->likes + 1;
        $like->blog_id = $blog->id;
        $like->user_id = $user_id;
        $like->save();
        $blog->save();
    }




    return redirect('/blogs');
  });


  Route::get('/change/{id}', 'Controller@change');
  Route::post('/update/{id}', 'Controller@edit');
  Route::post('/change_user/{id}', 'Controller@change_user');
  Route::post('/update_user/{id}', 'Controller@update_user');
  /**
   * Удалить задачу
   */
  Route::delete('/event/{event}', function (Event $event) {

    DB::table('event_user')->where('event_id',$event->id)->delete();
    $event->delete();
    return redirect('/');
  });

Route::delete('/delete_theme/{theme}', function (Theme $theme){
  $theme->delete();
  return redirect('/themes');
});
Route::delete('/delete_blog/{blog}', function (Blog $blog){
  DB::table('blog_user')->where('blog_id',$blog->id)->delete();
  DB::table('votes')->where('blog_id',$blog->id)->delete();
  $blog->delete();
  return redirect('/blogs');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
