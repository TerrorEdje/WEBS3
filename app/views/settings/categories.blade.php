@extends('layout/main')

@section('content')

	<div class="col-md-12 titleBlock bg-primary">
		Category management
	</div>			
			
	<div class="col-md-12 form">
	
		{{ Form::open(array('route' => array('manage-category-category-post'))) }}
				
			Category name:<br>
			{{ Form::text('categoryname', null, array('class' => 'text')) }}
			@if($errors->has('categoryname'))
				{{ $errors->first('categoryname', '<span class="text-danger">:message</span>') }}<br>
			@endif
					
			<br>
					
			Short description:<br>
			{{Form::text('categorydescription', null, array('class' => 'text'))}}
			@if($errors->has('categorydescription'))
				{{ $errors->first('categorydescription', '<span class="text-danger">:message</span>') }}<br>
			@endif
				
			<br>
					
			{{ Form::submit('Add category', array('class' => 'btn-primary button')) }}
		
		{{ Form::token() }}
		{{ Form::close() }}
		
	</div>
		
	@foreach ($categories as $infoCategory)		
		<div class="col-md-12 form">
		
			<span class="titleCategorie">{{ $infoCategory['category']->name }}</span>
	
			<br>
			
			@foreach ($infoCategory['subcategories'] as $infoSubcategory)
				<a href="{{ URL::route('forum-category', $infoSubcategory['name']) }}" class="subCategorieLink">{{  $infoSubcategory['name'] }}</a>
			@endforeach
				
			<br>
			<br>	
						
			{{ Form::open(array('route' => array('manage-category-subcategory-post'))) }}
					
				Subcategory name:<br>
				{{ Form::text('subcategoryname', null, array('class' => 'text')) }}
				@if($errors->has('subcategoryname'))
					{{ $errors->first('subcategoryname', '<span class="text-danger">:message</span>') }}
				@endif
					
				<br>
				
				Short description:<br>
				{{ Form::text('subcategorydescription', null, array('class' => 'text')) }}
				@if($errors->has('subcategorydescription'))
					{{ $errors->first('subcategorydescription', '<span class="text-danger">:message</span>') }}
				@endif
				
				<br>
						
				{{ Form::hidden('category',$infoCategory['category']->id) }}
				
				{{ Form::submit('Add subcategory', array('class' => 'btn-primary button')) }}
			
			{{ Form::token() }}
			{{ Form::close() }}
			
		</div>
	@endforeach

@stop