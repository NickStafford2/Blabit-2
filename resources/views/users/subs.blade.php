<div class="container-fluid">
    @if (count($user->subs) > 0)

    <h1>Subscribed to:</h1>
    <ul>
        @foreach ($user->subs as $sub)
            <li>
                <a href="{{ route('users.show',$sub->id) }}">{{$sub->id}}</a>
            </li>
        @endforeach
    </ul>
    @else
    <h1>No Subscriptions</h1>
    @endif
</div>
