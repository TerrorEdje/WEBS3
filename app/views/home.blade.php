@extends('layout.main')

@section('content')
	@if(Auth::chck())
		<p>Hello, {{ Auth::user()->username }}.</p>
	@else
		<p>You are not signed in.</p>
	@endif
@stop