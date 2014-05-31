@extends('layout/main')

@section('content')

	<div class="col-md-12 titleBlock bg-primary">
		Sign in
	</div>

	<div class="col-md-12 form">
		{{ Form::open(array('route' => array('account-sign-in-post'))) }}
		
			Email:<br>
			{{ Form::text('email', null, array('class' => 'text')) }}
			@if($errors->has('email'))
				{{ $errors->first('email', '<span class="text-danger">:message</span>') }}<br>
			@endif
			
			<br>
			
			Password:<br>
			{{ Form::password('password', array('class' => 'text')) }}
			@if($errors->has('password'))
				{{ $errors->first('password', '<span class="text-danger">:message</span>') }}<br>
			@endif
	
			<br>
			
			{{ Form::label('remember','Remember me') }}
			{{ Form::checkbox('remember')  }}
			
			<br>
		
			{{ Form::submit('Sign in', array('class' => 'btn-primary button')) }}
			
		{{ Form::token() }}	
		{{ Form::close() }}	
		
		<br>
		
		<a href="{{ URL::route('account-forgot-password') }}">Forgot password</a>
		
	</div>
	
	
	
@stop