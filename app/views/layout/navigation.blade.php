<div class="row">
	<ul class="nav nav-pills">
		@if(Auth::check())
			<?php $user = Auth::user() ?>
		@endif
		@foreach($menus as $menu)
			{{--@if ($user->rights_id == $menu->rights_id)--}}
				<li class="dropdown">
					<a href="{{{isset($menu->link) ? URL::route($menu->link) : '#'}}}" >
						{{ $menu->name }}
					</a>
					<ul class="sub_navigation nav nav-pills">
						@foreach($submenus as $submenu)
							@if ($submenu->parent == $menu->id)
								<li>
									<a class="dropdownlink" href="{{{isset($submenu->link) ? URL::route($submenu->link) : '#'}}}">
										{{ $submenu->name }}
									</a>
								</li>
							@endif
						@endforeach
					</ul>
				</li>
			{{--@endif--}}
		@endforeach
		<li><a href="{{ URL::route('home') }}">Home</a></li>		
		@if(Auth::check())
			<li><a href="{{ URL::route('forum') }}">Forum</a></li>
			<li class="dropdown"><a href="{{ URL::route('profile-user',Auth::user()->username) }}">Account</a>
				<ul class="sub_navigation nav nav-pills">
					<li><a class="dropdownlink" href="{{ URL::route('account-change-password') }}">Change password</a></li>
					<li><a class="dropdownlink" href="{{ URL::route('profile-change') }}">Change profile</a></li>
				</ul>
			</li>
			<li class="dropdown"><a href="#">Settings</a>
				<ul class="sub_navigation nav nav-pills">
					<li><a class="dropdownlink" href="{{ URL::route('categories-manage') }}">Manage categories</a></li>
				</ul>
			</li>
			<li><a href="{{ URL::route('account-sign-out') }}">Sign out</a></li>
		@else
			<li><a href="{{ URL::route('account-sign-in') }}">Login</a></li>
			<li><a href="{{ URL::route('account-create') }}">Register</a></li>
		@endif
	</ul>
</div>