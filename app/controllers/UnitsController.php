<?php

class UnitsController extends \BaseController {

	public function __construct()
   {
      $this->beforeFilter('sentry');
   }
	/**
	 * Display a listing of the resource.
	 * GET /units
	 *
	 * @return Response
	 */
	public function index()
	{
	  $units = Unit::paginate(20);
      $index = $units->getPerPage() * ($units->getCurrentPage()-1) + 1;
      return View::make('units.index', compact('units', 'index'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /units/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//echo "create";
		return View::make('units.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /units
	 *
	 * @return Response
	 */
	public function store()
	{
			$validator = Validator::make(Input::all(), Unit::$rules);

      if($validator->passes()) {
         $unit = new Unit;
         $unit->description= Input::get('description');
         $unit->save();

         return Redirect::route('units.index')
            ->with('success', 'Unit created successfully');
      }
      else {
      	
         return Redirect::route('units.create')
            ->withErrors($validator)
            ->withInput(Input::all());
      }
	}

	/**
	 * Display the specified resource.
	 * GET /units/{id}
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
	 * GET /units/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		if(!$id)
			return Redirect::route('units.index')
            ->with('error', 'Please provide unit id');
         $unit=Unit::find($id);

         /*dd($unit);*/

         if(empty($unit))
         	return Redirect::route('units.index')
            ->with('error', 'No Unit Found');
            
            return View::make('units.edit',compact('unit'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /units/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		
		$validator=Validator::make(Input::all(),Unit::$rules);
		

      if($validator->passes()) {
         $unit = Unit::find($id);
         $unit->description= Input::get('description');
         $unit->save();

         return Redirect::route('units.index')
            ->with('success', 'Unit updated successfully');
      }
      else {
         return Redirect::route('units.edit', $id)
            ->withErrors($validator)
            ->withInput(Input::all());
      }
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /units/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if(!$id)
			return Redirect::route('units.index')
            ->with('error', 'Please provide unit id');
         $unit=Unit::find($id);

         /*dd($unit);*/

         if(empty($unit))
         	return Redirect::route('units.index')
            ->with('error', 'No Unit Found');
         $unit=Unit::destroy($id);
         return Redirect::route('units.index')
            ->with('success', 'Unit deleted successfully');
            
            return View::make('units.edit',compact('unit'));
	}

}