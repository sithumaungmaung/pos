<?php

class UserController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function __construct()
	{
		$this->beforeFilter('sentry', ['except' => ['login','logout', 'doLogin', 'revokePermission']] );
	}

	public function index()
	{
		$users = User::with('groups')
		->where('permissions', 'NOT LIKE', '%superuser%')
		->orderBy('email', 'asc')->paginate();
		$index = $users->getPerPage() * ($users->getCurrentPage() - 1) + 1;
		return View::make('user.index', compact('users', 'index'));
	}

	public function login()
	{		
		return View::make('user/login');
	}

	public function postlogin()
	{
		echo "hello";
	}

	public function search()
	{
		echo "user search";
	}

	public function create()
	{
		//$groups = Sentry::getGroups();
        //$outlets = SalesOutlets::dropdownList();
		$roles = ['' => 'Select Role'] + User::$roles;
		return View::make('user/create',compact('roles'));
	}

	public function store()
	{
		$validator = Validator::make(Input::all(), User::$rules);

		
		if ($validator->passes()) {
			$group = Sentry::findGroupById(Input::get('role'));
			
			// Create the user
			$user = Sentry::createUser(array(
				'email' => Input::get('email'),
				'password' => Input::get('password'),
				'username' => Input::get('name'),
				'activated' => 1,
				'permissions' => []
				));

            // Assign the group to the user
			$user->addGroup($group);

			return Redirect::route('users.create')
			->with('success', 'User created successfully');

		} else {
			return Redirect::route('users.create')
			->withErrors($validator)
			->withInput(Input::all());
		}
	}

	public function update($id)
	{
		$rules = User::$rules;
		if(Input::get('password'))
			$rules['password'] = 'alpha_num|between:4,8';

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->passes()) {
			$group = Sentry::findGroupById(Input::get('role'));

			// Create the user
			$user = Sentry::createUser(array(
				'email' => Input::get('email'),
				'password' => Input::get('password'),
				'username' => Input::get('name'),
				//'phone' => Input::get('phone'),
				'activated' => 1, //Input::get('activated'),
				'permissions' => []
			));

			// Assign the group to the user
			$user->addGroup($group);

			return Redirect::route('users.create')
				->with('success', 'User created successfully');

		} else {
			return Redirect::route('users.create')
				->withErrors($validator)
				->withInput(Input::all());
		}
	}

	public function edit($id)
	{
		$groups = Sentry::getGroups();
		$roles = ['' => 'Select Role'] + User::$roles;
		$user = User::with('groups')->find($id);
		return View::make('user.edit', compact('groups', 'roles', 'user'));
	}

	public function logout()
	{
		Sentry::logout();
		return Redirect::route('users.login');
	}
}
