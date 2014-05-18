<div class="row">
	<ul class="nav nav-pills">
		<li><a href="home">Home</a></li>
		<li><a href="#">Forum</a></li>
		
		@if(Auth::check())
		
		@else
			<li><a href="{{ URL::route('user-create') }}">Register</a></li>
		@endif
	</ul>
</div>