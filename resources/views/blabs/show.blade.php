<div class="container-fluid">
	<a href="/users/{{$blab->user_id}}">{{'@' . $blab->user_id}}</a>
	<small>
		{{ Carbon\Carbon::parse($blab->created_at)->diffForHumans() }}
	</small>
	<p class="mb-0">{{$blab->message}}</p>

</div>
