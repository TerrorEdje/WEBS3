@extends('layout.main')

@section('content')
		<form action="{{ URL::route('profile-change-post') }}" method="post" enctype="multipart/form-data">
		<div class="field">
			Current image:{{ HTML::image('uploads/' . $user['image'],'Image', array('width' => '100', 'height' => '100'))}}
		</div>
		<div class="field">
			Image: {{Form::file('image')}}
			@if($errors->has('image'))
				{{ $errors->first('image') }}
			@endif
		</div>
		<div class="field">
			Signature: {{Form::textarea('signature',$user['signature'])}}
			@if($errors->has('signature'))
				{{ $errors->first('signature') }}
			@endif
		</div>
		
		<input type="submit" value="Update profile">
		{{ Form::token(); }}
	</form>
@stop