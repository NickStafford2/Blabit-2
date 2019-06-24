<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;

class UserAvatarController extends Controller
{
    /**
     * Update the avatar for the user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function update(Request $request)
    {
        $userID = Auth::id();
        $user = User::find($userID);
        
        if ($request->user()->id != $userID) {
            return redirect('/login');
        }


        $path = $request->file('avatar')->store('public/avatars'); //this works
        $file = basename($path);
        //$path = Storage::putFile('avatars', $request->file('avatar')); // alternative

        $user->img_link = $file;
        $user->save();
        return redirect('/home');
    }
}