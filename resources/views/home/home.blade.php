@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card ">
                <div class="card-header">
                    <h1>{{$user->name}}</h1>
                    <small>{{'@'.$user->id}}</small>
                </div> 
                <div class="card-body">
                    <a class="btn btn-primary" href="{{route('chats.create')}}">Create Chat</a>
                    <a class="btn btn-primary" href="{{route('users.edit', $user->id)}}">Edit Account</a>
                    <a class="btn btn-danger" href="{{route('users.destroy', $user->id)}}">Delete Account</a>
                </div>
            </div>
            @if (count($liveChats))
                <div class="card my-3">
                    <div class="card-header">
                        <h1>Live Chats</h1>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">

                            @foreach ($liveChats as $chat)
                                <li class="list-group-item">
                                    <div class="float-right text-right">
                                        <a class="btn btn-light" role="button" href="{{route('chats.edit',['chat' => $chat->id])}}" ><strong>...</strong></a>
                                        <strong class="text-danger d-block my-3">LIVE</strong >
                                    </div>
                                    <a class="list-group-item-action" href="chats/{{$chat->id}}">
                                        <div>
                                            <h3>{{$chat->title}}</h3>
                                            <p class="">{{$chat->num_viewers}} watching</p>
                                            <small>By: {{$chat->user->name}}</small>
                                            <small>{{$chat->created_at}}</small>
                                        </div>
                                    </a>                
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
                            
            @if (count($deadChats))
                <div class="card my-3">
                    <div class="card-header">
                        <h1>Chat History</h1>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($deadChats as $chat)
                                <li class="list-group-item">
                                    <div class="float-right text-right">
                                        <a class="btn btn-light" role="button" href="{{route('chats.edit',['chat' => $chat->id])}}" ><strong>...</strong></a>
                                        <strong class="text-danger d-block my-3">LIVE</strong >
                                    </div>
                                    <a class="list-group-item-action" href="chats/{{$chat->id}}">
                                        <div>
                                            <h3>{{$chat->title}}</h3>
                                            <p class="">{{$chat->num_viewers}} watching</p>
                                            <small>By: {{$chat->user->name}}</small>
                                            <small>{{$chat->created_at}}</small>
                                        </div>
                                    </a>                
                                </li>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
        <div class=col-md-6>
            <div class="card">
                <div class="card-header">
                    <h1>Subscriptions</h1>
                </div>
                <div class="card-body">
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3" id="app">
        <h1>your recent posts</h1>
    </div>
</div>

@endsection
