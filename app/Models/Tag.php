<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    /**
     * Renvoie les photos associées a un tag.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function photos(){
        return $this->belongsToMany(Photo::class)->using(PhotoTag::class)->withPivot("id")->withTimestamps();
    }

}
