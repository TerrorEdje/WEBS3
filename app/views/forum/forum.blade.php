@extends('layout/main')

@section('content')

	@foreach ($categories as $infoCategory)
		<div class="row">
			<div class="col-md-12 titleBlock bg-primary">
				{{ $infoCategory['category']->name }}
				<br><small>{{ $infoCategory['category']->description }}</small>
			</div>
		</div>
	
		<div class="row">
		
			@foreach ($infoCategory['subcategories'] as $infoSubcategory)
				<div class="col-md-3">
					<span class="categoryBlock">
						<div class="titleSubCategory">
							<a class="titleSubCategoryLink" href="{{ URL::route('forum-category',$infoSubcategory['id']) }}">{{  $infoSubcategory['name'] }}</a>
						</div>
					
						<div class="infoSubCategory">
							<p>
								@if ($infoSubcategory['description'] != null)
									{{ $infoSubcategory['description'] }}<br>
								@else
									This subcategory has no description.
								@endif
							</p>
							<p>
								Topics: {{ $infoSubcategory['amountOfTopics'] }}
								<span class="right">Replies: {{ $infoSubcategory['amountOfReplies'] }}</span>
							</p>
							<p>
								@if ($infoSubcategory['lastReply'] != 0) 
									Last Reply: {{ $infoSubcategory['lastReply'] }}
								@endif
							</p>
						</div>
					</span>
				</div>
			@endforeach
			
		</div>
		
	@endforeach

@stop