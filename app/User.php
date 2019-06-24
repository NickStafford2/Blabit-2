<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Chat;
use App\Meme;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function chats() {
        return $this->hasMany(Chat::class);
    }

    public function subs() {
        return $this->belongsToMany(User::class, 'subscription', 'subscriber_user_id', 'subscribee_user_id');
    }
    /*
    public function subscribers() {
        return $this->hasMany(Users::class, 'subscriber_user_id');
    }
    */

    public function subscribeTo(User $user)
    {
        $this->subs()->attach($user->id);
    }

    public function unsubscribeFrom(User $user)
    {
        $this->subs()->detach($user->id);
    }

    public function getIdAttribute($value) {
        return $value;
    }

    public function getAtTag($value) {
        return '@' . $this->id;
    }

    public function blabs() {
        return $this->hasMany(Blab::class);
    }

    public function memes() {
        return $this->hasMany(Meme::class);
    }

}
