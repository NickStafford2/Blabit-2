@extends('layouts.app')

@section('content')
    <h1>All Users</h1>
    @if (count($users) > 0)
        @php
            {{$counter = 0;}}
        @endphp
        <div class="card-deck"> 
        @foreach($users as $user)
            @php
                {{$counter++; }} 
            @endphp
                <div class="card text-white bg-dark mb-4">
                    <a href="/users/{{$user->id}}">
                        <img class="card-img-top img-fluid" src="storage/avatars/{{$user->img_link}}" alt="Card image cap" style="border-radius: 50%">
                    </a>
                    <div class="card-body">
                        <a href="/users/{{$user->id}}">
                            <h5>{{$user->name}}</h5>
                            <p>{{'@'}}{{$user->id}}</p>
                        </a>
                    </div>
              </div>
            @if ($counter%2==0)
                <div class="w-100 d-none d-sm-block d-md-none"><!-- wrap every 2 on sm--></div>
            @endif
            @if ($counter%3==0)
                <div class="w-100 d-none d-md-block d-lg-none"><!-- wrap every 3 on md--></div>
            @endif
            @if ($counter%4==0)
                <div class="w-100 d-none d-lg-block d-xl-none"><!-- wrap every 4 on lg--></div>
            @endif
            @if ($counter%5==0)
                <div class="w-100 d-none d-xl-block"><!-- wrap every 5 on xl--></div>
            @endif

        @endforeach
        </div>
    @else
        <p>There are no users</p>
    @endif
@endsection