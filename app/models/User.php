<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the token value for the "remember me" session.
	 *
	 * @return string
	 */
	public function getRememberToken()
	{
		return $this->remember_token;
	}

	/**
	 * Set the token value for the "remember me" session.
	 *
	 * @param  string  $value
	 * @return void
	 */
	public function setRememberToken($value)
	{
		$this->remember_token = $value;
	}

	/**
	 * Get the column name for the "remember me" token.
	 *
	 * @return string
	 */
	public function getRememberTokenName()
	{
		return 'remember_token';
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

	public function isAdmin()
	{ 
		$rank = Rank::find($this->ranks_id);
		if ($rank->admin == 1)
		{
			return true;
		}
		return false;
	}

	public function isModerator()
	{ 
		$rank = Rank::find($this->ranks_id);
		if ($rank->moderator == 1)
		{
			return true;
		}
		return false;
	}

	public function checkAccessReply($id)
	{
		$reply = Reply::find($id);
		if (Auth::check())
		{
			if (Auth::user()->id == $reply->by)
			{
				return true;
			}
			if (isModerator() || isAdmin())
			{
				return true;
			}
		}
		return false;
	}

	public function rankTitle()
	{
		$rank = Rank::find($this->ranks_id);
		return $rank->title;
	}

	public function createLog()
	{
		$log = new Loginlog;
		$log->users_id = $this->id;
		$log->save();
	}

	public function lastLogin()
	{
		$log = LoginLog::where('users_id','=',$this->id)->orderBy('created_at','desc')->first();
		if (isset($logs))
			return $log->created_at;
	}

	public function timesOnline()
	{
		$logs = LoginLog::where('users_id','=',$this->id);
		return $logs->count();
	}

}
