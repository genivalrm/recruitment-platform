<?php namespace App;

class Profile extends \Moloquent {
	public $fillable = ['name', 'office', 'phone', 'email', 'tag'];

	public function setEmailAtributte($value)
	{
		$this->attributes['email'] = strtolower($value);
	}

	public function curriculum(){
		return $this->hasMany('App\Curriculum');
	}
}
