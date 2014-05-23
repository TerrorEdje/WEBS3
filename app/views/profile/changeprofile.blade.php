@extends('layout.main')

@section('content')
		<form action="{{ URL::route('profile-change-post') }}" method="post">
		
		<div class="field">
			Image: {{Form::file('image')}}
			@if($errors->has('image'))
				{{ $errors->first('image') }}
			@endif
		</div>
		<div class="field">
			Signature: {{Form::text('username')}}
			@if($errors->has('username'))
				{{ $errors->first('username') }}
			@endif
		</div>
		
		<input type="submit" value="Create Account">
		{{ Form::token(); }}
	</form>
@stop