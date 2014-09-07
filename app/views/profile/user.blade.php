@extends('layout.main')

@section('content')

	<div class="col-md-12 titleBlock bg-primary">
		Profile
	</div>
	
	<!-- Toont de gegevens van profiel van een gebruiker -->
	<div>
		<table class="col-md-12 profileTable">
			<tr>
				<td colspan="2" class="col-md-7 tableTD">
					<span class="profileUsername">{{ $user->username }}</span><br>
					{{ $user->rankTitle() }}
				</td>
				<td class="col-md-2 profileTabelDateTD">
					Last time online:<br>
					Times online:
				</td>
				<td class="col-md-3 tableTD">
					{{ date("D d M Y", strtotime($user->lastLogin())), ' at ', date("H:i", strtotime($user->lastLogin())) }}<br> 
					{{ $user->timesOnline() }}
				</td>
			</tr>
			<tr>
				<td class="col-md-2 tableTD">{{ HTML::image('uploads/' . $user->image,'Image', array('width' => '100', 'height' => '100'))}}</td>
				<td colspan="3" class="col-md-10 tableTD">
					@if ($user->description != null)
						{{ nl2br($user->description) }}
					@else
						There is no description.
					@endif
				</td>
			</tr>
		</table>
	</div>

@stop