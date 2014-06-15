@extends('layout/main')

@section('content')

	<div class="col-md-12 titleBlock bg-primary">
		News management
	</div>			
	
	<!-- Maakt een formulier aan een nieuwsbericht toe te voegen -->
	<div class="col-md-12 form">
	
		{{ Form::open(array('route' => array('manage-news-post'))) }}
				
			Name:<br>
			{{ Form::text('name', null, array('class' => 'text')) }}
			@if($errors->has('name'))
				{{ $errors->first('name', '<span class="text-danger">:message</span>') }}<br>
			@endif
					
			<br>
					
			Content:<br>
			{{ Form::textarea('content', null, array('class' => 'textarea')) }}
			@if($errors->has('content'))
				{{ $errors->first('content', '<span class="text-danger">:message</span>') }}<br>
			@endif
				
			<br>
					
			{{ Form::submit('Add news', array('class' => 'btn-primary button')) }}
		
		{{ Form::token() }}
		{{ Form::close() }}
		
	</div>

@stop