<div class="container-fluid bg-light">
	{!! Form::open(array(	'route' => ['blabs.store'],
							'method' => 'POST',
              'autocomplete' => 'off'									))!!}
	{{ Form::hidden('chat_id', $chat->id) }}

    <div class="container-fluid px-0 mb-2">
        {{Form::label('message','Message')}}

        {{Form::text('message', null, [	'class'       => 'form-control my-6 ',
                                 		    'placeholder' => 'blah blah blah',
                                 		    'required'    => 'required',
                                        'onKeyUp'     =>  'var counter = document.getElementById("counter"); 
                                                       var x = this.value.length;
                                                       counter.innerHTML = x; '   ])}}
        <!--div id="user-message" class="chat-draft-text" name="user-message" contenteditable=""></div-->	  	
  </div>
	<div class="d-flex justify-content-between">
      	<div>
        	<p><span id="counter">0</span>/200</p>
      	</div>
      	<div>
    		{!! Form::submit('Blab', [	'class' => 'btn btn-outline-primary'	]) !!}
      	</div>
 	</div>
    {!! Form::close() !!}
</div>