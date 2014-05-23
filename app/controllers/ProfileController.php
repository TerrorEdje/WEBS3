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

	public function postChangeProfile()
	{
		$image = Input::file('image');
		$destinationPath= 'uploads';
		$filename = str_random(12);
		$extension = $image->getClientOriginalExtension();
		$upload_success = Input::file('image')->move($destinationPath,$filename. "." . $extension);


		if($upload_success)
		{
			return Redirect::route('home')->with('global','Profile updated!');
		}
		else
		{
			return Redirect::route('home')->with('global','Failed uploading the file.');
		}
		return Redirect::route('home')->with('global','Failed updating your profile');
	}
}

?>

