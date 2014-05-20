@extends('layout/main')

@section('content')

	<form action="{{ URL::route('account-sign-in-post') }}" method="post">
		
		<div class="field">
			Email: {{Form::text('email')}}
			@if($errors->has('email'))
				{{ $errors->first('email') }}
			@endif
		</div>
		<div class="field">
			Password: {{Form::password('password')}}
			@if($errors->has('password'))
				{{ $errors->first('password') }}
			@endif
		</div>
		<div class="field">
			{{ Form::label('remember','Remember me') }}
			{{ Form::checkbox('remember')  }}
		</div>
		<input type="submit" value="Sign in">
		{{ Form::token() }}
	</form>

@stop