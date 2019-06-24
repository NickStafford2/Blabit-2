<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Chat;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //echo "index called";
        $user = Auth::user();
        //$user = User::where('id', $user->id)->with('chats')->get();
        //$user = $user[0];
        $liveChats = Chat::where('user_id', $user->id)
                        ->where('is_live', 1)
                        ->get();
        $deadChats = Chat::where('user_id', $user->id)
                        ->where('is_live', 0)
                        ->get();
        $data = array('user'      => $user,
                      'liveChats' => $liveChats,
                      'deadChats' => $deadChats);
        return view('home.home')->with($data);
    }

    public function root() {
        //echo 'testing';
        //$user = Auth::user();
        //echo $user;
        return view('home.root'); 
    }
    public function terms() {
        return view('home.termsOfService');
    }
}
