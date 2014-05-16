<h1>Topics</h1>

<h3>Actieve topics</h3>
@if ($openTopics == null)
	Er zijn op dit moment geen actieve topics.
@else
	@foreach ($openTopics as $topic)
		{{ $topic['title'] }}<br/>
	@endforeach
@endif

<h3>Gesloten topics</h3>
@if ($closedTopics == null)
	Er zijn op dit moment geen gesloten topics.
@else
	@foreach ($closedTopics as $topic)
		{{ $topic['title'] }}<br/>
	@endforeach
@endif