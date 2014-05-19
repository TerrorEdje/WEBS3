@extends('layout/main')

@section('content')

	<form action="{{ URL::route('user-create-post') }}" method="post">
		
		<div class="field">
			Email: {{Form::text('email')}}
			@if($errors->has('email'))
				{{ $errors->first('email') }}
			@endif
		</div>
		<div class="field">
			Username: {{Form::text('username')}}
			@if($errors->has('username'))
				{{ $errors->first('username') }}
			@endif
		</div>
		<div class="field">
			Password: {{Form::password('password')}}
			@if($errors->has('password'))
				{{ $errors->first('password') }}
			@endif
		</div>
		<div class="field">
			Password again: {{Form::password('password_again')}}
			@if($errors->has('password_again'))
				{{ $errors->first('password_again') }}
			@endif
		</div>
		
		<input type="submit" value="Create Account">
		{{ Form::token(); }}
	</form>

@stop