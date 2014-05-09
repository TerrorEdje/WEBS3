<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Inloggen</title>
</head>
<body>
	<div>
		<h1>Inloggen pagina</h1>
		@if (isset($bericht))
		{{ $bericht }}
		@endif
		{{ Form::open(array('route' => array('inloggen2'))) }}
		Gebruikersnaam: {{ Form::text('gebruikersnaam'); }}</br>
		Wachtwoord: {{ Form::password('wachtwoord'); }}</br>
		{{ Form::submit('Inloggen') }}
		{{ Form::close() }}
	</div>
</body>
</html>