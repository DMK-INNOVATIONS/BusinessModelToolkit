<?php namespace App\Http\Controllers;

use App\Persona;
use App\Project;
use App\User;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Auth;
use App\BMC;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
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
		$assignedTeamMembers = $this->getAssignedTeamMembers();
		$myProjects = $this->getMyProjects();
		
		return view('team', ['assignedTeamMembers' => $assignedTeamMembers, 'myProjects' => $myProjects]);
	}
	
	public function getAssignedTeamMembers(){
		$allProjects = $this->getMyProjects();
		$user_id = Auth::user()->id;
		
		$myAssignedTeamMembers = array();
		
		foreach($allProjects as $aProject){
			$project = Project::find($aProject['id']);
			$assignedTeamMembers = $project->members()->get();
			
			foreach($assignedTeamMembers as $assignedTeamMember){
				if($assignedTeamMember['id'] == true){
					array_push($myAssignedTeamMembers, $assignedTeamMembers);
// 					print $assignedTeamMember['name'];
				}	
			}
		}
		return $myAssignedTeamMembers;
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
	
	public function addUserToProject(Request $request){
		$allUsers = $this->getAllUsers();
		$teamMemberEmail = $_POST["Email"];
		$project_id = $_POST["projects"];
		$myProjects = $this->getMyProjects();
		
		$teamMemberId = 'The User could not be found.';
		$allreadyConnected = false;
		
		foreach($allUsers as $user){
			if($user['email'] == $teamMemberEmail){
				$teamMemberId = $user['id'];
			}
		}
		
		if(is_numeric($teamMemberId)){
			$project = Project::find($project_id);
			$assignedTeamMembers = $project->members()->get();
			
			foreach ($assignedTeamMembers as $assignedTeamMember){
				if ($assignedTeamMember['id'] == $teamMemberId){ //prüfen ob User bereits mit Projekt verbunden ist
					$errorMessage = 'There is already a connection between '.$assignedTeamMember['name'].' and your Project: '.$project['title'].'.';
					$allreadyConnected = true;
					
					return redirect('team')->with('error', $errorMessage);
				}
			}
			
			$project->members()->attach($teamMemberId);
			$project->save();
			
			return redirect('team');			
		}else{
			$errorMessage = 'The User with the email '.$teamMemberEmail.' could not be found.';
			return redirect('team')->with('error', $errorMessage);
		}
	}
	
	public function getAllUsers(){
		return User::all();
	}
	
}
