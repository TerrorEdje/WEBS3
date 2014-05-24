@extends('layout/main')

@section('content')

	<h1>{{ $name }}<small><a href="{{ URL::route('forum-topic-create',$name) }}">new topic</a></small></h1>
	
	@if ($openTopics == null)
		There are no topics at the moment.
	@else
		<table class="table table-striped">
			<tr>
				<th class="col-sm-7"></th>
				<th class="col-sm-1">By</th>
				<th class="col-sm-1">Replies</th>
				<th class="col-sm-3">Last reply</th>
			</tr>
			@foreach ($openTopics as $infoTopic)
				<tr>
					<td >{{ link_to_route('forum-topic', $infoTopic['topic']->title, array('id' => $infoTopic['topic']->id )) }}</td>
					<td>{{ $infoTopic['by'] }}</td>
					<td>{{ $infoTopic['amountOfReplies'] }}</td>
					@if ($infoTopic['lastReply'] == 0) 
						<td> - </td>
					@else
						<td>{{ $infoTopic['lastReply'] }}</td>
					@endif
				</tr>
			@endforeach
			@foreach ($closedTopics as $infoTopic)
				<tr>
					<td >{{ link_to_route('forum-topic', $infoTopic['topic']->title, array('id' => $infoTopic['topic']->id )) }}</td>
					<td>{{ $infoTopic['by'] }}</td>
					<td>{{ $infoTopic['amountOfReplies'] }}</td>
					@if ($infoTopic['lastReply'] == 0) 
						<td> - </td>
					@else
						<td>{{ $infoTopic['lastReply'] }}</td>
					@endif
				</tr>
			@endforeach
		</table>
	@endif



@stop