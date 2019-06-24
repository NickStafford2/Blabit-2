<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meme extends Model
{
    public function chats() {
    	//return $this->hasManyThrough(Meme::class, );
    	return $this->belongsToMany(Chat::class);
    }
}
