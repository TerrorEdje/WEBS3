@extends('layout/main')

@section('content')

	<div class="col-md-12 titleBlock bg-primary">
		Change topic
	</div>
	
	<!-- Maakt het formulier aan om een topic te wijzigen -->
	<div class="col-md-12 form">

			{{ Form::open(array('route' => array('update-topic-post'))) }}
				
				Title:<br>
				{{ Form::text('title', $topic['title'], array('class' => 'text')) }}
				@if($errors->has('title'))
					{{ $errors->first('title', '<span class="text-danger">:message</span>') }}<br>
				@endif
				
				<br>
				
				Post:<br>
				{{ Form::textarea('content', $reply['content'], array('class' => 'textarea')) }}
				@if($errors->has('content'))
					{{ $errors->first('content', '<span class="text-danger">:message</span>') }}<br>
				@endif
				
				<br>
				
				{{ Form::hidden('topicID', $topic['id'] ) }}
				{{ Form::hidden('replyID', $reply['id'] ) }}
				{{ Form::submit('Change topic', array('class' => 'btn-primary button')) }}
				
			{{ Form::token(); }}	
			{{ Form::close() }}	
			
		</div>
	
	&nbsp;<br>
	
@stop