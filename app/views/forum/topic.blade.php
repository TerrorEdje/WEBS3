@extends('layout/main')

@section('content')

	<br>

	<div class="col-md-12 titleBlock bg-primary">
		{{ $topic['topic']->title }}
	</div>
	
	<div>
		<table class="col-md-12 replyTable">
			<tr>
				<td class="col-md-2 replyTabelUsernameTD">{{ $reply['by']->username }}</td>
				<td class="col-md-10 replyTabelDateTD">{{ $reply['reply']->date }}</td>
			</tr>
			<tr>
				<td class="col-md-2 replyTableTD">FOTO</td>
				<td class="col-md-10 replyTableTD">{{ $reply['reply']->content }}</td>
			</tr>
			<tr>
				<td class="col-md-2 replyTableTD"></td>
				<td class="col-md-10 replyTableTD">{{ $reply['by']->signature }}</td>
			</tr>
		</table>
	</div>
	
	<div class="col-md-12 titleBlock bg-primary">
		Replies
	</div>

	<div>
		@foreach ($replies as $infoReply)
			<table class="col-sm-12 replyTable">
				<tr>
					<td class="col-sm-2 replyTabelUsernameTD">{{ $infoReply['by']->username }}</td>
					<td class="col-sm-10 replyTabelDateTD">{{ $infoReply['reply']->date }}</td>
				</tr>
				<tr>
					<td class="col-sm-2 replyTableTD">FOTO</td>
					<td class="col-sm-10 replyTableTD">{{ $infoReply['reply']->content }}</td>
				</tr>
				<tr>
					<td class="col-sm-2 replyTableTD"></td>
					<td class="col-sm-10 replyTableTD">{{ $infoReply['by']->signature }}</td>
				</tr>
			</table>
		@endforeach
	</div>

	<div class="col-md-12 titleBlock bg-primary">
		Reply
	</div>
	
	<div class="col-md-12 replyForm">
		{{ Form::open(array('route' => array('forum-topic-post', $topic['topic']->id))) }}
			{{ Form::textarea('content', null, array('class' => 'replyTextarea')) }}<br>
			@if($errors->has('content'))
				{{ $errors->first('content', '<span class="text-danger">:message</span>') }}<br>
			@endif	
		{{ Form::submit('Reply', array('class' => 'btn-primary button')) }}
		{{ Form::close() }}		
	</div>

@stop