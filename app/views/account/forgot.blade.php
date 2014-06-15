@extends('layout/main')

@section('content')

	<div class="col-md-12 titleBlock bg-primary">
		Forgot password
	</div>
	
	<!-- Maakt het formulier aan om een nieuw wachtwoord aan te vragen -->
	<div class="col-md-12 form">
		{{ Form::open(array('route' => array('account-forgot-password-post'))) }}
		
			Email:<br>
			{{ Form::text('email', null, array('class' => 'text')) }}
			@if($errors->has('email'))
				{{ $errors->first('email', '<span class="text-danger">:message</span>') }}<br>
			@endif
			
			<br>
			
			{{ Form::submit('Recover', array('class' => 'btn-primary button')) }}
			
		{{ Form::token() }}	
		{{ Form::close() }}	
	</div>

@stop