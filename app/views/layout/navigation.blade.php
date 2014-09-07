
<!-- Maakt het menu aan -->
<div class="row">
	<ul class="nav nav-pills">
		

		<li><a href="{{ URL::route('home') }}">Home</a></li>

		@if (!Auth::check())
		 	<li><a href="{{ URL::route('account-sign-in') }}">Login</a></li>

			<li><a href="{{ URL::route('account-create') }}">Register</a></li>
		@endif

		@if (Auth::check())
			<!-- Normal logged in menu here -->

		 	<li><a href="{{ URL::route('forum') }}">Forum</a></li>

			 	<li class="dropdown">
				<a href="{{ URL::route('profile-user-loggedin') }}">Account</a>
				<ul class="sub_navigation nav nav-pills">
					<li><a href="{{ URL::route('account-change-password') }}">Change password</a></li>
					<li><a href="{{ URL::route('profile-change') }}">Change profile</a></li>
				</ul>
			</li>

			@if(Auth::user()->isModerator())
				<!-- Moderator menu here -->
			@endif

		 	@if(Auth::user()->isAdmin())
		 		<!-- Admin menu here -->
		 		<li class="dropdown">
					<a href="">Website settings</a>
					<ul class="sub_navigation nav nav-pills">
						<li><a href="{{ URL::route('categories-manage') }}">Manage categories</a></li>
						<li><a href="{{ URL::route('permissions-manage') }}">Manage permissions</a></li>
						<li><a href="{{ URL::route('news-manage') }}">Manage news</a></li>
					</ul>
				</li>
		 	@endif

		 	<li><a href="{{ URL::route('account-sign-out') }}">Logout</a></li>

		 @endif
		
	</ul>
</div>