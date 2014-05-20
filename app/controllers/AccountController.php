<?php

class AccountController extends BaseController {
	
	public function getCreate()
	{
		return View::make('account/create');
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
			return Redirect::route('account-create')->withErrors($validator)->withInput();
		}
		else
		{
			
			$email = Input::get('email');
			$username = Input::get('username');
			$password = Hash::make(Input::get('password'));
			
			//Activation code
			$code = str_random(60);
			
			$user = new User;
			$user->email = $email;
			$user->code = $code;
			$user->password = $password;
			$user->username = $username;
			$user->active=0;
			$user->lasttimeonline = date("Y-m-d H:i:s");
			$user->timesonline = 0;
			$user->rights_name = "user";
			$user->save();
			
			if ($user) {
			
				Mail::send('emails/activate', array('link' => URL::route('account-activate', $code), 'username' => $username), function($message) use ($user)
				{
					$message->to($user->email,$user->username)->subject('Activate your account');
				});
				
				return Redirect::route('home')->with('global','Your account has been created! We have sent you an email to activate your account.');
			}	
		}		
	}
	
	public function getActivate($code)
	{	
		$user = User::where('code','=',$code)->where('active','=',0);
		
		if ($user->count())
		{
			$user = $user->first();
			
			$user->active = 1;
			$user->code = '';
			
			if($user->save())
			{
				return Redirect::route('home')->with('global','Activated! You can now sign in!');
			}
			
		}
		
		return Redirect::route('home')->with('global','We could not activate your account. Try again later.');
	}
	
	public function getSignIn()
	{
		return View::make('account/signin');
	}

	public function postSignIn()
	{
		$validator = Validator::make(Input::all(),array(
				'email' => 'required:email',
				'password' => 'required'
		));
		
		if($validator->fails())
		{
			return Redirect::route('account-sign-in')->withErrors($validator)->withInput();
		}
		else
		{
			$remember = (Input::has('remember')) ? true : false;
			
			$user = array(
				'email' => Input::get('email'),
				'password' => Input::get('password'),
				'active' => 1
			);
			
			if(Auth::attempt($user,$remember))
			{
				return Redirect::intended('/');
			}
			else
			{
				return Redirect::route('account-sign-in')->with('global','Email or password wrong, or account not activated.');
			}
		}
		return Redirect::route('account-sign-in')->with('global','There was a problem signing you in.');		
	}
	
	public function getSignOut()
	{
		Auth::logout();
		return Redirect::route('home');
	}
	
	public function getChangePassword()
	{
		return View::make('account/password');
	}
	
	public function postChangePassword()
	{
		$validator = Validator::make(Input::all(),
			array(
				'old_password' => 'required',
				'password' => 'required|min:6',
				'password_again' => 'required|same:password'
			)
		);
		
		if ($validator->fails())
		{
			return Redirect::route('account-change-password')->withErrors($validator);
		}
		else
		{
			$user = User::find(Auth::user()->id);
			
			$old_password = Input::get('old_password');
			$password = Input::get('password');
			
			if (Hash::check($old_password,$user->getAuthPassword()))
			{
				$user->password = Hash::make($password);
				
				if($user->save())
				{
					return Redirect::route('home')->with('global','Your password has been changed.');
				}
			}
			else
			{
				return Redirect::route('account-change-password')->with('global','Your old password is incorrect.');
			}
		}		
		return Redirect::route('account-change-password')->with('global','Your password could not be changed.');
	}
}

?>

