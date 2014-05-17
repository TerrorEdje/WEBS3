<h1>Topics</h1>

<h3>Actieve topics</h3>
@if ($openTopics == null)
	Er zijn op dit moment geen actieve topics.
@else
	@foreach ($openTopics as $infoTopic)
		{{ link_to_route('topic', $infoTopic['topic']->title, array('id' => $infoTopic['topic']->id )) }}
		Aantal reacties: {{ $infoTopic['amountOfReplies'] }}
		@if ($infoTopic['lastReply'] == 0) 
			Laatste reactie: -<br/>
		@else
			Laatste reactie: {{ $infoTopic['lastReply'] }}<br/>
		@endif<br/>
	@endforeach
@endif

<h3>Gesloten topics</h3>
@if ($closedTopics == null)
	Er zijn op dit moment geen gesloten topics.
@else
	@foreach ($closedTopics as $infoTopic)
		{{ link_to_route('topic', $infoTopic['topic']->title, array('id' => $infoTopic['topic']->id )) }}
		Aantal reacties: {{ $infoTopic['amountOfReplies'] }}
		@if ($infoTopic['lastReply'] == 0) 
			Laatste reactie: -<br/>
		@else
			Laatste reactie: {{ $infoTopic['lastReply'] }}<br/>
		@endif<br/>
	@endforeach
@endif