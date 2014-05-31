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
		$validator = Validator::make(Input::all(),
			array(
				'image' => 'image',
			)
		);
		
		if($validator->fails())
		{
			return Redirect::route('profile-change')->withErrors($validator)->withInput();
		}
		else
		{
			$user = User::where('username','=',Auth::user()->username);

			if ($user->count())
			{
				$user = $user->first();
				$user->signature = Input::get('signature');
				$image = Input::file('image');
				if (isset($image))
				{
					$destinationPath= 'uploads';
					$filename = str_random(12);
					$extension = $image->getClientOriginalExtension();
					$upload_success = Input::file('image')->move($destinationPath,$filename. "." . $extension);
					$user->image = $filename . "." .$extension;
				}
				$user->save();
				return Redirect::route('home')->with('global','Profile updated!');
			}
		}
		return Redirect::route('home')->with('global','Failed updating your profile');
	}
}

?>

