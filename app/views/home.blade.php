@extends('layout.main')

@section('content')

	@if(Auth::check())
		<p>Hello, {{ Auth::user()->username }}.</p>
	@else
		<p>You are not signed in.</p>
	@endif
	
	<div class="col-md-12 titleBlock bg-primary">
		News
	</div>
	
	@foreach ($allNews as $infoNews) 
		<table class="col-md-12 newsTable">
			<tr>
				<td class="col-md-9 titleNewsTD">{{ $infoNews['news']->name }}</td>
				<td class="col-md-3 tableTD">
					{{ date("D d M Y", strtotime($infoNews['news']->created_at)), ' at ', date("H:i", strtotime($infoNews['news']->created_at)) }}
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<a href="{{ URL::route('delete-news', $infoNews['news']->id) }}" class="iconLink">
						<span><i class="indicator glyphicon glyphicon-trash"></i></span>
					</a>
					&nbsp;&nbsp;&nbsp;
					<a href="{{ URL::route('update-news', $infoNews['news']->id) }}" class="iconLink">
						<span><i class="indicator glyphicon glyphicon-pencil"></i></span>
					</a>
				</td>
			</tr>
			<tr>
				<td colspan="2" class="col-md-12 tableTD">{{ $infoNews['news']->content }}</td>
			</tr>
			<tr>
				<td colspan="2" class="col-md-12 tableTD">Written by: {{ $infoNews['by'] }}</td>
			</tr>
		</table>
	@endforeach
	
	&nbsp;<br>
	
@stop