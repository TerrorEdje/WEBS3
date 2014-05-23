<?php

class ProfileController extends BaseController {
	
	public function user($username)
	{
		$user = User::where('username','=',$username);
		
		if($user->count())
		{
			$user = $user->first();
			return View::make('profile/user')->with('user',$user);
		}
		
		return Redirect::route('home')->with('global','This user can not be found.');
	}

	public function getChangeProfile()
	{
		$user = User::where('username','=',Auth::user()->username);

		if ($user->count())
		{
			$user = $user->first();
			return View::make('profile/changeprofile')->with('user',$user);
		}

		return Redirect::route('home')->with('global','Could not change your profile.');
	}
}

?>

