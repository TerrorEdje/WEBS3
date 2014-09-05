
<!-- Maakt het menu aan -->
<div class="row">
	<ul class="nav nav-pills">
		@if (Auth::check())
		 	<?php $rights = Auth::user()->rights_id; ?>
		@endif

		<li><a href="{{ URL::route('home') }}">Home</a></li>

		<li><a href="{{ URL::route('account-sign-in') }}">Login</a></li>

		<li><a href="{{ URL::route('account-create') }}">Register</a></li>

		<li class="dropdown">
			<a href="{{ URL::route('profile-user-loggedin') }}">Account</a>
			<ul class="sub_navigation nav nav-pills">
				<li><a href="{{ URL::route('account-change-password') }}">Change password</a></li>
				<li><a href="{{ URL::route('profile-change') }}">Change profile</a></li>
			</ul>
		</li>

		<li><a href="{{ URL::route('account-sign-out') }}">Logout</a></li>

		<li class="dropdown">
			<a href="">Website settings</a>
			<ul class="sub_navigation nav nav-pills">
				<li><a href="{{ URL::route('categories-manage') }}">Manage categories</a></li>
				<li><a href="{{ URL::route('permissions-manage') }}">Manage permissions</a></li>
				<li><a href="{{ URL::route('news-manage') }}">Manage news</a></li>
			</ul>
		</li>
	</ul>
</div>