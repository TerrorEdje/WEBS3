@extends('layout/main')

@section('content')

	<form action="{{ URL::route('account-change-password-post') }}" method="post">
		
		<div class="field">
			Old password: {{Form::password('old_password')}}
			@if($errors->has('old_password'))
				{{ $errors->first('old_password') }}
			@endif
		</div>
		<div class="field">
			New password: {{Form::password('password')}}
			@if($errors->has('password'))
				{{ $errors->first('password') }}
			@endif
		</div>
		<div class="field">
			New password again: {{Form::password('password_again')}}
			@if($errors->has('password_again'))
				{{ $errors->first('password_again') }}
			@endif
		</div>
		<input type="submit" value="Sign in">
		{{ Form::token() }}
	</form>

@stop