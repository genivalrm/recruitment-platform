<?php namespace App;

class Curriculum extends \Moloquent
{
    public $fillable = ['attachment_id'];

    public function profile()
	{
		return $this->belongsTo('App\Profile');
	}
}
