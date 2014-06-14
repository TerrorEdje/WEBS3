@extends('layout/main')

@section('content')

	<div class="col-md-12 titleBlock bg-primary">
		Permissons management
	</div>
	
	<div class="col-md-12 form">

		<input type="text" name="search-criteria" id="search-criteria" />
		
		<br>
	
		{{ Form::open(array('route' => array('manage-permissons-post'))) }}
			
			{{ Form::hidden('amountOfUsers', count($users)) }}
			
			<table class="col-sm-12">
				<?php $index = 0; ?>
				@foreach($users as $user)
					<tr class="user">
						<td class="col-sm-2">
							{{ $user->username }}
							{{ Form::hidden('userid'. $index,$user->id) }}
						</td>
						<td class="col-sm-10 tableTD">
							{{Form::select('right' . $index, $rights, $user['rights_id'], array('class' => 'selectbox')) }}
						</td>
					</tr>
					<?php $index++; ?>
				@endforeach
				<tr style="display:none;" id="noresults"> 
					<td>No username that start with "<span id="searchtext"></span>"</td> 
				</tr>
			</table>
			
			<br>
			
			<div class="col-sm-12">
				{{ Form::submit('Update permissions', array('class' => 'btn-primary button')) }}<br><br>
				<small>This list does not show yourself, to protect the site from losing all admins.</small>
			</div>
			
		{{ Form::token() }}	
		{{ Form::close() }}	

	</div>
	
@stop