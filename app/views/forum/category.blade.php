@extends('layout/main')

@section('content')

	<br>

	<div class="col-md-12 titleCategory bg-primary">
		{{ $subcategory['name'] }}
	</div>
	<a href="{{ URL::route('forum-topic-create',$subcategory['name']) }}">new topic</a>
	@if ($openTopics == null && $closedTopics == null)
		<div class="col-md-12 messageBlock">
			There are no topics at the moment.
		</div>
	@else
		<table class="table table-striped">
			<tr>
				<th class="col-sm-6"></th>
				<th class="col-sm-2">By</th>
				<th class="col-sm-2">Replies</th>
				<th class="col-sm-2">Last reply</th>
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