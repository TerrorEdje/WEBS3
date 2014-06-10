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
				'picture' => 'image',
			)
		);
		
		if($validator->fails())
		{
			return Redirect::route('profile-change')->withErrors($validator)->withInput();
		}
		else
		{
			if (Auth::check())
			{
				$user = Auth::user();
				$user = $user->first();
				$user->signature = Input::get('signature');
				if (Input::hasFile('picture'))
				{
					$file = Input::file('picture');
					$destinationPath= 'uploads';
					$filename = str_random(12);
					$extension = $file->getClientOriginalExtension();
					$upload_success = $file->move($destinationPath,$filename. "." . $extension);
					$user->image = $filename . "." .$extension;
					$user->save();
					return Redirect::route('home')->with('global','Image and signature updated!');
				}
				$user->save();
				return Redirect::route('home')->with('global','Signature updated!');
			}
		}
		return Redirect::route('home')->with('global','Failed updating your profile');
	}

	public function loggedInUser()
	{
		if (Auth::check())
			$user = Auth::user();
		
		if(isset($user))
		{
			return View::make('profile/user')->with('user',$user);
		}
		
		return Redirect::route('home')->with('global','This user can not be found.');
	}
}

?>

