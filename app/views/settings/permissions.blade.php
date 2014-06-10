@extends('layout/main')

@section('content')
	{{ Form::open(array('route' => array('manage-permissons-post'))) }}
		{{ Form::hidden('amountOfUsers',count($users)) }}
		<table>
		<?php $index = 0; ?>
		@foreach($users as $user)
			<tr>
				<td>
					{{ $user->username }}
					{{ Form::hidden('userid'. $index,$user->id) }}
				</td>
				<td>
					{{Form::select('right' . $index,$rights, $user['rights_id']) }}
				</td>
			</tr>
			<?php $index++; ?>
		@endforeach
		</table>
		{{ Form::submit('Update permissions', array('class' => 'btn-primary button')) }}
		{{ Form::token() }}	
	{{ Form::close() }}	
	<small>This list does not show yourself, to protect the site from losing all admins.</small>
@stop