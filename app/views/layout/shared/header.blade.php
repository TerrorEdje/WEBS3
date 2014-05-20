<div class="row">
	<ul class="nav nav-pills">
		<li><a href="{{ URL::route('home') }}">Home</a></li>
		<li><a href="#">Forum</a></li>
		
		@if(Auth::check())
			<li>Hoi hoi</li>
		@else
			<li><a href="{{ URL::route('user-sign-in') }}">Login</a></li>
			<li><a href="{{ URL::route('user-create') }}">Register</a></li>
		@endif
	</ul>
</div>