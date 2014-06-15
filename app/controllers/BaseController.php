<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if (! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	# Maakt het menu aan boven in de pagina's
	public function __construct()
	{
		$mainmenus = Menu::where('parent','=',NULL)->get();
		$submenus = Menu::where('parent','>','1')->get();
		$subcategorys = Subcategory::all();

		View::share('fsubcategorys',$subcategorys);
		View::share('menus',$mainmenus);
		View::share('submenus',$submenus);
	}
}
