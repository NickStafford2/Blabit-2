@extends('layouts.app')

@section('content')

<h1>Create New Chat</h1>

    {!! Form::open(array('action' => 'ChatController@store', 
                         'method' => 'POST'                    )) !!}
    {{csrf_field()}}
                         
    <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title','',['class'       => 'form-control',
                                     'placeholder' => 'Title',
                                     'required'    => 'required'      ])}}
    </div>
    <div class="form-group">
            {{Form::label('description', 'Description')}}
            {{Form::textarea('description', '', ['class'       => 'form-control',
                                                 'placeholder' => 'Description',
                                                 'required'    => 'required'        ])}}
    </div>
    {{ Form::submit('Submit',['class' => 'btn'])}}
    {{ Form::close() }}

@endsection