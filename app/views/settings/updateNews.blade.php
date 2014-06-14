@extends('layout/main')

@section('content')

	<div class="col-md-12 titleBlock bg-primary">
		Change news
	</div>			
			
	<div class="col-md-12 form">
	
		{{ Form::open(array('route' => array('update-news-post'))) }}
				
			Name:<br>
			{{ Form::text('name', $news['name'], array('class' => 'text')) }}
			@if($errors->has('name'))
				{{ $errors->first('name', '<span class="text-danger">:message</span>') }}<br>
			@endif
					
			<br>
					
			Content:<br>
			{{ Form::textarea('content', $news['content'], array('class' => 'textarea')) }}
			@if($errors->has('content'))
				{{ $errors->first('content', '<span class="text-danger">:message</span>') }}<br>
			@endif
				
			<br>
			
			{{ Form::hidden('newsID', $news['id']) }}
			
			{{ Form::submit('Change news', array('class' => 'btn-primary button')) }}
		
		{{ Form::token() }}
		{{ Form::close() }}
		
	</div>

@stop