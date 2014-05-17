
<h1>Topic pagina</h1>

<h3>Titel topic: {{ $topic['topic']->title }}</h3>	

By: {{ $topic['by']->username }}<br/>
Date: {{ $topic['topic']->by }}

<h3>Berichten</h3>	

@foreach ($replies as $infoReply)
	<p>
		{{ $infoReply['by']->username }}<br/>
		{{ $infoReply['reply']->date }}<br/>
		{{ $infoReply['reply']->content }}
	</p>
@endforeach

<div>
{{ Form::open(array('route' => array('topic2', $topic['topic']->id))) }}
	Reply:</br>
	{{ Form::textarea('content') }}</br>
	Usernaam: {{ Form::text('username') }}</br>
	{{ Form::submit('Reply') }}
	{{ Form::close() }}
		
</div>

