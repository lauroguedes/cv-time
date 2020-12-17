<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;

trait InjectAuthUser {
  protected static function booted()
  {
    $user = auth()->user();
    if($user) {
      static::creating(function (Model $model) use ($user) {
          $model->user_id = $user->id;
      });
    }
  }
}