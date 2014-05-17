
<h1>Categories</h1>	

@foreach ($categories as $infoCategory)
	{{ $infoCategory['category']->name }}<br/>

	@foreach ($infoCategory['subcategories'] as $infoSubcategory)
		{{ link_to_route('topics', $infoSubcategory['name'] , array('name' => $infoSubcategory['name'] )) }}
		Aantal topics: {{ $infoSubcategory['amountOfTopics'] }} 
		Aantal reacties: {{ $infoSubcategory['amountOfReplies'] }}
		@if ($infoSubcategory['lastReply'] == 0) 
			Laatste reactie: -<br/>
		@else
			Laatste reactie: {{ $infoSubcategory['lastReply'] }}<br/>
		@endif
	@endforeach
	<br/>
@endforeach