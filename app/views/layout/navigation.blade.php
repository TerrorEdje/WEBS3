<div class="row">
	<ul class="nav nav-pills">
		@foreach($menus as $menu)
			<?php $rights = 0; ?>
			@if (Auth::check())
				<?php $rights = Auth::user()->rights_id; ?>
			@endif
			@if (($rights >= $menu->rights_id && $menu->rights_id >= 1 ) || ($menu->rights_id == 0 && $rights == $menu->rights_id))
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
			@endif
		@endforeach
	</ul>
</div>