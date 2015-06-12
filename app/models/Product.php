<?php

class Product extends \Eloquent {
	protected $table="products";

	public static $rules=[
		
		'description'=>'required',
		'buyingprice'=>'required',
		'sellingprice'=>'required',
		'category_id'=>'required',
		'um_id'=>'required'
	
	];
    public static $rules2=[
        
        'name'=>'required',
        'category_id'=>'required',
        'um_id'=>'required'
    
    ];
	public function setProductCode($product)
    {
        $product->productcode = "GG" . str_pad($product->category_id, 3, 0, STR_PAD_LEFT) . str_pad($product->um_id, 3, 0, STR_PAD_LEFT) . str_pad($product->id, 6, 0, STR_PAD_LEFT);
        $product->save();
    }

    public function category()
    {
        return $this->hasOne('Category', 'id', 'category_id');
    }

    public function unit()
    {
        return $this->hasOne('unit', 'id', 'um_id');
    }

     public function stock()
    {
        return $this->hasMany('Stock', 'product_id');
    }

    public static function updateStock($productId)
    {
        $product = Product::find($productId);
        
        $stockQuantity = Stock::whereProductId($productId)->sum('quantity');
        
        $soldQuantity = 20;
        $product->quantity = $stockQuantity - $soldQuantity;
        $product->save();
    }
	//protected $fillable = [];

    public static function dropdownList()
    {
        
            $products = Product::orderBy('name', 'asc')->select('id', DB::raw('CONCAT(name, " - Rs ",  sellingprice) as name'))->get();

        return array('' => 'Select Product') + $products->lists('name', 'id');
    }

     
    public static function filter($input, $limit = 24)
    {
        

        $products = Product::where(function ($query) use ($input) {

                if (array_key_exists('name', $input) && strlen($input['name']))
                    $query->where('name', 'LIKE', "%" . $input['name'] . "%");


                if (array_key_exists('category', $input) && strlen($input['category']))
                    $query->whereCategoryId($input['category']);

                
            })
            ->select('products.*', DB::raw('CONCAT(name, " - Rs. ", buyingprice , " / Rs. " , sellingprice, ":",id) as nameprice'))
            ->orderBy('name', 'asc');

        if($limit == 0)
            return $products->get();
        else
            return $products->paginate($limit);
    }

	public static function autocompleteSearch($query = null)
    {
        $productTable = (new Product)->getTable();
            
            $products = Product::Select( $productTable . '.id')
                ->where(function($select) use ($query) {
                    $select->where('name', 'LIKE', '%' . $query . '%');
                    $select->orWhere('productcode', 'LIKE', '%' . $query . '%');
                })
                ->where('quantity', '>=', 1)
                ->select(
                    DB::raw("CONCAT(name, ' Ks ', buyingprice, ' / Ks ', sellingprice, ' - In stock (', quantity, ')') as value"),
                    DB::raw("CONCAT(
                            '{\"id\":\"', {$productTable}.id, '\"',
                            ',\"productcode\":\"', productcode, '\"',
                            ',\"name\":\"', name, '\"',
                            ',\"sellingprice\":\"', sellingprice, '\"',
                            ',\"buyingprice\":\"', buyingprice, '\"',
                            ',\"in_stock\":\"', quantity, '\"}'
                         ) as data"),
                    DB::raw("CONCAT(
                            '{\"id\":\"', {$productTable}.id, '\"',
                            ',\"productcode\":\"', productcode, '\"',
                            ',\"name\":\"', name, '\"',
                            ',\"sellingprice\":\"', sellingprice, '\"',
                            ',\"buyingprice\":\"', buyingprice, '\"',
                            ',\"in_stock\":\"', quantity, '\"}'
                         ) as nodiscount")
                )
                ->orderBy('name', 'asc')
                ->get();
        

        $result = [
            'query' => $query,
            'suggestions' => $products->toArray()
        ];

        return $result;
    }
}