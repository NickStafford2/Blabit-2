@extends('layouts.app')

@section('content')

<div class="container-fluid blabit-light-bg my-2">
    <div class="float-right text-right">
        @if ($chat->is_live)
            <h4><strong class="text-danger">LIVE</strong ></h4>
            <p>{{$chat->num_viewers}} watching</p>
        @endif
    </div>
    <h1>{{$chat->title}}</h1>

    <p class="mb-0">{{$chat->description}}</p>
    <a href="/users/{{$chat->user_id}}">
        <small>{{'@'.$chat->user_id}}</small>
    </a>
</div>

<blab-container 
    :chat_id={{$chat->id}} 
    :num_viewers={{$chat->num_viewers}}
>
</blab-container>
    <div class="container-fluid blabit-light-bg ml-0 pb-3 mt-3">
        <h1>Chat Rules</h1>
        <div class="bg-light">
            <h5>Most Common Words</h5>
            <ul>
                @foreach($topWords as $word => $count)
                <li>
                    <span class="badge badge-secondary">{{$count}}</span>
                    <strong>{{$word}} </strong>
                </li>
                @endforeach
            </ul>
            <h5>Most Common Users</h5>
            <ul>
                @foreach($topUsers as $user => $count)
                <li>
                    <span class="badge badge-secondary">{{$count}}</span>
                    <a href="/users/{{$user}}">
                        <strong>{{'@'.$user}}</strong>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection