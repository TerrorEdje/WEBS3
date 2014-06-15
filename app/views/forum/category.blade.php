@extends('layout/main')

@section('content')

	<div class="row">
		<div class="col-md-12 titleBlock bg-primary">
			{{ $subcategory['name'] }}
		</div>
	</div>
		
	<!--Toont de topics van een subcategorie -->
	@if ($openTopics == null && $closedTopics == null)
		<div class="row">
			<div class="col-md-12 messageBlock">
				There are no topics at the moment.
			</div>
		</div>
		<br/>
		<div class="row">
			<div>
				{{ Form::open(array('route' => array('forum-topic-create-get', $name))) }}
					{{ Form::submit('New topic', array('class' => 'btn-primary button')) }}
				{{ Form::close() }}
				<br>
				<a href="#" onclick="addToFavorites({{$subcategory['id']}})">Add to favorites <span class="glyphicon glyphicon-heart"></span></a>
			</div>
		</div>
	@else
		<div class="row">
			<div>
				{{ Form::open(array('route' => array('forum-topic-create-get', $name))) }}
					{{ Form::submit('New topic', array('class' => 'btn-primary button')) }}
				{{ Form::close() }}
				<br>
				<a href="#" onclick="addToFavorites({{$subcategory['id']}})">Add to favorites <span class="glyphicon glyphicon-heart"></span></a>
			</div>
		</div>
		
		<br>
		
		<!-- Maakt een zoekbalk aan -->
		<div class="row">
			<span>Search for topic:</span>
			<input type="text" name="search-criteria" id="search-criteria" class="searchboxTopic"/>
		</div>
	
		<div class="row">
			<table class="col-sm-12 topicsTable">
				<tr>
					<th class="col-sm-6 topicsTabelNameTD"></th>
					<th class="col-sm-2 tableTD">By</th>
					<th class="col-sm-2 tableTD">Replies</th>
					<th class="col-sm-2 topicsTabelLastReplyTD">Last reply</th>
				</tr>
				
				<!-- Toont alle open topics -->
				@foreach ($openTopics as $infoTopic)
					<tr class="topic">
						<td class="col-sm-6 topicsTabelNameTD">{{ link_to_route('forum-topic', $infoTopic['topic']->title, array('id' => $infoTopic['topic']->id )) }}</td>
						<td class="col-sm-2 tableTD">{{ $infoTopic['by'] }}</td>
						<td class="col-sm-2 tableTD">{{ $infoTopic['amountOfReplies'] }}</td>
						@if ($infoTopic['lastReply'] == 0) 
							<td class="col-sm-2 topicsTabelLastReplyTD"> - </td>
						@else
							<td class="col-sm-2 topicsTabelLastReplyTD">{{ $infoTopic['lastReply'] }}</td>
						@endif
					</tr>
				@endforeach
				
				<!-- Toont alle gesloten topics -->
				@foreach ($closedTopics as $infoTopic)
					<tr class="topic">
						<td class="col-sm-6 topicsTabelNameTD">
							<i class="indicator glyphicon glyphicon-lock"></i>
							{{ link_to_route('forum-topic', $infoTopic['topic']->title, array('id' => $infoTopic['topic']->id )) }}
						</td>
						<td class="col-sm-2 tableTD">{{ $infoTopic['by'] }}</td>
						<td class="col-sm-2 tableTD">{{ $infoTopic['amountOfReplies'] }}</td>
						@if ($infoTopic['lastReply'] == 0) 
							<td class="col-sm-2 topicsTabelLastReplyTD"> - </td>
						@else
							<td class="col-sm-2 topicsTabelLastReplyTD">{{ $infoTopic['lastReply'] }}</td>
						@endif
					</tr>
				@endforeach
			</table>
		</div>
	@endif

@stop