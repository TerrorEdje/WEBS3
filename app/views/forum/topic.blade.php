@extends('layout/main')

@section('content')
	<br>

	<div class="col-md-12 titleTopic bg-primary">
		{{ $topic['topic']->title }}
	</div>

	By: {{ $topic['by']->username }}<br/>
	Date: {{ $topic['topic']->date }}

	<h3>Messages</h3>	

	@foreach ($replies as $infoReply)
		<p>
			{{ $infoReply['by']->username }}<br>
			{{ $infoReply['reply']->date }}<br>
			{{ $infoReply['reply']->content }}
		</p>
	@endforeach

	<div>
	{{ Form::open(array('route' => array('forum-topic-post', $topic['topic']->id))) }}
		Reply:</br>
		{{ Form::textarea('content') }}<br>
		@if($errors->has('content'))
				{{ $errors->first('content') }}<br>
			@endif
		{{ Form::submit('Reply') }}
		{{ Form::close() }}
			
	</div>

@stop