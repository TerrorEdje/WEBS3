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
		
		{{ Form::close() }}
		
	</div>
		
		
		
		
		
		@foreach ($categories as $infoCategory)
		<div class="row">
			<div class="col-md-12 titleBlock bg-primary">
				{{ $infoCategory['category']->name }}
			</div>
		</div>
		
		
		
		
		
			<div class="row">
			
				@foreach ($infoCategory['subcategories'] as $infoSubcategory)
					<div class="col-md-3">
						<a href="{{ URL::route('forum-category',$infoSubcategory['name']) }}">{{  $infoSubcategory['name'] }}</a>
					</div>
				@endforeach
				
			</div>
			<div class="row">
				<div class="col-md-4">
					<form action="{{ URL::route('manage-category-subcategory-post') }}" method="post">
						<div class="field">
							Subcategory name: {{Form::text('subcategoryname')}}
							@if($errors->has('subcategoryname'))
								{{ $errors->first('subcategoryname') }}
							@endif
						</div>
						<div class="field">
							Short description: {{Form::text('subcategorydescription')}}
							@if($errors->has('subcategorydescription'))
								{{ $errors->first('subcategorydescription') }}
							@endif
						</div>
						<input type="submit" value="Add subcategory">
						{{ Form::hidden('category',$infoCategory['category']->id) }}
						{{ Form::token() }}
					</form>
				</div>
			</div>
		@endforeach

@stop