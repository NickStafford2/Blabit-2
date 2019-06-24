@extends('layouts.app')

@section('content')

<h1>{{'@'.$user->id}}</h1>
{{Form::model($user, [ 	'route' => ['users.update', $user->id],
                      	'method'=> 'PATCH'                          ])}}
	<div class="form-group">
	    {{Form::label('name','Name*')}}
	    {{Form::text('name', null, ['class' => 'form-control'])}}
	</div>
	<div class="form-group">
	    {{Form::label('email','Email')}}
	    {{Form::text('email', null, ['class' => 'form-control'])}}
	</div>
	<div class="form-group">
	    {{Form::label('description','description')}}
	    {{Form::textarea('description', null, ['class' => 'form-control'])}}
	</div>
       {{Form::submit('Update', ['class' => 'btn btn-primary'])}}
{{Form::close()}}
<hr>
<form method="POST" action="/users/{{$user->id}}/avatar" enctype="multipart/form-data">
	{{csrf_field()}}
	<div class="form-group">
		<input type="file" name="avatar"></input>
	</div>
	<button type="submit">Save Avatar</button>
</form>
@endsection

