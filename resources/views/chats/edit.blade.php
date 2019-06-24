@extends('layouts.app')
 
@section('content')
<h1>Edit Chat</h1>

    {{Form::model($chat, [  'route' => ['chats.update', $chat->id],
                            'method'=> 'PATCH'                          ])}}
        <div class="form-group">
            {{Form::label('title','Title')}}
            {{Form::text('title', null, ['class' => 'form-control',
                                         'required' => 'required'])}}
        </div>
        <div class="form-group">
            {{Form::label('description','Description')}}
            {{Form::textarea('description', null, ['class' => 'form-control'])}}
        </div>
        <div class="form-check my-3">
            {{Form::hidden('is_live',0)}}
            {{Form::checkbox('is_live')}}
            {{Form::label('is_live', 'Is Live', ['class' => 'form-check-label'])}}
        </div>
        {{Form::submit('Update', ['class' => 'btn btn-primary'])}}
    {{Form::close()}}
    <hr>
    {{Form::model($chat, [  'route'  => ['chats.destroy', $chat->id],
                            'method' => 'DELETE'    ])}}
        {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
    {{Form::close()}}


    <div class="row">
        <div class="col-md-7">
        </div>
        <div class="col-md-5">
        </div>
    </div>
</div>
@endsection