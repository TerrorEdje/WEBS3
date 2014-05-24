@extends('layout/main')

@section('content')

	<form action="{{ URL::route('forum-topic-create-post') }}" method="post">
		
		<div class="field">
			Title: {{Form::text('title')}}
			@if($errors->has('title'))
				{{ $errors->first('title') }}
			@endif
		</div>
		<div class="field">
			{{Form::textarea('content')}}
			@if($errors->has('content'))
				{{ $errors->first('content') }}
			@endif
		</div>
		
		<input type="submit" value="Create">
		{{ Form::token(); }}
		{{ Form::hidden('id',$name) }}
	</form>

@stop