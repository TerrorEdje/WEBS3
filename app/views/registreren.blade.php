<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Registreren</title>
</head>
<body>
	<div>
		<h1>Registreren pagina</h1>
		{{ Form::open(array('route' => 'registreren2')) }}
		Gebruikersnaam: {{ Form::text('gebruikersnaam'); }}</br>
		Email: {{ Form::text('email'); }}</br>
		Herhaal email: {{ Form::text('email2'); }}</br>
		Wachtwoord: {{ Form::password('wachtwoord'); }}</br>
		Herhaal wachtwoord: {{ Form::password('wachtwoord2'); }}</br>
		{{ Form::submit('Registreren') }}
		{{ Form::close() }}
	</div>
</body>
</html>