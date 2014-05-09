
<h1>Categories</h1>	

@foreach ($categories as $infoCategorie)
	{{ $infoCategorie['categorie']->name }}<br/>

	@foreach ($infoCategorie['subcategories'] as $subcategorie)
		{{ $subcategorie['name']}}<br/>
	@endforeach
	<br/>
@endforeach