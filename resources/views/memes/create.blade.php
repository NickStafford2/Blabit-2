@extends('layouts.app')

@section('title','Create Meme')
@section('content')

<h1>Create New Meme</h1>

<form method="post" action="{{ route('memes.store') }}" enctype="multipart/form-data">
	@csrf
	<div class="form-group">
		<label for="img">Image</label>
		<input class="form-control-file" type="file" id="img" name="img">
	</div>
	<div class="form-group">
		<label for="title">Title</label>
		<input class="form-control" type="text" name="title">
	</div>
	<div class="form-group">
		<label for="description">Description</label>
		<input class="form-control" type="text" name="description">
	</div>
	<input type="submit" value="Upload">
</form>
@endsection