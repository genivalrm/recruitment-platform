<?php namespace App;

class Office extends \Moloquent {
	public $fillable = ['name', 'is_office'];

	public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtolower($value);
    }
}