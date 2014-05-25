@extends('layout/main')

@section('content')

	<br>

	<div class="col-md-12 titleTopic bg-primary">
		{{ $topic['topic']->title }}
	</div>
	
	<div>
		<table class="col-sm-10 replyTable">
			<tr>
				<td class="col-sm-3 replyTabelUsernameTD">{{ $reply['by']->username }}</td>
				<td class="col-sm-7 replyTabelDateTD">{{ $reply['reply']->date }}</td>
			</tr>
			<tr>
				<td class="col-sm-3 replyTableTD">FOTO</td>
				<td class="col-sm-7 replyTableTD">{{ $reply['reply']->content }}</td>
			</tr>
			<tr>
				<td class="col-sm-3 replyTableTD"></td>
				<td class="col-sm-7 replyTableTD">{{ $reply['by']->signature }}</td>
			</tr>
		</table>
	</div>
	
	<div class="col-md-12 titleTopic bg-primary">
		Replies
	</div>

	<div>
		@foreach ($replies as $infoReply)
			<table class="col-sm-10 replyTable">
				<tr>
					<td class="col-sm-3 replyTabelUsernameTD">{{ $infoReply['by']->username }}</td>
					<td class="col-sm-7 replyTabelDateTD">{{ $infoReply['reply']->date }}</td>
				</tr>
				<tr>
					<td class="col-sm-3 replyTableTD">FOTO</td>
					<td class="col-sm-7 replyTableTD">{{ $infoReply['reply']->content }}</td>
				</tr>
				<tr>
					<td class="col-sm-3 replyTableTD"></td>
					<td class="col-sm-7 replyTableTD">{{ $infoReply['by']->signature }}</td>
				</tr>
			</table>	
		@endforeach
	</div>

	
	{{ Form::open(array('route' => array('forum-topic-post', $topic['topic']->id))) }}
		<div>
		Reply:</br>
		{{ Form::textarea('content') }}<br>
		@if($errors->has('content'))
				{{ $errors->first('content') }}<br>
			@endif
		</div>
		{{ Form::submit('Reply') }}
		{{ Form::close() }}
			
	

@stop