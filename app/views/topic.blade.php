<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Topic</title>
</head>
<body>
	<div>
		<h1>Topic pagina</h1>
	</div>
	<div>
		<h3>{{ $topic->titel }}</h3>	
		<table>
			<tr>
				<td>{{ $topic->gebruikersnaam }}</td>
				<td>{{ $topic->datum_tijd }}</td>
			</tr>
			<tr>
				<td></td>
				<td>{{ $topic->inhoud }}</td>
			</tr>
		</table>
	</div>	
	<br/>
	<br/>
	<br/>
	<div>
		@foreach ($reacties as $reactie)
		<table>
			<tr>
				<td>{{ $reactie->gebruikersnaam }}</td>
				<td>{{ $reactie->datum_tijd }}</td>
			</tr>
			<tr>
				<td></td>
				<td>{{ $reactie->inhoud }}</td>
			</tr>
		</table>
		@endforeach
	</div>
	<br/>
	<br/>
	<br/>
	<div>
		{{ Form::open(array('route' => array('topic2', $topic->id))) }}
		Reactie:</br>
		{{ Form::textarea('inhoud') }}</br>
		Gebruikersnaam: {{ Form::text('gebruikersnaam') }}</br>
		{{ Form::submit('Plaats reactie') }}
		{{ Form::close() }}
	</div>
</body>
</html>