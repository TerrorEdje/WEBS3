@extends('layout.main')

@section('content')

	<div class="col-md-12 titleBlock bg-primary">
		Profile
	</div>
	
	<div>
		<table class="col-md-12 profileTable">
			<tr>
				<td colspan="2" class="col-md-8 tableTD">
					<span class="profileUsername">{{ $user->username }}</span><br>
					{{ $user->signature }}
				</td>
				<td class="col-md-2 profileTabelDateTD">
					Last time online:<br>
					Times online:
				</td>
				<td class="col-md-2 tableTD">
					{{ date("D d M Y", strtotime($user->lasttimeonline)), ' at ', date("H:i", strtotime($user->lasttimeonline)) }}<br> 
					{{ $user->timesonline }}
				</td>
			</tr>
			<tr>
				<td class="col-md-2 tableTD">{{ HTML::image('uploads/' . $user->image,'Image', array('width' => '100', 'height' => '100'))}}</td>
				<td colspan="3" class="col-md-10 tableTD">{{ nl2br($user->description) }}</td>
			</tr>
		</table>
	</div>

@stop