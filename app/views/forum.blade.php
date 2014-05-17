
<h1>Categories</h1>	

@foreach ($categories as $infoCategory)
	
	<div>
	
		<div>
			{{ $infoCategory['category']->name }}<br/>
		</div>
		
		<div>
			<span>Topics</span>
			<span>Replies</span>
			<span>Last reply</span>
		</div>

		<div>
			@foreach ($infoCategory['subcategories'] as $infoSubcategory)
				<span> {{ link_to_route('topics', $infoSubcategory['name'] , array('name' => $infoSubcategory['name'] )) }} </span>
				<span> {{ $infoSubcategory['amountOfTopics'] }} </span>
				<span> {{ $infoSubcategory['amountOfReplies'] }} </span>
				@if ($infoSubcategory['lastReply'] == 0) 
					<span> - </span>
				@else
					<span> {{ $infoSubcategory['lastReply'] }} </span>
				@endif
				<br/>
			@endforeach
		</div>
	
	</div>
	
	<br/>
	
@endforeach