<?php namespace App;

class Profile extends \Moloquent {
	public $fillable = ['name', 'email', 'phone', 'internship', 'tag'];

	public function setEmailAtributte($value)
	{
		$this->attributes['email'] = strtolower($value);
	}

	public function curriculum(){
		return $this->hasMany('App\Curriculum');
	}
}
