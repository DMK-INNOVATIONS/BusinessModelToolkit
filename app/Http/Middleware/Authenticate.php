<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Invitation;
use DateTime;

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
			if($this->auth->user()->status_enable!=0){
				Auth::user()->last_Login = Carbon::now('Europe/Berlin');
				Auth::user()->save();
				$this->deleteExpiredInvitations();
				return $next($request);
			}
			$this->auth->logout();
			return response()->view('errors.403');
		}else{
			$this->auth->logout();
			return redirect()->guest('auth/login');
		}
		
		return $next($request);
	}
	
	public function deleteExpiredInvitations(){
		$invitations = Invitation::where(['inviter_id' => Auth::user()->id])->get();
		foreach($invitations as $invitation){
			$datetime1 = new DateTime(Carbon::now('Europe/Berlin'));
			$datetime2 = new DateTime($invitation['expires_on']);
			$diff = $datetime1->diff($datetime2);
			$days = $diff->format('%a');
			if($days <=0){
				Invitation::destroy($invitation['id']);
			}
		}
	}

}
