<?php

class CategoriesController extends \BaseController {

	public function __construct()
   {
      $this->beforeFilter('sentry');
   }
	/**
	 * Display a listing of the resource.
	 * GET /categories
	 *
	 * @return Response
	 */
	public function index()
	{
	  $categories = Category::paginate(20);
      $index = $categories->getPerPage() * ($categories->getCurrentPage()-1) + 1;
      return View::make('categories.index', compact('categories', 'index'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /categories/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('categories.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /categories
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator=Validator::make(Input::all(),Category::$rules);
		if($validator->passes())
		{
			$categories=new Category();
			$categories->description=Input::get('description');
			$categories->save();
			return Redirect::route('categories.index')
			->with('success', 'Category created successfully');
		}
		return Redirect::route('categories.create')
            ->withErrors($validator)
            ->withInput(Input::all());
	}

	/**
	 * Display the specified resource.
	 * GET /categories/{id}
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
	 * GET /categories/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		if(!$id)
			return Redirect::route('categories.index')
            ->with('error', 'Please provide Category id');
        $category=Category::find($id);
         /*dd($unit);*/

         if(empty($category))
         	return Redirect::route('categories.index')
            ->with('error', 'No Category Found');
            
            return View::make('categories.edit',compact('category'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /categories/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$validator=Validator::make(Input::all(),Category::$rules);
		if($validator->passes())
		{
			$categories=Category::find($id);
			$categories->description=Input::get('description');
			$categories->save();
			return Redirect::route('categories.index')
			->with('success', 'Category updated successfully');
		}
		else {
         return Redirect::route('categories.edit', $id)
            ->withErrors($validator)
            ->withInput(Input::all());
      }
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /categories/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if(!$id)
			return Redirect::route('categories.index')
            ->with('error', 'Please provide category id');
         $categories=Category::find($id);

         /*dd($unit);*/

         if(empty($categories))
         	return Redirect::route('categories.index')
            ->with('error', 'No Category Found');
         $categories=Category::destroy($id);
         return Redirect::route('categories.index')
            ->with('success', 'Unit deleted successfully');
            
            return View::make('categories.edit',compact('category'));
	}

	public function search()
	{
		echo "cate search";
	}

}