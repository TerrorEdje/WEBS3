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

	public function __construct()
	{
		$mainmenus = Menu::where('parent','=',NULL)->get();
		//var_dump($mainmenus);
		$submenus = Menu::where('parent','>','1')->get();
		$subcategorys = Subcategory::all();

		View::share('fsubcategorys',$subcategorys);
		View::share('menus',$mainmenus);
		View::share('submenus',$submenus);
	}
}
