<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Blog extends Model
{

  public function users()  {
    return $this->belongsToMany('App\User');
  }
}
