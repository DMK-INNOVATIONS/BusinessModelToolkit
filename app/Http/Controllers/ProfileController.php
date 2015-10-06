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

		if(!empty($_POST ["name"])){
			$user->name = $_POST ["name"];
		}
		
		if(!empty($_POST ["email"])){
			$user->email = $_POST ["email"];
		}
		
		if(!empty($_POST ["password"])){
			$user->password = bcrypt($_POST['password']);
		}
		
		$user->save();
			
		return redirect ( 'bmc' );
	}
}
