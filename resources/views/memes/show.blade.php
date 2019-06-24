<div class="card">
	<img class="card-img-top" src="storage/memes/{{$meme->img}}" alt="could not find" height="auto" width="200">
	<div class="card-body">
		<p>{{$meme->description}}</p>
		<a class="card-text" href="users/{{$meme->user_id}}">{{'@'.$meme->user_id}}</a>
		<small class="text-muted">Created At: {{$meme->created_at}}</small>
	</div>
</div>