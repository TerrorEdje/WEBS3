@extends('layout/main')

@section('content')

	<div class="col-md-12 titleBlock bg-primary">
		Register
	</div>
	
	<div class="col-md-12 form">
		{{ Form::open(array('route' => array('account-create-post'))) }}
	
			Email:<br>
			{{ Form::text('email', null, array('class' => 'text')) }}
			@if($errors->has('email'))
				{{ $errors->first('email', '<span class="text-danger">:message</span>') }}<br>
			@endif
		
			<br>
		
			Username:<br>
			{{ Form::text('username', null, array('class' => 'text')) }}
			@if($errors->has('username'))
				{{ $errors->first('username', '<span class="text-danger">:message</span>') }}<br>
			@endif
		
			<br>
		
			Password:<br>
			{{ Form::password('password', array('class' => 'text')) }}
			@if($errors->has('password'))
				{{ $errors->first('password', '<span class="text-danger">:message</span>') }}<br>
			@endif
			
			<br>
			
			Password again:<br> 
			{{ Form::password('password_again', array('class' => 'text')) }}
			@if($errors->has('password_again'))
				{{ $errors->first('password_again', '<span class="text-danger">:message</span>') }}<br>
			@endif
		
			<br>
			
			{{ Form::submit('Create Account', array('class' => 'btn-primary button')) }}
			
		{{ Form::token() }}	
		{{ Form::close() }}	
	</div>

@stop