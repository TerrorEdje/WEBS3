@extends('layout/main')

@section('content')

	<div class="col-md-12 titleBlock bg-primary">
		Permissons
	</div>
	
	<div class="col-md-12 form">
	
		{{ Form::open(array('route' => array('manage-permissons-post'))) }}
			
			{{ Form::hidden('amountOfUsers', count($users)) }}
			<table class="col-sm-12">
				<?php $index = 0; ?>
				@foreach($users as $user)
					<tr>
						<td class="col-sm-1">
							{{ $user->username }}
							{{ Form::hidden('userid'. $index,$user->id) }}
						</td>
						<td class="col-sm-11 tableTD">
							{{Form::select('right' . $index, $rights, $user['rights_id'], array('class' => 'selectbox')) }}
						</td>
					</tr>
					<?php $index++; ?>
				@endforeach
			</table>
			
			{{ Form::submit('Update permissions', array('class' => 'btn-primary button')) }}
			
		{{ Form::token() }}	
		{{ Form::close() }}	
		
		<br>
		
		<small>This list does not show yourself, to protect the site from losing all admins.</small>

	</div>
	
@stop