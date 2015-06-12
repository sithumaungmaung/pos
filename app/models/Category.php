<?php

class Category extends \Eloquent {
	protected $table="categories";
	
	public static $rules=[
		'description'=>'required'
	];

	public static function dropdownList()
   {
      return array('' => 'Select Category') +Category::orderBy('description', 'asc')->get()->lists('description', 'id');
   }
}