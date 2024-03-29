<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

	/**
	 * define relationship with Picture.
	 * 
	 * @return HasMany
	 */
	public function pictures()
	{
		return $this->hasmany('Picture');
	}
	
	/**
	 * implement functions.
	 * unnecessary on or below laravel 4.1.
	 */
	
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
	 * @void
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
}