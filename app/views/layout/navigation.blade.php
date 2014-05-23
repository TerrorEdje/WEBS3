<div class="row">
	<ul class="nav nav-pills">
		<li><a href="{{ URL::route('home') }}">Home</a></li>		
		@if(Auth::check())
			<li><a href="{{ URL::route('forum') }}">Forum</a></li>
			<li class="dropdown"><a href="{{ URL::route('profile-user',Auth::user()->username) }}">Account</a>
				<ul class="sub_navigation">
					<li><a class="dropdownlink" href="{{ URL::route('account-change-password') }}">Change password</a></li>
					<li><a class="dropdownlink" href="{{ URL::route('profile-change') }}">Change profile</a></li>
				</ul>
			</li>
			<li><a href="{{ URL::route('account-change-password') }}">Change password</a></li>
			<li><a href="{{ URL::route('account-sign-out') }}">Sign out</a></li>
		@else
			<li><a href="{{ URL::route('account-sign-in') }}">Login</a></li>
			<li><a href="{{ URL::route('account-create') }}">Register</a></li>
		@endif
	</ul>
</div>