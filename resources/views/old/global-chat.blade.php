@extends('layouts.app')

@section('content')
<div class="bg-dark"> 

        <div class="chat-heading">
            <h1 class="text-light">Global Chat</h1>
            <p class="text-light">chat description</p>
        </div>
        
        <div class="chat-history">
            <ul>
                <li class="shouts">Lorem ipsum f amet, consectetur</li>
                <li class="shouts">Lorem fdset, consectetur</li>
                <li class="shouts">sum dolor sit amet, consectdetur</li>
                <li class="shouts">Lorem ipsufasfdm dolor sit amet, consectetur</li>
                <li class="shouts">Lorem ipsum dolor sit dsafmet, consectetur</li>
                <li class="shouts">Lorem ipsum dolor sit amet, consectdetur</li>
                <li class="shouts">Lordfm dolor sit amet, consectetur</li>
                <li class="shouts">Lorem ipsum dolor sit amet, consectetur</li>
                <li class="shouts">Lorfd dolor sit amet, consectetur</li>
            </ul>
        </div>
        <div class="chat-user-message">
            <div class="divider-line"></div>
            <div>
                <div id="user-message" class="chat-draft-text" name="user-message" contenteditable=""></div>	
            </div>
            <div class="chat-user-message-options">
                <p>Message Options</p>
            </div>
        </div>
    </div>
@endsection
