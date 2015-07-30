<?php namespace App\Http\Controllers\Auth;
use App\Persona;
use App\Project;
use App\BMC;
use App\Status;
use App\User;

class TestController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Test Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders test requests.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Show the application test screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		/* Create new Persona dataset
		$persona = new Persona();
		$persona->name = 'Frauen 20 - 30';
		$persona->avatarImg = 'http://www.brightlinkprep.com/wp-content/uploads/2014/04/sample.jpg';
		$persona->skills = "jung, dynamisch, abwaschbar";
		$persona->needs = "Schuhe, Klamotten, Liebe, Sex";
		$persona->save();
		*/
		
		/*
		$user = User::where('email', '=', 'dorit_wittig@yahoo.de')->firstOrFail();
		
		$project = new Project();
		$project->title = 'Dummy Project';
		$project->assignee()->associate($user);
		$project->save();
		
		$bmc = new BMC();
		$bmc->title = 'Dummy BMC';
		$bmc->status = Status::IN_WORK;
		$bmc->version = '1.0.0';
		$bmc->project()->associate($project);
		$bmc->save();*/
		
		/*$temp= $this->getAllProject();
		return $temp;*/
		return view('test');
	}
}
