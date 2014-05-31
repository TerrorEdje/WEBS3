@extends('layout/main')

@section('content')

	<div class="col-md-12 titleBlock bg-primary">
		Forgot password
	</div>
	
	<div class="col-md-12 form">
		{{ Form::open(array('route' => array('account-forgot-password-post'))) }}
		
			Email:<br>
			{{ Form::text('email', null, array('class' => 'text')) }}
			@if($errors->has('email'))
				{{ $errors->first('email') }}<br>
			@endif
			
			<br>
			
			{{ Form::submit('Recover', array('class' => 'btn-primary button')) }}
			
		{{ Form::token() }}	
		{{ Form::close() }}	
	</div>

@stop