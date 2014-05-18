<?php

class UserController extends BaseController {
	
	public function getCreate()
	{
		return View::make('user/create');
	}
	
	public function postCreate()
	{
		$validator = Validator::make(Input::all(),
			array(
				'email' => 'required|max:50|email|unique:users',
				'username' => 'required|max:20|min:3|unique:users',
				'password' => 'required|min:6',
				'password_again' => 'required|same:password'
			)
		);
		
		if($validator->fails())
		{
			return Redirect::route('user-create')->withErrors($validator)->withInput();
		}
		else
		{
			//Create account
		}
		
	}

}
//https://www.youtube.com/watch?v=RXV4fe1CALw&list=PLfdtiltiRHWGf_XXdKn60f8h9jjn_9QDp&index=8
?>

