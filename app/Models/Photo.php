<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    /**
     * Renvoie les commentaires asssociés à une photo.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function comments() {
        return $this->hasMany(Comment::class);
    }

    /**
     * Renvoie le groupe associé a une photo.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group() {
        return $this->belongsTo(Group::class);
    }

    /**
     * Renvoie le propriétaire de la photo.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    } 

    /**
     * Renvoie la collection de tag d'une photo.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tags() {
        return $this->belongsToMany(Tag::class)->using(PhotoTag::class)->withPivot("id")->withTimestamps();
    }

    /**
     * Renvoie les utilisateurs associés à la photo.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function users(){
        return $this->belongsToMany(User::class)->using(PhotoUser::class)->withPivot("id")->withTimestamps();
    }


    protected static function booted() {
        // Si on renvoi faux dans cette fonction, la création n'est pas effectuée, sinon elle est effectuée
        static::creating(function ($photo) {
            return !is_null($photo->group->users->find($photo->user_id));
        });
    }

}
 