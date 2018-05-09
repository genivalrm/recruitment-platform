<?php namespace App;

class Office extends \Moloquent {
	public $fillable = ['name'];

	public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtolower($value);
    }
}