
<h1>Categories</h1>	

@foreach ($categories as $infoCategory)
	{{ $infoCategory['category']->name }}<br/>

	@foreach ($infoCategory['subcategories'] as $infoSubcategory)
		{{ $infoSubcategory['name'] }} Aantal topics: {{ $infoSubcategory['numberOfTopics'] }}<br/>
	@endforeach
	<br/>
@endforeach