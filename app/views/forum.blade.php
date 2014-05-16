
<h1>Categories</h1>	

@foreach ($categories as $infoCategory)
	{{ $infoCategory['category']->name }}<br/>

	@foreach ($infoCategory['subcategories'] as $infoSubcategory)
		{{ $infoSubcategory['name'] }} Aantal topics: {{ $infoSubcategory->getAmountOfTopics(); }}<br/>
	@endforeach
	<br/>
@endforeach