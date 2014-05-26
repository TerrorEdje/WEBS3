@extends('layout/main')

@section('content')

	<br>

	<div class="col-md-12 titleBlock bg-primary">
		Change password
	</div>
	
	<div class="col-md-12 form">
		<!-- <form action="{{ URL::route('account-change-password-post') }}" method="post"> -->
		{{ Form::open(array('route' => array('account-change-password-post'))) }}
		
			Old password:<br>
			{{Form::password('old_password', array('class' => 'text'))}}
			@if($errors->has('old_password'))
				{{ $errors->first('old_password', '<span class="text-danger">:message</span>') }}<br>
			@endif
			
			<br>
			
			New password:<br>
			{{Form::password('password', array('class' => 'text'))}}
			@if($errors->has('password'))
				{{ $errors->first('password', '<span class="text-danger">:message</span>') }}<br>
			@endif
			
			<br>
		
			New password again:<br>
			{{Form::password('password_again', array('class' => 'text'))}}
			@if($errors->has('password_again'))
				{{ $errors->first('password_again', '<span class="text-danger">:message</span>') }}<br>
			@endif
			
			<br>
			<!-- <input type="submit" value="Sign in"> -->
			
			{{ Form::submit('Change password', array('class' => 'btn-primary button')) }}
			
		{{ Form::token() }}	
		{{ Form::close() }}	
	</div>

@stop