@extends('layout/main')

@section('content')

	<div class="col-md-12 titleBlock bg-primary">
		Change category
	</div>			
			
	<div class="col-md-12 form">	
						
		{{ Form::open(array('route' => array('update-category-post'))) }}
				
			Category name:<br>
			{{ Form::text('categoryname', $category['name'], array('class' => 'text')) }}
			@if($errors->has('categoryname'))
				{{ $errors->first('categoryname', '<span class="text-danger">:message</span>') }}
			@endif
				
			<br>
			
			Short description:<br>
			{{ Form::text('categorydescription', $category['description'], array('class' => 'text')) }}
			
			<br>
					
			{{ Form::hidden('categoryID', $category['id']) }}
			
			{{ Form::submit('Add category', array('class' => 'btn-primary button')) }}
		
		{{ Form::token() }}
		{{ Form::close() }}
			
	</div>

@stop