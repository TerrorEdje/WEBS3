
<h1>Categories</h1>	

@foreach ($categories as $infoCategory)
	{{ $infoCategory['category']->name }}<br/>

	@foreach ($infoCategory['subcategories'] as $infoSubcategory)
		{{ $infoSubcategory['name'] }} 
		Aantal topics: {{ $infoSubcategory->getAmountOfTopics() }} 
		Aantal reacties: {{ $infoSubcategory->getAmountOfReplies() }}
		@if ($infoSubcategory->getLastReply() == 0) 
			Laatste reactie: -<br/>
		@else
			Laatste reactie: {{ $infoSubcategory->getlastReply() }}<br/>
		@endif
	@endforeach
	<br/>
@endforeach