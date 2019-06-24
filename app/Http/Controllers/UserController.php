<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Chat;
use App\User;
use Auth;
use DB;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('users/index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $user = User::where('id', $user->id)->get();
        $user = $user[0];
        $subscribers = DB::table('subscription')
                            ->where('subscribee_user_id', $user->id)
                            //->pluck('subscriber_user_id')
                            ->join('users', 'users.id', '=', 'subscriber_user_id')
                            ->select('id',
                                    'name',
                                    'img_link')
                            ->get();

        $subscribees = DB::table('subscription')
                            ->where('subscriber_user_id', $user->id)
                            ->join('users', 'users.id', '=', 'subscribee_user_id')
                            ->select('id',
                                    'name',
                                    'img_link')
                            ->get();
                            
        //return $user;
        $mySubscriptions;
        //$amISubscribed = 0;
        if (Auth::check()) {
            //return 'xxx';
            //$mySubscriptions = User::where('id', Auth::id())->with('subs')->select('id')->get();
            $mySubscriptionsObject = DB::table('subscription')
                                        ->where('subscribee_user_id', Auth::id())
                                        ->select('subscriber_user_id as id')
                                        ->get();

            $mySubscriptionsObject->toArray();
            $mySubscriptions = array();
            foreach ($mySubscriptionsObject as $subscribee) {
                array_push($mySubscriptions, $subscribee->id);
            }
            //$amISubscribed = $subscribers->contains(Auth::id());
            //$amISubscribed = in_array(Auth::id(), $subscribers);
        }
        //return $amISubscribed;
        //return $subscribers;
        return view('users/show',compact('user', 'subscribers','mySubscriptions', 'subscribees'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

        if (!Auth::check()) {
            return redirect('/login');
        }
        if (Auth::id() != $user->id) {
            return redirect('/login');
        }    
        return view('users/edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // authenticate input
        $this->validate($request, ['name'        => 'required',
                                   'email'       => 'required',
                                   'description' => 'required',
        ]);
        if (!Auth::check()) {
            return redirect('/login');
        }
        if (Auth::id() != $user->id) {
            return 'Error. Can not edit a user who is not you';
        }
        //return $request;
        $user->name         = $request->name;
        $user->email        = $request->email;
        $user->description  = $request->description;
        $user->save();

        return view('users.show', compact('user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        if (Auth::id() != $user->id) {
            return 'Error. Can not edit a user who is not you';
        }
        
        $chats = $user->chats;
        /*
        foreach ($chats as $chat) {
            $chat->delete();
        }
        */
        $user->delete();
        return redirect('/home');
    }
    public function subscribeTo($user) {

    }
    public function unsubscribeFrom($user) {

    }    
}
