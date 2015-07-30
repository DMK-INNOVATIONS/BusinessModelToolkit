<?php namespace App\Http\Controllers;

use App\User;
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
		return view('profile');
	}
	
	public function edit($id) {
		$user = User::find ( $id );
	
		return view ( 'profile', ['user' => json_decode ( $user, true )]);
	}

	public function save() {
		$user_id = Auth::user ()->id;
		$user = User::find ( $user_id );

		$user->name = $_POST ["name"];
		$user->email = $_POST ["email"];
		$user->password = $_POST ["password"];
		$user->save ();
			
		return redirect ( 'bmc' );
	}
}
