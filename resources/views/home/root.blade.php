@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-6">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <h1>Welcome {{ Auth::user()->id }}</h1>
                        <a href="{{ url('/home') }}">Your Profile</a>
                    @else
                        <h1>Welcome To Blabit.</h1>
                        <p>Feel free to browse around anonymously. Or <a href="{{ route('login') }}">Login</a> to experience full features. </p>
                        
                        <p>No account? It only takes a minute to <a href="{{ route('register') }}">Register</a></p>
                    @endauth
                </div>
            @endif
        </div>
        <div class="col-md-6">
            @include('inc.triggerWarning')
        </div>
    </div>
    <div>
        <h1>Trending Chats</h1>
        <p>put trending items here</p>
        <ul>
            <li>blabit</li>
        </ul>
    </div> 
    <div class="content">
        <div class="title m-b-md">
            <h1>Incoming Features</h1>
            <ul class="list-group">
                <li class="list-group-item">Notifications</li>
                <li class="list-group-item">Chat upvote and downvote</li>
                <li class="list-group-item">Chat flag innapropreate content</li>
                <li class="list-group-item">Meme Stream</li>
                <li class="list-group-item">Meme uploads</li>
                <li class="list-group-item">Favorite Profiles</li>
                <li class="list-group-item">Hashtags</li>
                <li class="list-group-item">Organize subscribers into circles</li>
                <li class="list-group-item">Patrons</li>
                <li class="list-group-item">Donations</li>
                <li class="list-group-item">Create sophisticated voting system and algorithms</li>
                <li class="list-group-item">Blab Upvoting</li>
                <li class="list-group-item">Blab Responces</li>
                <li class="list-group-item">Show Responce thread</li>
                <li class="list-group-item">Improved UI</li>
                <li class="list-group-item">Fix Javascript for counting number of characters</li>
                <li class="list-group-item">Bots to automatically post interesting things</li>
                <li class="list-group-item">More analytics</li>
                <li class="list-group-item">insert links in blabs</li>
                <li class="list-group-item">Implement Shouts as paid messages</li>
                <li class="list-group-item">Implement private messages to other users</li>
                <li class="list-group-item">Implement captia/recaptia as invisible User Authentification</li>
                <li class="list-group-item">Set up email network and possibly blabit email domain</li>
                <li class="list-group-item">2 Step Autherization</li>
                <li class="list-group-item">Write Policies</li>
                <li class="list-group-item">Write Terms and conditions</li>
                <li class="list-group-item">Verification Checkmark</li>
                <li class="list-group-item">Mute Feature</li>
                <li class="list-group-item">VueJS everywhere</li>
            </ul>
            <h1>Features Started</h1>
            <ul class="list-group">
                <li class="list-group-item">Blabs</li>
                <li class="list-group-item">Users</li>
            </ul>
            <h1>Features Finished</h1>
            <ul class="list-group">
                <li class="list-group-item">None</li>
            </ul>
            <h1>Long Term Goals</h1>
            <ul class="list-group">
                <li class="list-group-item">Port from Laravel to a more sophisticated framework</li>
                <li class="list-group-item">Test UI and features with real people</li>
                <li class="list-group-item">Purchase Domain name</li>
                <li class="list-group-item">Contact Big Names</li>
                <li class="list-group-item">Run Site Through Security software to expose vulnerabilities</li>
                <li class="list-group-item">Test site with professional hacker</li>
                <li class="list-group-item">Get Paypal connection</li>
                <li class="list-group-item">Contact lawier and discuss any legal issues</li>
            </ul>                
        </div>
    </div>
@endsection