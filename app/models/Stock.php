<?php

class Stock extends \Eloquent {
	protected $table="stocks";
	
	public static $rules = [
         
         'product_id' => 'required',
         'quantity' => 'required',
   ];

   public static $updaterules = [
         'quantity' => 'required',
   ];

    public function product()
   {
      return $this->hasOne('Product', 'id','product_id');
   }

	
}