<div class="container-fluid">
	<img src="/storage/avatars/{{$user->img_link}}" alt="Card image cap" height="80" width="80" style="border-radius: 50%; display:inline-block">
	<div style="display:inline-block">
		<a href="{{ route('users.show',$user->id) }}">
			<h5><strong>{{$user->name}}</strong></h5>
			<p>{{ '@' }}{{$user->id}}</p>
		</a>
	</div>
	<div style="display:inline-block; float:right">
		@php
        	$am_i_subscribed = in_array($user->id, $mySubscriptions);
    	@endphp
		<subscribe-button style="display:block;" am_i_subscribed={{$am_i_subscribed}}></subscribe-button>
		<sponsor-button class="mt-2" style="display:block;" am_i_sponsor=0></sponsor-button>
	</div>
</div>