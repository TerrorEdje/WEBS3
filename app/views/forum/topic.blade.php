@extends('layout/main')

@section('content')

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
				<td class="col-md-2 tableTD">FOTO</td>
				<td class="col-md-10 tableTD">{{ $reply['reply']->content }}</td>
			</tr>
			<tr>
				<td class="col-md-2 tableTD"></td>
				<td class="col-md-10 tableTD">{{ $reply['by']->signature }}</td>
			</tr>
		</table>
	</div>
	
	@if (count($topic['polloptions']) != 0)
		<div class="col-md-12 form">
			{{ Form::open(array('route' => array('forum-topic-vote-post', $topic['topic']->id))) }}
				@foreach ($topic['polloptions'] as $polloption)	
					{{ Form::radio('poll', $polloption['id']) }}
					{{ $polloption['description'] }}
					<br>
				@endforeach
				{{ Form::submit('Vote', array('class' => 'btn-primary button')) }}
			{{ Form::token() }}
			{{ Form::close() }}
		</div>
	@endif
	
	<div class="col-md-12 titleBlock bg-primary">
		Replies
	</div>

	<div>
		@if ($replies == null)
			<div class="col-md-12 messageBlock">
				There are no replies at the moment.
			</div>
		@else
			@foreach ($replies as $infoReply)
				<table class="col-sm-12 replyTable">
					<tr>
						<td class="col-sm-2 replyTabelUsernameTD">{{ $infoReply['by']->username }}</td>
						<td class="col-sm-10 replyTabelDateTD">{{ $infoReply['reply']->date }}</td>
					</tr>
					<tr>
						<td class="col-sm-2 tableTD">FOTO</td>
						<td class="col-sm-10 tableTD">{{ $infoReply['reply']->content }}</td>
					</tr>
					<tr>
						<td class="col-sm-2 tableTD"></td>
						<td class="col-sm-10 tableTD">{{ $infoReply['by']->signature }}</td>
					</tr>
				</table>
			@endforeach
		@endif
	</div>

	<div class="col-md-12 titleBlock bg-primary">
		Reply
	</div>
	
	<div class="col-md-12 form">
		{{ Form::open(array('route' => array('forum-topic-post', $topic['topic']->id))) }}
			{{ Form::textarea('content', null, array('class' => 'textarea')) }}<br>
			@if($errors->has('content'))
				{{ $errors->first('content', '<span class="text-danger">:message</span>') }}<br>
			@endif	
			{{ Form::submit('Reply', array('class' => 'btn-primary button')) }}
		{{ Form::close() }}
	</div>
	
	&nbsp;<br>
	
@stop