<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function blabs() {
    	return $this->hasMany(Blab::class);
    }
    public function memes() {
    	//return $this->hasManyThrough(Meme::class, );
    	return $this->belongsToMany(Meme::class);
    }

}
