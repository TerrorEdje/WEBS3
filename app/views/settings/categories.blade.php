@extends('layout/main')

@section('content')

	<div class="row">
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
				<form action="{{ URL::route('account-sign-in-post') }}" method="post">
					<div class="field">
						Name: {{Form::text('subcategoryname')}}
						@if($errors->has('subcategoryname'))
							{{ $errors->first('subcategoryemail') }}
						@endif
					</div>
					<input type="submit" value="Add subcategory">
					{{ Form::token() }}
				</form>
			</div>
		</div>
	@endforeach

@stop