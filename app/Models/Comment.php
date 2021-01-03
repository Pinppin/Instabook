<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    /**
     * On renvoie la photo associé à un commentaire.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function photo() {
        return $this->belongsTo(Photo::class);
    }


    /**
     * on renvoie l'utilisateur qui est associé à un commentaire.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * On renvoie le commentaire de réponse à un commentaire.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function replyTo(){
        return $this->belongsTo(Comment::class,'comment_id','id');
    }

    /**
     * On renvoie qu'un commentaire peut avoir plusieur réponses.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies(){
        return $this->hasMany(Comment::class);
    }


    protected static function booted() {
        // Si on renvoi faux dans cette fonction, la création n'est pas effectuée, sinon elle est effectuée
        static::creating(function ($comment) {
            return !is_null($comment->photo->group->users->find($comment->user_id));
        });
    }


}
