<div class="row">
	<ul class="nav nav-pills">
		<li><a href="{{ URL::route('home') }}">Home</a></li>		
		@if(Auth::check())
			<li><a href="{{ URL::route('forum') }}">Forum</a></li>
			<li><a href="{{ URL::route('account-sign-out') }}">Sign out</a></li>
			<li><a href="{{ URL::route('account-change-password') }}">Change password</a></li>
		@else
			<li><a href="{{ URL::route('account-sign-in') }}">Login</a></li>
			<li><a href="{{ URL::route('account-create') }}">Register</a></li>
			<li><a href="{{ URL::route('account-forgot-password') }}">Forgot password</a></li>
		@endif
	</ul>
</div>