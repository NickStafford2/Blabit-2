<a href="chats/{{$chat->id}}" class="list-group-item list-group-item-action">
    @if ($chat->is_live)
        @include('chats.liveIcon')
    @endif

    <div>
        <h3>{{$chat->title}}</h3>
        <small>By: {{$chat->user->name}}</small><br>
        <small>{{$chat->created_at}}</small>

    </div>
</a>