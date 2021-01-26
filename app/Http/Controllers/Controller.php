<?php

namespace App\Http\Controllers;
use App\Event;
use App\Theme;
use App\Title;
use App\Blog;
use App\Vote;
use App\User;
use App\Http\Controllers;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function show($id)
    {
      return view('watch', ['event' => Event::findOrFail($id)]);
    }
    public function change($id)
    {
      $themes = Theme::orderBy('created_at', 'asc')->get();
      return view('change', ['event' => Event::findOrFail($id),
                              'themes' => $themes]);
    }
    public function edit(Request $request, $id)
    {
    $event = Event::findOrFail($id);
    $event->title = $request->title;
    $event->theme = $request->theme;
    $event->message = $request->message;
    $event->save();
    return redirect('/');
    }
    public function change_user($id){
      return view('change_user', ['user' => User::findOrFail($id)]);
    }
    public function update_user(Request $request, $id)
    {
      $user = User::findOrFail($id);
      $user->name = $request->name;
      $user->email = $request->email;
      $user->usertype = $request->usertype;
      $user->save();
      return redirect('/admin');
    }

}
