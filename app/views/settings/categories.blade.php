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
	
			<br>
					
			{{ Form::submit('Add category', array('class' => 'btn-primary button')) }}
		
		{{ Form::token() }}
		{{ Form::close() }}
		
	</div>
		
	@foreach ($categories as $infoCategory)		
		<div class="col-md-12 form">
		
			<span class="titleCategory">
				<a href="{{ URL::route('update-category', $infoCategory['category']->id) }}" class="categoryLink">{{  $infoCategory['category']->name }}</a>
				@if (count($infoCategory['subcategories']) == 0)
					<a href="{{ URL::route('delete-category', $infoCategory['category']->id) }}"><i class="indicator glyphicon glyphicon-trash"></i></a>
				@endif
			</span>
	
			<br>
			
			@if (count($infoCategory['subcategories']) == 0)
				This category has no subcategories.
			@else
				@foreach ($infoCategory['subcategories'] as $infoSubcategory)
					<a href="{{ URL::route('update-subcategory', $infoSubcategory['id']) }}" class="subCategoryLink">{{  $infoSubcategory['name'] }}&nbsp;</a>
					@if ($infoSubcategory->getAmountOfTopics() == 0)
						<a href="{{ URL::route('delete-subcategory', $infoSubcategory['id']) }}"><i class="indicator glyphicon glyphicon-trash"></i></a>
					@endif
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				@endforeach
			@endif
				
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
				
				<br>
						
				{{ Form::hidden('category',$infoCategory['category']->id) }}
				
				{{ Form::submit('Add subcategory', array('class' => 'btn-primary button')) }}
			
			{{ Form::token() }}
			{{ Form::close() }}
			
		</div>
	@endforeach

@stop