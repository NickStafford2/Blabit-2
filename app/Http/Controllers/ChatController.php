<?php

namespace App\Http\Controllers;

use App\Chat;
use App\Blab;
use Illuminate\Http\Request;
use DB;
use Auth;

class ChatController extends Controller
{
    /** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $chats = Chat::with('user')->get();
        //return $chats;
        return view('chats.index', compact('chats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        return view('chats.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // authenticate input
        $this->validate($request, ['title'       => 'required',
                                   'description' => 'required',
        ]);
        if (!Auth::check()) {
            return redirect('/login');
        }

        $chat = new Chat;
        $chat->user_id = Auth::id();
        $chat->title = $request->input('title');
        $chat->description = $request->input('description');
        $chat->save();
        echo $chat;
        return redirect()->route('chats.show', ['id' => $chat->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function show(Chat $chat)
    {
        if ($chat->id == 1) {
            $blabs = DB::table('blabs')->orderBy('created_at')->get();
        }
        else {
            $blabs = DB::table('blabs')->where('chat_id', $chat->id)->orderBy('created_at')->get();
        }
        $messages=$blabs->pluck('message');
        $allwords = array();
        foreach ($messages as $message) {
            $allwords = array_merge($allwords, explode(' ', $message));
        }
        $wordCount = array_count_values($allwords);
        arsort($wordCount);
        $topWords=array_slice($wordCount, 0, 10);
        
        $users = $blabs->pluck('user_id')->toArray();
        $userCount = array_count_values($users);
        arsort($userCount);
        $topUsers = array_slice($userCount, 0, 10);
        return view('chats.show', compact('chat', 'blabs', 'topWords', 'topUsers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function edit(Chat $chat)
    {
        if (Auth::id() != $chat->user_id) {
            return 'Error, this chat does not belong to you';
        }
        // perform user autherization
        //return $chat;
        //return 'chats.edit';
        return view('chats.edit', compact('chat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chat $chat)
    {
        // authenticate input
        $this->validate($request, ['title'       => 'required',
                                   'description' => 'required',
        ]);
        if (!Auth::check()) {
            return redirect('/login');
        }
        if (Auth::id() != $chat->user_id) {
            return 'Error, this chat does not belong to you';
        }

        //return $request;
        $chat->title        = $request->title;
        $chat->description  = $request->description;
        $chat->is_live      = $request->is_live;
        $chat->save();
        return redirect()->route('chats.show', ['id' => $chat->id]);

        //return view('chats.show', compact('chat'));
        //return redirect('chats/show');
        //return redirect('chats.show', compact('chat'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chat $chat)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        if (Auth::id() != $chat->user_id) {
            return redirect('/login');
        }
        $chat->delete();
        return redirect('/home');
    }

}
