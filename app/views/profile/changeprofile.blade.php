@extends('layout.main')

@section('content')
		<form action="{{ URL::route('profile-change-post') }}" method="post" enctype="multipart/form-data">
		
		<div class="field">
			Image: {{Form::file('image')}}
			@if($errors->has('image'))
				{{ $errors->first('image') }}
			@endif
		</div>
		<div class="field">
			Signature: {{Form::textarea('username')}}
			@if($errors->has('username'))
				{{ $errors->first('username') }}
			@endif
		</div>
		
		<input type="submit" value="Update profile">
		{{ Form::token(); }}
	</form>
@stop