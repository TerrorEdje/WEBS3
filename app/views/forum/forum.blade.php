@extends('layout/main')

@section('content')

	<!-- Toont voor elke hoofdcategorie de subcategorieën -->
	@foreach ($categories as $infoCategory)
		<div class="row">
			<div class="col-md-12 titleBlock bg-primary">
				{{ $infoCategory['category']->name }}
				<br><small>{{ $infoCategory['category']->description }}</small>
			</div>
		</div>
	
		<div class="row">
		
			<!-- Toont voor elke subcategorie van een hoofdcategorie -->
			@foreach ($infoCategory['subcategories'] as $infoSubcategory)
				<div class="col-md-3 categoryBlock">
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
								<a href="#" onclick="addToFavorites({{$infoSubcategory['id']}})">Add to favorites <span class="glyphicon glyphicon-heart"></span></a>
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
				</div>
			@endforeach
			
		</div>
		
	@endforeach

@stop