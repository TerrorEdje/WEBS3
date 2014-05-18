@extends('layout/main')

@section('content')

	<form action="{{ URL::route('user-create-post') }}" method="post">
		
		<div class="field">
			Email: <input type="text" name="email" {{ (Input::old('email')) ? 'value="' . e(Input::old('email')) . '"' : '' }}>
			@if($errors->has('email'))
				{{ $errors->first('email') }}
			@endif
		</div>
		<div class="field">
			Username: <input type="text" name="username">
		</div>
		<div class="field">
			Password: <input type="password" name="email">
		</div>
		<div class="field">
			Password again: <input type="password" name="password_again">
		</div>
		
		<input type="submit" value="Create Account">
		{{ Form::token(); }}
	</form>

@stop