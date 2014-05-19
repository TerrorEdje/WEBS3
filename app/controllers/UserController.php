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
			
				Mail::send('emails/activate', array('link' => URL::route('user-activate', $code), 'username' => $username), function($message) use ($user)
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
		return View::make('user/signin');
	}

	public function postSignIn()
	{
		$validator = Validator::make(Input::all(),array(
				'email' => 'required|email',
				'password' => 'required'
		));
		
		if($validator->fails())
		{
			return Redirect::route('user-sign-in')->withErrors($validator)->withInput();
		}
		else
		{
			$auth = Auth::attempt(array(
				'email' => Input::get('email'),
				'password' => Input::get('password'),
				'active' => 1
			));
			
			if ($auth)
			{
				//return View::make('home');
				return Redirect::intended('/');
			}
			else
			{
				return Redirect::route('user-sign-in')->with('global','Email or password wrong, or account not activated.');
			}
		}
		return Redirect::route('user-sign-in')->with('global','There was a problem signing you in.');		
	}
}

?>

