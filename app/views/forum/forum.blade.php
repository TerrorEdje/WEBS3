@extends('layout/main')

@section('content')

	<br>
	
	@foreach ($categories as $infoCategory)
	
		<div class="titleMainCategory">
			{{ $infoCategory['category']->name }}
		</div>
	
		<div class="row">
		
			@foreach ($infoCategory['subcategories'] as $infoSubcategory)
				<div class="col-md-3 categoryBlock">
					<div class="titleSubCategory">
						{{ link_to_route('forum-category', $infoSubcategory['name'] , array('name' => $infoSubcategory['name'] )) }}
					</div>
					<div>
						<p>
							{{ $infoSubcategory['description'] }}<br>
						</p>
						<p>
							Topics: {{ $infoSubcategory['amountOfTopics'] }}
							<span class="right">Replies: {{ $infoSubcategory['amountOfReplies'] }}</span>
						</p>
						<p>
							@if ($infoSubcategory['lastReply'] != 0) 
								Last Reply:<br>
								{{ $infoSubcategory['lastReply'] }}
							@endif
						</p>
					</div>
				</div>
			@endforeach
			
		</div>
		
		<br/>
		
	@endforeach

@stop