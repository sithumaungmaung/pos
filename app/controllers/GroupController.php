<?php 

class GroupController extends BaseController {

	public function addgroup()
	{
		//create admin group
		try
		{
    		// Create the group
			$group = Sentry::createGroup(array(
				'name'        => 'Administrators',
				'permissions' => array(
					'admin' => 1,
					'users' => 1,
					),
				));
		}
		catch (Cartalyst\Sentry\Groups\NameRequiredException $e)
		{
			echo 'Name field is required';
		}
		catch (Cartalyst\Sentry\Groups\GroupExistsException $e)
		{
			echo 'Group already exists';
		}


		//add user group
		try
		{
    		// Create the group
			$group = Sentry::createGroup(array(
				'name'        => 'Users',
				'permissions' => array(
					'admin' => 0,
					'users' => 1,
					),
				));
		}
		catch (Cartalyst\Sentry\Groups\NameRequiredException $e)
		{
			echo 'Name field is required';
		}
		catch (Cartalyst\Sentry\Groups\GroupExistsException $e)
		{
			echo 'Group already exists';
		}

	}

}