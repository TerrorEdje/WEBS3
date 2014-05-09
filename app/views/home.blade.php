<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Categorieen</title>
</head>
<body>
	<div>
		<h1>Categorieen pagina</h1>	
		@foreach ($categorieen as $infoCategorie)
		<table>
			<tr>
				<th>{{ link_to_route('topics', $infoCategorie['hoofdcategorie']->naam, array('id' => $infoCategorie['hoofdcategorie']->id)) }}</th>
				<th>Aantal topics</th>
				<th>Aantal reacties</th>
				<th>Laatste reactie</th>
			</tr>
			@foreach ($infoCategorie['subcategorieen'] as $infoSubcategorie)
			<tr>
				<td>{{ link_to_route('topics', $infoSubcategorie['subcategorie']->naam, array('id' => $infoSubcategorie['subcategorie']->id)) }}</td>
				<td>{{ $infoSubcategorie['aantalTopics'] }}</td>
				<td>{{ $infoSubcategorie['aantalReacties'] }}</td>
				@if ($infoSubcategorie['laatsteReactie'] == 0) 
					<td>-</td>
				@else
					
					<td>{{ $infoSubcategorie['laatsteReactie'] }}</td>
				@endif
			</tr>
			@endforeach
		</table>
		<br/>
		@endforeach
	</div>	
</body>
</html>