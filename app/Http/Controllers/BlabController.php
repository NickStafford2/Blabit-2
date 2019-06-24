<?php

namespace App\Http\Controllers;

use Auth;
use App\Blab;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BlabController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $chat)
    {
        $blabs;
        
        if ($chat->id == 1) {
            $blabs = Blab::orderBy('created_at', 'desc')
                        ->limit(200)
                        ->get();
                        //->reverse();
        }
        else {
            $blabs = Blab::where('chat_id', '=' , $chat->id)
                        ->orderBy('created_at', 'desc')
                        ->limit(200)
                        ->get(); 
        }
                             
                                                                            // Todo, validate that user can access 
                                                                            // todo change date to something readable by humans. do this in backend with carbon: see blabs show.blade.php
        //return array_reverse($blabs);                                     // todo, learn how to reverse this on the backend instead of reversing it in javascript
        //return Blab::all()->orderBy('created_at')->get();
        //$blabs = $blabs->sortBy('created_at');
        return $blabs;
        //return view('blabs.index');
    }
    public function requestUpdate(Request $info) {
        //return $info->mostRecentPost;
        // returns any blabs that were submitted more recently than the mostRecentBlab variable in the $info object
        $newBlabs;
        
        if ($info->chat_id == 1) {
            //return 'ddkf';
            $newBlabs = Blab::where('created_at', '>', $info->mostRecentPost)//$info->mostRecentBlab)
                        ->get(); 
        }
        else {
            //return 'else reached';
            $newBlabs = Blab::where('chat_id', '=', $info->chat_id)
                        //->where('chat_id', '=', $info->chat_id)
                        ->where('created_at', '>', $info->mostRecentPost)
                        ->get(); 
        }
       /* $newBlabs = Blab::where('chat_id', '=', $info->chat_id)
                        //->where('chat_id', '=', $info->chat_id)
                        ->whereDate('created_at', '>', $info->mostRecentBlab)
                        ->get();
*/
        return $newBlabs;
        return 'request update called and returned';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // authenticate imput and make guest

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        $this->validate($request, ['message' => 'required|max:200|min:1']);            // TODO, set min to 1
        // must validate that the chat_id is not private                                     <--------TODO
        $blab = new Blab;
        $blab->created_at = Carbon::now();
        $blab->user_id    = Auth::id();
        $blab->chat_id    = $request->chat_id;
        $blab->message    = $request->message;
        $blab->save();
        return $request->message;
        return 'blab stored successfully';
        return back();
        return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Blab  $blab
     * @return \Illuminate\Http\Response
     */
    public function show(Blab $blab)
    {
        return view('blabs.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blab  $blab
     * @return \Illuminate\Http\Response
     */
    public function edit(Blab $blab)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blab  $blab
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blab $blab)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blab  $blab
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blab $blab)
    {
        //
    }
}
