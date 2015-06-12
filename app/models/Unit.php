<?php

class Unit extends \Eloquent {
	
	protected $table = "units";

   public static $rules = [
         'description' => 'required'
   ];
   public static function dropdownList()
   {
      return array('' => 'Select Unit') +Unit::orderBy('description', 'asc')->get()->lists('description', 'id');
   }
	//protected $fillable = [];
}