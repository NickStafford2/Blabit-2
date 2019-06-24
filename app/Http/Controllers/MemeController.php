<?php

namespace App\Http\Controllers;

use Auth;
use App\Meme;
use App\User;
use App\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MemeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $memes = Meme::all();
        return view('memes.index', compact('memes'));
        return "all memes here";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('memes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request;
        if (!Auth::check()) {
            return redirect('/login');
        }
        $this->validate($request, ['img'        => 'required',
                                   'title'      => 'required',
        ]);
        
        $path = $request->file('img')->store('public/memes');
        $file = basename($path);
        $meme = new Meme;
        $meme->img          = $file;
        $meme->title        = $request->title;
        $meme->user_id      = Auth::id();
        $meme->description  = $request->description;        // not required
        $meme->save();
        //return $path;
        if (isset($request->chat_id)) {
            //return 'chat_id is set';
            $meme->chats()->attach($request->chat_id);
            /*DB::table('meme_chat')->insert(
                ['chat_id' => $request->chat_id,
                 'meme_id' => $meme->id]
            );*/
        }
        return "success";
        return redirect()->route('memes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\meme  $meme
     * @return \Illuminate\Http\Response
     */
    public function show(Meme $meme)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\meme  $meme
     * @return \Illuminate\Http\Response
     */
    public function edit(Meme $meme)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\meme  $meme
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Meme $meme)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\meme  $meme
     * @return \Illuminate\Http\Response
     */
    public function destroy(Meme $meme)
    {
        //
    }

    public function getUserMemes($user_id) {

        $user = User::findOrFail($user_id);
        //$user = User::where('id', $user_id)->get();
        return $user_id;
    }

    public function getChatMemes(Request $chat_id) {
        //return $chat_id->chat_id;
        //return 'chat memes';
        //$chat = Chat::where('id', $chat_id->chat_id)->first();
        $chat = Chat::findOrFail($chat_id->chat_id);
        return $chat->memes;
        //$user = User::findOrFail($user_id);
        //$user = User::where('id', $user_id)->get();
       // return $user_id;
    }

    public function getMyMemes() {
        if (!Auth::check()) {
            return redirect('/login');
        }        //return 'dfasd';
        //return 'meme1';
        $user = Auth::user();

        //$user = User::where('id', $user_id)->get();
        return $user->memes;
    }

    public function attachChat(Request $request) {
        //return $request;
        $meme = Meme::findOrFail($request->meme_id);
        //                                                          todo, ensure item does not already exist in db
        $meme->chats()->attach($request->chat_id);
        return 'success';
    }

}
