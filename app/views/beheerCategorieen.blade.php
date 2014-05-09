<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Categorieen beheren</title>
</head>
<body>
	<div>
		<h1>Categorieen beheren pagina</h1>	
		<table>
		@foreach ($categorieen as $infoCategorie)
			<tr>
				<td>{{ $infoCategorie['hoofdcategorie']->naam }}</td>
				<td></td>
				<td>{{ link_to_route('categorieVerwijderen', 'Verwijderen', array('id' => $infoCategorie['hoofdcategorie']->id)) }}</td>
				<td>{{ link_to_route('categorieWijzigen', 'Wijzigen', array('id' => $infoCategorie['hoofdcategorie']->id)) }}</td>
			</tr>
			@foreach ($infoCategorie['subcategorieen'] as $subcategorie)
			<tr>
				<td></td>
				<td>{{ $subcategorie->naam }}</td>
				<td>{{ link_to_route('categorieVerwijderen', 'Verwijderen', array('id' => $subcategorie->id)) }}</td>
				<td>{{ link_to_route('categorieWijzigen', 'Wijzigen', array('id' => $subcategorie->id)) }}</td>
			</tr>
			@endforeach
		@endforeach
		</table>
	</div>	
</body>
</html>