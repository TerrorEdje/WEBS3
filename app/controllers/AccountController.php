<?php

class AccountController extends BaseController {
	
	# Maakt de view aan voor het registeren van een gebruiker
	public function getCreate()
	{
		Breadcrumb::addbreadcrumb('Home','../');
		Breadcrumb::addbreadcrumb('Register');
		$data = array ( 'breadcrumbs' => Breadcrumb::generate() );
		return View::make('account/create',$data);
	}
	
	# Voegt de gebruiker toe aan de database
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
			
			# Activation code
			$code = str_random(60);
			
			$user = new User;
			$user->email = $email;
			$user->code = $code;
			$user->password = $password;
			$user->username = $username;
			$user->active=0;
			$user->lasttimeonline = date("Y-m-d H:i:s");
			$user->timesonline = 0;
			$user->rights_id = 1;
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
	
	# Aciveert een gebruiker
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
	
	# Maakt de view aan voor het inloggen van een gebruiker
	public function getSignIn()
	{
		Breadcrumb::addbreadcrumb('Home','../');
		Breadcrumb::addbreadcrumb('Login');
		$data = array ( 'breadcrumbs' => Breadcrumb::generate() );
		return View::make('account/signin',$data);
	}

	# Voor het inloggen van een gebruiker
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
				$useronline = User::where('email','=',Input::get('email'));
				if($useronline->count())
				{
					$useronline = $useronline->first();
					$useronline->timesonline = $useronline->timesonline + 1;
					$useronline->lasttimeonline = new DateTime('NOW');
					$useronline->save();
				}
				
				return Redirect::intended('/');
			}
			else
			{
				return Redirect::route('account-sign-in')->with('global','Email or password wrong, or account not activated.');
			}
		}
		return Redirect::route('account-sign-in')->with('global','There was a problem signing you in.');		
	}
	
	# Voor het uitloggen van een gebruiker
	public function getSignOut()
	{
		Auth::logout();
		return Redirect::route('home');
	}
	
	# Maakt de view aan voor het veranderen van het wachtwoord van een gebruiker
	public function getChangePassword()
	{
		Breadcrumb::addbreadcrumb('Home','../');
		Breadcrumb::addbreadcrumb('Change Password');
		$data = array ( 'breadcrumbs' => Breadcrumb::generate() );
		return View::make('account/password',$data);
	}
	
	# Zet het nieuwe wachtwoord in de database
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
	
	# Maakt de view aan voor als een gebruiker zijn of haar wachtwoord is vergeten
	public function getForgotPassword()
	{
		Breadcrumb::addbreadcrumb('Home','../');
		Breadcrumb::addbreadcrumb('Forgot password');
		$data = array ( 'breadcrumbs' => Breadcrumb::generate() );
		return View::make('account/forgot');
	}
	
	# Geeft de gebruiker een nieuw wachtwoord
	public function postForgotPassword()
	{
		$validator = Validator::make(Input::all(),
			array(
				'email' => 'required|email'
			)
		);
		
		if($validator->fails())
		{
			return Redirect::route('account-forgot-password')->withErrors($validator)->withInput();
		}
		else
		{
			$user = User::where('email','=',Input::get('email'));
			
			if($user->count())
			{
				$user = $user->first();
				
				$code = str_random(60);
				$password = str_random(10);
				
				$user->code = $code;
				$user->password_temp = Hash::make($password);
				
				if($user->save())
				{
					Mail::send('emails/forgot', array('link' => URL::route('account-recover',$code), 'username' => $user->username, 'password' => $password), function($message) use ($user)
					{
						$message->to($user->email,$user->username)->subject('Your new password');
					});
					
					return Redirect::route('home')->with('global','We have sent you a new password by email.');
				}
			}
		}
		
		return Redirect::route('account-forgot-password')->with('global','Could not request new password.');
	}
	
	# Voor het veranderen van het wachtwoord
	public function getRecover($code)
	{
		$user = User::where('code','=',$code)->where('password_temp','!=','');
		
		if($user->count())
		{
			$user = $user->first();
			
			$user->password = $user->password_temp;
			$user->password_temp = '';
			$user->code = '';
			
			if($user->save())
			{
				return Redirect::route('home')->with('global','Your account has been recovered and you can now sign in with your new password.');
			}
		}
		
		return Redirect::route('home')->with('global','Could not recovery your account.');
	}

	# Maakt de view aan voor het beheren van de rechten van gebruikers
	public function getManagePermissions()
	{
		$prepareusers = User::orderBy('username')->get();
		$users = array();
		if (Auth::check())
		{
			foreach($prepareusers as $user)
			{
				if ($user->id != Auth::user()->id)
				{
					array_push($users,$user);
				}
			}
		}
		$rights = Right::lists('name','id');

		Breadcrumb::addbreadcrumb('Home','../');
		Breadcrumb::addbreadcrumb('Manage permissions');
		$data = array ( 'breadcrumbs' => Breadcrumb::generate() );
		return View::make('settings/permissions',$data)->with('rights',$rights)->with('users',$users);
	}

	# Zet de rechten van de gebruikers in de database
	public function postPermissions()
	{
		$validator = Validator::make(Input::all(),
			array(
				'amountOfUsers' => 'required'
			)
		);
		
		if($validator->fails())
		{
			return Redirect::route('manage-permissions')->withErrors($validator)->withInput();
		}
		else
		{
			for($i = 0; $i < Input::get('amountOfUsers'); $i++)
			{
				$currentUserId = Input::get('userid'.$i);
				$user = User::find( $currentUserId );
				$user->rights_id = Input::get('right'.$i);
				$user->save();
			}

			return Redirect::route('home')->with('global','Updated permissions.');
		}
		return Redirect::route('home')->with('global','Updating permissions failed.');

	}
}

?>

