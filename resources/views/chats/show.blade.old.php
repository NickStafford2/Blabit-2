@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="container-fluid bg-dark mb-3 p-2 px-3">
            <div class="float-right text-right">
                @if ($chat->is_live)
                    <h4><strong class="text-danger">LIVE</strong ></h4>
                    <p class="text-light">{{$chat->num_viewers}} watching</p>
                @endif
            </div>
            <h1 class="text-light">{{$chat->title}}</h1>

            <p class="text-light  mb-0">{{$chat->description}}</p>
            <a href="/users/{{$chat->user_id}}">
                <small>{{'@'.$chat->user_id}}</small>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7 pl-0">
            <div id="app" class="container-fluid bg-dark ml-0 pb-3" style="height:600px;" >
                <meme-stream></meme-stream>
                <div class="card">
                    <div class="card-header">
                        Upload the dankest meme you got
                    </div>
                    <div class="card-body">
                        <meme-upload></meme-upload>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-5 bg-dark pb-3">
            <div>
                <h1 class="text-light">Blabs</h1>
            </div>
            <div class="bg-light">
                <div style="overflow:hidden">
                    <div style="height:400px;  max-height:400px; overflow-y:scroll;">
                        <ul class="list-group">
                            @foreach ($blabs as $blab)
                                <li class="list-group-item p-1">
                                    @include('blabs.show')
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @include('blabs.store')
        </div>
    </div>
    <div class="row">
        <div class="container-fluid bg-dark ml-0 pb-3 mt-3">
            <h1 class="text-light">Blab Analytics</h1>
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
    </div>
</div>
@endsection