<?php

class ProductsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /products
	 *
	 * @return Response
	 */
	public function index()
	{
		$limit=Input::get('limit',24);
		$input=Input::all();
		$products=Product::filter(Input::all(),$limit);
		$categories=Category::dropdownlist();
		$units=Unit::dropdownlist();
		if(Request::ajax()){
			return Response::json($products->lists('nameprice'))->setCallback(Input::get('callback'));
		}
		else{
			$index=$products->getPerPage()*($products->getCurrentPage()-1)+1;
			return View::make('products.index',compact('products','index','input','categories','units'));
		}


	
	  /*$products = Product::paginate(20);
      $index = $products->getPerPage() * ($products->getCurrentPage()-1) + 1;
      return View::make('products.index', compact('products', 'index'));*/
		
	}

	public function hello()
	{
		echo "hello";
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /products/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$categories=Category::dropdownlist();
		$units=Unit::dropdownlist();
		return View::make('products.create',compact('categories','units'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /products
	 *
	 * @return Response
	 */
	public function store()
	{
		 $validator = Validator::make(Input::all(), Product::$rules);
		 //dd(Input::all());

        if ($validator->passes()) {
            $product = new Product;
            $product->description = addslashes(Input::get('description'));
            $product->name = addslashes(Input::get('description'));
            $product->productcode = 0;
            $product->buyingprice = Input::get('buyingprice');
            $product->sellingprice = Input::get('sellingprice');
            $product->quantity = 0;
            $product->category_id = Input::get('category_id');
            $product->um_id = Input::get('um_id');
            $product->save();
            $product->setProductCode($product);
           
           $stock = new Stock();
            
            $stock->product_id = $product->id;
            $stock->quantity = 0;
            $stock->save();

            return Redirect::route('products.index')
                ->with('success', 'Product created successfully');
        } else {
            return Redirect::route('products.create')
                ->withErrors($validator)
                ->withInput(Input::all());
        }
	}

	/**
	 * Display the specified resource.
	 * GET /products/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$product = Products::find($id);

        if (Request::ajax()) {
            $return = [
                'product' => [
                    $product,
                    'unit' => $product->unit
                ]
            ];
            return Response::json($product)->setCallback(Input::get('callback'));
        }
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /products/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		if(!$id)
		 return Redirect::route('products.index')
                ->with('error', 'Please Provide product id');
        $product=Product::find($id);
         if (empty($product))
            return Redirect::route('products.index')
                ->with('error', 'Product not found');
        $categories= Category::dropdownList();
        $units = Unit::dropdownList();
        return View::make('products.edit', compact('product', 'categories', 'units'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /products/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{if (Input::get('check_update') == 1) {
          
		$validator=Validator::make(Input::all(),Product::$rules2);
		

      if($validator->passes()) {
         $product = Product::find($id);
         	$product->name = addslashes(Input::get('name'));
            $product->buyingprice = Input::get('buyingprice');
            $product->sellingprice = Input::get('sellingprice');
            $product->category_id = Input::get('category_id');
            $product->um_id = Input::get('um_id');
            $product->save();

         return Redirect::route('products.index')
            ->with('success', 'Product updated successfully');
      }
      else {
         return Redirect::route('products.edit', $id)
            ->withErrors($validator)
            ->withInput(Input::all());
      }
 		 }
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /products/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if (!$id)
            return Redirect::route('products.index')
                ->with('error', 'Please provide product id');

        $product = Product::find($id);

        if (empty($product))
            return Redirect::route('products.index')
                ->with('error', 'Product not found');

        
         Product::destroy($id);

        return Redirect::route('products.index')
            ->with('success', 'Product deleted successfully');
	}

	public function search()
	{
		$query = trim(Input::get('query'));
        $result = Product::autocompleteSearch($query);
        return Response::json($result);
	}

}