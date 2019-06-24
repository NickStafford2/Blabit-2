@extends('layouts.app')

@section('content')

<div class="row" id="app">
    <div class="col-md-4">

        {!!Html::image(asset('storage/avatars/' . $user->img_link), 'Avatar Not Found', array('width' => 200, 'height' => 200)) !!}

        <h1>{{$user->name}}</h1>
        <p>{{'@'}}{{$user->id}}</p>
        <p>{{$user->email}}</p>
        <p>{{$user->description}}</p>
        <p>{{count($subscribers)}} Subscribers</p>
        <p>Subscribed to {{count($subscribees)}} users</p>

        @if (Auth::id() == $user->id)
            <a class="btn btn-primary" href="{{route('users.edit', $user->id)}}">Edit Profile</a>

        @else
            @php
                //print_r($mySubscriptions);
                $am_i_subscribed = in_array($user->id, $mySubscriptions);
                //echo $am_i_subscribed;
            @endphp
            <subscribe-button am_i_subscribed={{$am_i_subscribed}}></subscribe-button>
            <sponsor-button am_i_sponsor='0'></sponsor-button>
        @endif

    </div>

    <div class="col-md-8">

        <tabs :options="{ defaultTabHash: '#subscribers' }" >
            @if (isset($user->video))
                <tab name="Chanel Trailer">
                   @include('users.video')
                </tab>
            @endif

            <tab name="Subscribers">
                @if(count($subscribers) > 0) 
                    <ul class="list-group">
                    @foreach ($subscribers as $user)
                        <li class="list-group-item">
                            @include('users.tile')
                        </li>
                    @endforeach
                    </ul>
                @endif
            </tab>

            <tab name="Subscribed To">
                @if(count($subscribees) > 0) 
                    <ul class="list-group">
                    @foreach ($subscribees as $user)
                        <li class="list-group-item">
                            @include('users.tile')
                        </li>
                    @endforeach
                    </ul>
                @endif
            </tab>
        </tabs>
    </div>
</div>
<hr>

@endsection



