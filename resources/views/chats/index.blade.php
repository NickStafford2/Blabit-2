@extends('layouts.app')

@section('title','All Chats')
@section('content')

<h1>All Chats</h1>

    @if(count($chats) > 0)
    <div class="list-group"> 
        @foreach($chats as $chat)
            @include('chats.chat-summary')
        @endforeach
        </div>
    @else
    <h3>There are No Chats</h3>
    @endif
    <hr>
    <div >
        <a href="chats/create"class="btn btn-primary">Create New Chat</a>
    </div>
@endsection