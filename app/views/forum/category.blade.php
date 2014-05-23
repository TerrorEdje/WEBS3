@extends('layout/main')

@section('content')

	<h1>Topics</h1>

	<h3>Open topics</h3>
	@if ($openTopics == null)
		There are no open topics at the moment.
	@else
		@foreach ($openTopics as $infoTopic)
			{{ link_to_route('forum-topic', $infoTopic['topic']->title, array('id' => $infoTopic['topic']->id )) }}
			Replies: {{ $infoTopic['amountOfReplies'] }}
			@if ($infoTopic['lastReply'] == 0) 
				Last reply: -<br/>
			@else
				Last reply: {{ $infoTopic['lastReply'] }}<br/>
			@endif<br/>
		@endforeach
	@endif

	<h3>Closed topics</h3>
	@if ($closedTopics == null)
		There are no closed topics at the moment.
	@else
		@foreach ($closedTopics as $infoTopic)
			{{ link_to_route('forum-topic', $infoTopic['topic']->title, array('id' => $infoTopic['topic']->id )) }}
			Replies: {{ $infoTopic['amountOfReplies'] }}
			@if ($infoTopic['lastReply'] == 0) 
				Last reply: -<br/>
			@else
				Last reply: {{ $infoTopic['lastReply'] }}<br/>
			@endif<br/>
		@endforeach
	@endif

@stop