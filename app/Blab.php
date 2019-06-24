<?php

namespace App;

use Illuminate\Database\Eloquent\Model;



class Blab extends Model
{
    //Blabs are short little messages of at most 200 characters. these are throwaway comments in live streams
    //public $timestamps = false;
    protected $dates = [
    					'created_at',
    					'updated_at'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function chat() {
        return $this->belongsTo(Chat::class);
    }

}
