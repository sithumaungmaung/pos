<?php

class StocksController extends \BaseController {

	public function __construct()
    {
        $this->beforeFilter('sentry');
    }
	/**
	 * Display a listing of the resource.
	 * GET /stocks
	 *
	 * @return Response
	 */
	public function index()
	{
		$input = Input::all();
        $categories = Category::dropdownList();
        $productTable = (new Product)->getTable();

        $stocks = null;
        /*if ($this->loggedUser()->outlet_id) {
            $outletStockTable = (new OutletsStocks)->getTable();
            
            $stocks = OutletsStocks::join($productTable, $productTable . '.id', '=', $outletStockTable . '.product_id')
                        ->where(function($q) use ($input, $productTable, $outletStockTable){
                            if (array_key_exists('name', $input) && strlen($input['name']))
                                $q->where($productTable . '.name', 'LIKE', "%" . $input['name'] . "%");

                            if (array_key_exists('type', $input) && strlen($input['type']))
                                $q->where('type_id', '=',  $input['type']);

                            if (array_key_exists('entry_from', $input) && strlen($input['entry_from']))
                                $q->where(DB::raw('DATE('.$outletStockTable.'.created_at)'), '>=', date('Y-m-d', strtotime($input['entry_from'])));

                            if (array_key_exists('entry_to', $input) && strlen($input['entry_to']))
                                $q->where(DB::raw('DATE('.$outletStockTable.'.created_at)'), '<=', date('Y-m-d', strtotime($input['entry_to'])));
                
                            if (array_key_exists('barcode', $input) && strlen($input['barcode']))
                                $q->where('product_code', 'LIKE', "%" . trim($input['barcode']) . "%");

                        })
                        ->select($outletStockTable.'.*')
                        ->where('outlet_id', '=', $this->loggedUser()->outlet_id)->paginate(20);
        }*/
        
            $stockTable = (new Stock)->getTable();
            $stocks = Stock::join($productTable, $productTable . '.id', '=', $stockTable . '.product_id')
                        
                        ->where(function($q) use ($input, $productTable, $stockTable){
                            if (array_key_exists('name', $input) && strlen($input['name']))
                                $q->where($productTable . '.name', 'LIKE', "%" . $input['name'] . "%");

                            if (array_key_exists('categories', $input) && strlen($input['categories']))
                                $q->where('categoryid', '=',  $input['categories']);

                            
                            if (array_key_exists('entry_from', $input) && strlen($input['entry_from']))
                                $q->where(DB::raw('DATE('.$stockTable.'.created_at)'), '>=', date('Y-m-d', strtotime($input['entry_from'])));

                            if (array_key_exists('entry_to', $input) && strlen($input['entry_to']))
                                $q->where(DB::raw('DATE('.$stockTable.'.created_at)'), '<=', date('Y-m-d', strtotime($input['entry_to'])));
                
                           

                        })
                        ->select($stockTable.'.*')
                        ->paginate(20);
        

        $index = $stocks->getPerPage() * ($stocks->getCurrentPage() - 1) + 1;
        return View::make('stocks.index', compact('stocks', 'index', 'categories', 'input'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /stocks/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$categories=Category::dropdownlist();
		$input = Input::all();

		return View::make('stocks.create',compact('categories','input'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /stocks
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make(Input::all(), Stock::$rules);

        if ($validator->passes()) {
            $stock = new Stock;
           
            $stock->product_id = Input::get('product_id');
            $stock->quantity = Input::get('quantity');
            $stock->save();

            $product = Product::find(Input::get('product_id'));
            $product->quantity = $product->quantity + Input::get('quantity');
            $product->save();

            //Product::updateStock($stock->product_id);
            return Redirect::route('stocks.index')
                ->with('success', 'Stock created successfully');
        } else {
            return Redirect::route('stocks.create')
                ->withErrors($validator)
                ->withInput(Input::all());
        }
	}

	/**
	 * Display the specified resource.
	 * GET /stocks/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /stocks/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{	
		 if (!$id)
            return Redirect::route('stocks.index')
                ->with('error', 'Please Provide Stock id');

        $stock = Stock::find($id);

        if (empty($stock))
            return Redirect::route('stocks.index')
                ->with('error', 'Stock not found');
        
        $products = Product::dropdownList();
        return View::make('stocks.edit', compact('stock', 'products'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /stocks/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$validator = Validator::make(Input::all(), Stock::$updaterules);

        if ($validator->passes()) {
            $stock = Stock::find($id);
            
            $stock->quantity = Input::get('quantity');
            $stock->save();
            Product::updateStock($stock->product_id);

            return Redirect::route('stocks.index')
                ->with('success', 'Stock updated successfully');
        } else {
            return Redirect::route('stocks.edit', $id)
                ->withErrors($validator)
                ->withInput(Input::all());
        }
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /stocks/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}