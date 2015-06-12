<?php

class SalesController extends BaseController {

     public function __construct()
    {
        $this->beforeFilter('sentry');
        $this->user = Sentry::getUser();
    }

	/**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $input = Input::all();
        

        $sales = Sales::with('items')
            ->where(function ($query) use ($input) {

                if (array_key_exists('from', $input) && strlen($input['from']))
                    $query->where(DB::raw('DATE(created_at)'), '>=', date('Y-m-d', strtotime($input['from'])));

                if (array_key_exists('to', $input) && strlen($input['to']))
                    $query->where(DB::raw('DATE(created_at)'), '<=', date('Y-m-d', strtotime($input['to'])));
            })
            ->paginate(10);
        return View::make('sales.index', compact('sales', 'index'));
    }

	public function create(){
		return View::make('sales/create');
	}

	public function search()
	{
		
	}

	public function store()
	{
		
		if (null==Input::get('cart')) 
        {
            return Redirect::route('sales.create');
        }
        else
        {
            $validator = Validator::make(Input::all(), Sales::$rules);

            if ($validator->passes()) {

                $sale = new Sales;
                $sale->reference_no = '';
                $sale->discount = Input::get('discount');
                $sale->total = Input::get('grandtotal');
            
                if ($sale->save()) {
                    $sale->reference_no = 'SALE-' . date('Ymd') . '-' . str_pad($sale->id, 3, 0, STR_PAD_LEFT);
                    $sale->save();

                    foreach (Input::get('cart') as $productId => $item) {

                        $salesItem = new Salesitems;
                        $salesItem->sales_id = $sale->id;
                        $salesItem->product_id = $productId;
                        $salesItem->buyingprice = $item['cp'];
                        $salesItem->sellingprice = $item['sp'];
                        $salesItem->quantity = $item['quantity'];
                        $salesItem->total = ($item['quantity'] * $item['sp']);
                
                        $salesItem->save();

                        // Update product stock
                        $product = Product::find($productId);
                        $product->quantity = $product->quantity - $salesItem->quantity;
                        $product->save();
                    
                    }
                }

                return Redirect::route('sales.edit', $sale->id)
                ->with('success', 'Sale updated successfully');
            } else {
                return Redirect::route('sales.create')
                ->withErrors("$validator")
                ->withInput(Input::all());
            }
        }
	}

    public function edit($id)
    {
        $sale = Sales::with('items')->find($id);
        return View::make('sales.edit', compact('sale'));
    }
}