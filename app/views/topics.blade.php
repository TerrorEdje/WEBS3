<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Topics</title>
</head>
<body>
	<div>
		<h1>Topics pagina</h1>
		<table>
			@if ($openTopics == null)
				<tr><th>Actieve topics</th>
				<tr><td>Er zijn op dit moment geen actieve topics.</td>
			@else
				<tr>
					<th>Actieve topics</th>
					<th>Topic starter</th>
					<th>Aantal reacties</th>
					<th>Laatste reactie</th>
				</tr>
				@foreach ($openTopics as $infoOpenTopic)
				<tr>
					<td>{{ link_to_route('topic', $infoOpenTopic['topic']->titel, array('id' => $infoOpenTopic['topic']->id)) }}</td>
					<td>{{ $infoOpenTopic['topic']->gebruikersnaam }}</td>
					<td>{{ $infoOpenTopic['aantalReacties'] }}</td>
					@if ($infoOpenTopic['laatsteReactie'] == 0) 
						<td>-</td>
					@else
						<td>{{ $infoOpenTopic['laatsteReactie'] }}</td>
					@endif
				</tr>
				@endforeach
			@endif
		</table>
		<br/>
		<table>
			@if ($geslotenTopics == null)
				<tr><th>Gesloten topics</th>
				<tr><td>Er zijn op dit moment geen gesloten topics.</td>
			@else
				<tr>
					<th>Gesloten topics</th>
					<th>Topic starter</th>
					<th>Aantal reacties</th>
					<th>Laatste reactie</th>
				</tr>
				@foreach ($geslotenTopics as $infoGeslotenTopic)
				<tr>
					<td>{{ link_to_route('topic', $infoGeslotenTopic['topic']->titel, array('id' => $infoGeslotenTopic['topic']->id)) }}</td>
					<td>{{ $infoGeslotenTopic['topic']->gebruikersnaam }}</td>
					<td>{{ $infoGeslotenTopic['aantalReacties'] }}</td>
					@if ($infoGeslotenTopic['laatsteReactie'] == 0) 
						<td>-</td>
					@else
						<td>{{ $infoGeslotenTopic['laatsteReactie'] }}</td>
					@endif
				</tr>
				@endforeach
			@endif
		</table>
	</div>	
</body>
</html>