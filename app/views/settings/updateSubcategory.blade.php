@extends('layout/main')

@section('content')

	<div class="col-md-12 titleBlock bg-primary">
		Change subcategory
	</div>			
	
	<!-- Maakt een formulier aan om een subcategorie te wijzigen -->
	<div class="col-md-12 form">	
						
		{{ Form::open(array('route' => array('update-subcategory-post'))) }}
				
			Subcategory name:<br>
			{{ Form::text('subcategoryname', $subcategory['name'], array('class' => 'text')) }}
			@if($errors->has('subcategoryname'))
				{{ $errors->first('subcategoryname', '<span class="text-danger">:message</span>') }}
			@endif
				
			<br>
			
			Short description:<br>
			{{ Form::text('subcategorydescription', $subcategory['description'], array('class' => 'text')) }}
			
			<br>
					
			{{ Form::hidden('subcategoryID', $subcategory['id']) }}
			
			{{ Form::submit('Change subcategory', array('class' => 'btn-primary button')) }}
		
		{{ Form::token() }}
		{{ Form::close() }}
			
	</div>

@stop