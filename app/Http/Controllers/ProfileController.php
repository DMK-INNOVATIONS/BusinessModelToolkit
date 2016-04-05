<?php namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
class ProfileController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Bmc Controller
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('profile', ['user' => json_decode ( Auth::user(), true )]);
	}

	public function save($id) {
		$user = User::find($id);

		if(!empty(Input::get('name'))){
			$user->name = Input::get('name');
		}
		
		if(!empty($_POST ["email"])){
			$user->email = Input::get('email');
		}
		
		if(!empty($_POST ["password"])){
			$user->password = bcrypt(Input::get('password'));
		}
		
		$user->save();
			
		return redirect ( 'bmc' );
	}
}
