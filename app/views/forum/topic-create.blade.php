@extends('layout/main')

@section('content')

	<br>

	<div class="col-md-12 titleBlock bg-primary">
		Create new topic
	</div>

	<div class="col-md-12 form">

		{{ Form::open(array('route' => array('forum-topic-create-post'))) }}
			
			Title:<br>
			{{ Form::text('title', Input::old('text'), array('class' => 'text')) }}
			@if($errors->has('title'))
				{{ $errors->first('title', '<span class="text-danger">:message</span>') }}<br>
			@endif
			
			<br>
			
			Post:<br>
			{{ Form::textarea('content', Input::old('content'), array('class' => 'textarea')) }}
			@if($errors->has('content'))
				{{ $errors->first('content', '<span class="text-danger">:message</span>') }}<br>
			@endif
			
			<br>
			
			{{ Form::hidden('name', $name) }}
			{{ Form::submit('Create', array('class' => 'btn-primary button')) }}
			
		{{ Form::token(); }}	
		{{ Form::close() }}	
		
	</div>
	
@stop