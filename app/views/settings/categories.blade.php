@extends('layout/main')

@section('content')
<h2>Category Management</h2> <br>
	<div class="row">
		<form action="{{ URL::route('manage-category-category-post') }}" method="post">
			<div class="field">
				Category name: {{Form::text('categoryname')}}
				@if($errors->has('categoryname'))
					{{ $errors->first('categoryname') }}
				@endif
			</div>
			<div class="field">
				Short description: {{Form::text('categorydescription')}}
				@if($errors->has('categorydescription'))
					{{ $errors->first('categorydescription') }}
				@endif
			</div>
			<input type="submit" value="Add category">
			{{ Form::token() }}
		</form>
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