@extends('layout/main')

@section('content')

	<div class="row">
		<div class="col-md-12 titleBlock bg-primary">
			Create new topic in {{ $subcategory['name'] }}
		</div>
	</div>

	<!-- Maakt het formulier aan om een topic toe te voegen -->
	<div class="row">
		<div class="col-md-12 form">

			{{ Form::open(array('route' => array('forum-topic-create-post'))) }}
				
				Title:<br>
				{{ Form::text('title', Input::old('text'), array('class' => 'text')) }}
				@if($errors->has('title'))
					{{ $errors->first('title', '<span class="text-danger">:message</span>') }}<br>
				@endif
				
				<br>
				
				Post:<br>
				{{ Form::textarea('content', Input::old('content'), array('class' => 'textarea')) }}
				@if($errors->has('content'))
					{{ $errors->first('content', '<span class="text-danger">:message</span>') }}<br>
				@endif
				
				<br>
				
				<p><a id="polltitle" href="#">Create a poll</a><p>
				<p id="poll">
					{{ Form::text('polloption1', Input::old('text'), array('class' => 'text', 'placeholder' => 'Leave blank for less options')) }}<br>
					{{ Form::text('polloption2', Input::old('text'), array('class' => 'text', 'placeholder' => 'Leave blank for less options')) }}<br>
					{{ Form::text('polloption3', Input::old('text'), array('class' => 'text', 'placeholder' => 'Leave blank for less options')) }}<br>
					{{ Form::text('polloption4', Input::old('text'), array('class' => 'text', 'placeholder' => 'Leave blank for less options')) }}<br>
					{{ Form::text('polloption5', Input::old('text'), array('class' => 'text', 'placeholder' => 'Leave blank for less options')) }}<br>
				</p>
				
				{{ Form::hidden('id', $subcategory['id'] ) }}
				{{ Form::submit('Create', array('class' => 'btn-primary button')) }}

				@if(Auth::check())
					@if(Auth::user()->isAdmin() || Auth::user()->isModerator())
						
					@endif
				@endif
				
			{{ Form::token(); }}	
			{{ Form::close() }}	
			
		</div>
	</div>
	
@stop