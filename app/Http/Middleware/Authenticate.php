<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class Authenticate {

	/**
	 * The Guard implementation.
	 *
	 * @var Guard
	 */
	protected $auth;

	/**
	 * Create a new filter instance.
	 *
	 * @param  Guard  $auth
	 * @return void
	 */
	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if ($this->auth->guest()){
			if ($request->ajax())
			{
				return response('Unauthorized.', 401);
			}else{	//die('return login');
				$this->auth->logout();
				return redirect()->guest('auth/login');
			}
		}
		
		if($this->auth->user()){
			if($this->auth->user()->status_enable!=0)
				return $next($request);
			$this->auth->logout();
			return response()->view('errors.403');
		}else{
			$this->auth->logout();
			return redirect()->guest('auth/login');
		}

		
		
		return $next($request);
	}

}
