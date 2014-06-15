@extends('layout.main')

@section('content')

	<div class="col-md-12 titleBlock bg-primary">
		Change profile
	</div>
	
	<!-- Maakt een formulier aan om het profiel aan te passen -->
	<div class="col-md-12 form">
		{{ Form::open(array('route' => array('profile-change-post'),  'files' => true)) }}
		
			Current image:<br>
			{{ HTML::image('uploads/' . $user['image'],'Image', array('width' => '100', 'height' => '100')) }}<br>
		
			<br>
			
			Image:<br>
			{{ Form::file('picture') }}
			@if($errors->has('picture'))
				{{ $errors->first('picture', '<span class="text-danger">:message</span>') }}<br>
			@endif
			
			<br>
			
			Signature:<br>
			{{ Form::textarea('signature', $user['signature'], array('class' => 'textarea')) }}
			@if($errors->has('signature'))
				{{ $errors->first('signature', '<span class="text-danger">:message</span>') }}<br>
			@endif
		
			<br>
			
			{{ Form::submit('Update profile', array('class' => 'btn-primary button')) }}
			
		{{ Form::token() }}	
		{{ Form::close() }}	
	</div>
@stop