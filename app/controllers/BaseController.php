<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$menus = Menu::all();
			echo "hoi";
			$this->layout = View::make($this->layout)->with('menus',$menus);
		}
	}

}
