@extends('layout/main')

@section('content')

	<div class="col-md-12 titleBlock bg-primary">
		Change reply
	</div>
	
	<div class="col-md-12 form">
		{{ Form::open(array('route' => array('update-reply-post'))) }}
			{{ Form::textarea('content', $reply['content'], array('class' => 'textarea')) }}<br>
			@if($errors->has('content'))
				{{ $errors->first('content', '<span class="text-danger">:message</span>') }}<br>
			@endif	
			{{ Form::hidden('replyID', $reply['id']) }}
			{{ Form::submit('Reply', array('class' => 'btn-primary button')) }}
		{{ Form::close() }}
	</div>
	
	&nbsp;<br>
	
@stop