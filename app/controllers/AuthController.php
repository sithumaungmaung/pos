<?php 

class AuthController extends BaseController
{
	public function login()
	{
		$rules = [
		'email' => 'required|email',
		'password' => 'required'
		];

		$validator = Validator::make(Input::all(), $rules);

		if($validator->passes()) {
			$error = "Login failed. Please check your credentials.";
			try
			{
         	// Set login credentials
				$credentials = array(
					'email' => Input::get('email'),
					'password' => Input::get('password')
					);

         	// Try to authenticate the user. Set remember flag to false
				$user = Sentry::authenticate($credentials, false);

				if(Sentry::check()) {
					if(Request::ajax())
						return Response::json(['status' => 'success', 'message' => 'Login successful'])->setCallback(Input::get('callback'));
					else
						return Redirect::route('users.index');
				} else {
					return $this->loginFailed();
				}
			}
			catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
			{
				return $this->loginFailed();
			}
			catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
			{
				return $this->loginFailed();
			}
			catch (Cartalyst\Sentry\Users\WrongPasswordException $e)
			{
				return $this->loginFailed();
			}
			catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
			{
				return $this->loginFailed();
			}
			catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
			{
				return $this->loginFailed();
			}
		   // The following is only required if throttle is enabled
			catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e)
			{
				return $this->loginFailed('suspended');
			}
			catch (Cartalyst\Sentry\Throttling\UserBannedException $e)
			{
				return $this->loginFailed('banned');
			}
		} else {
			if(Request::ajax())
				return $this->loginFailed();
			else
				return Redirect::route('login')->withErrors($validator);
		}
	}

	
	private function loginFailed($type = null)
	{
		$error = "Login failed. Please check your credentials.";

		if ($type == 'suspended') {
			$suspension_time = Config::get('cartalyst/sentry::throttling.suspension_time');
			$minutes = $suspension_time>1?'minutes':'minute';
			$error = sprintf('Your account has been suspended due to multiple login attempts. Please try again after %d %s.', $suspension_time, $minutes);

		} elseif ($type == 'banned') {
			$error = "You account has been banned due to security policy. Please contact administrator";
		}

      if(Request::ajax()) {
         return Response::json(['status' => 'error', 'message' => $error])->setCallback(Input::get('callback'));
      }
      else
         return Redirect::route('login')->with('error', $error);
	}
}