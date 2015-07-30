<?php namespace App\Http\Controllers;

use App\Persona;
use App\Project;
use App\User;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Auth;
use App\BMC;
class TeamController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Persona Controller
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
		return view('team');
	}
	
	public function create()
	{
		$myProjects = $this->getMyProjects();
		
		return view('addTeamMember', ['myProjects' => $myProjects]);
	}
	
	public function getAllProjects(){
		return Project::all();
	}
	
	public function getMyProjects(){
		$allProjects = $this->getAllProjects();
		$projects = json_decode($allProjects, true);
	
		$user_id = Auth::user()->id;
		$myProjects = array();
	
		foreach ($projects as $project){
				
			$assigne_id = $project["assignee_id"];
				
			if($user_id == $assigne_id){
				$temp = json_encode($project);
				array_push($myProjects, $project);
			}
		}
	
		return $myProjects;
	}
	
}
