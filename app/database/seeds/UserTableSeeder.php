<?php

class UserTableSeeder extends Seeder{

	public function run()
	{
		try
		{
   			// Create the user
			$user = Sentry::createUser(array(
				
				'email'     => 'admin@admin.com',
				'password'  => 'admin',
				'activated' => true,
				));
			$user->username ='MM Admin';
			$user->save();


    		// Find the group using the group id
			$adminGroup = Sentry::findGroupById(1);

   			 // Assign the group to the user
			$user->addGroup($adminGroup);
		}
		catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
		{
			echo 'Login field is required.';
		}
		catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
		{
			echo 'Password field is required.';
		}
		catch (Cartalyst\Sentry\Users\UserExistsException $e)
		{
			echo 'User with this login already exists.';
		}
		catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e)
		{
			echo 'Group was not found.';
		}
	}
}