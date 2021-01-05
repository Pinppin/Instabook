<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PhotoUser extends Pivot
{
    use HasFactory;
    public $incrementing = true;

    public function photo() {
      return $this->belongsTo(Photo::class);
  }

    public function user() {
    return $this->belongsTo(User::class);
  }




    protected static function booted() {
         //Si on renvoi faux dans cette fonction, la création n'est pas effectuée, sinon elle est effectuée
      static::creating(function ($photo_user) {
          return !is_null($photo_user->photo->group->users->find($photo_user->user));
      });
  }
}
