@extends('layout/main')

@section('content')

	<br>
	
	@foreach ($categories as $infoCategory)
	
		<div class="col-md-12 titleBlock bg-primary">
			{{ $infoCategory['category']->name }}
		</div>
	
		<div class="row">
		
			@foreach ($infoCategory['subcategories'] as $infoSubcategory)
				<div class="col-md-3">
					<span class="categoryBlock">
						<div class="titleSubCategory">
							<a class="titleSubCategoryLink" href="{{ URL::route('forum-category',$infoSubcategory['name']) }}">{{  $infoSubcategory['name'] }}</a>
						</div>
					
						<div class="infoSubCategory">
							<p>
								{{ $infoSubcategory['description'] }}<br>
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