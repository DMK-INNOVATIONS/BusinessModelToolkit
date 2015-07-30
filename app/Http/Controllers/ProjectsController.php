<?php


namespace App\Http\Controllers;

use App\Project;
use App\User;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Auth;
use App\BMC;

class ProjectsController extends Controller {
	
	/*
	 * |--------------------------------------------------------------------------
	 * | Persona Controller
	 * |--------------------------------------------------------------------------
	 * |
	 * |
	 */
	
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware ( 'auth' );
	}
	
	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index() {
		$user_name = Auth::user ()->name;
		$getMyProjects = $this->getMyProjects ();
		
		return view ( 'projects', ['myProjects' => $getMyProjects ], ['user_name' => $user_name ] );
	}
	
	/**
	 * Gets all the projects.
	 * @return Ambigous <\Illuminate\Database\Eloquent\Collection, multitype:\Illuminate\Database\Eloquent\static >
	 */
	public function getAllProjects() {
		return Project::all ();
	}
	
	/**
	 * Gets my project.
	 * @return multitype:
	 */
	public function getMyProjects() {
		$allProjects = $this->getAllProjects ();
		$projects = json_decode ( $allProjects, true );
		
		$user_id = Auth::user ()->id;
		$myProjects = array ();
		
		foreach ( $projects as $project ) {
			
			$assigne_id = $project ["assignee_id"];
			
			if ($user_id == $assigne_id) {
				array_push ( $myProjects, $project );
			}
		}
		
		return $myProjects;
	}
	
	/**
	 * Edit a project.
	 * @param unknown $id
	 * @return \Illuminate\View\View
	 */
	public function edit($id) {
		$project = Project::find ( $id );
		
		return view ( 'newProject', [ 
				'project' => json_decode ( $project, true ) 
		] );
	}
	
	/**
	 * Shows all bmcs of a project.
	 * @param unknown $id
	 * @return \Illuminate\View\View
	 */
	public function showBMCs($id) {
		$project_id = $id;
		$project_name = $this->getProjectName ( $id );
		$allProjectBMCs = $this->getAllProjectBMCs ( $id );
		
		return view ( 'showBMCs', [ 
				'bmcs' => $allProjectBMCs,
				'project_id' => $project_id,
				'project_name' => $project_name 
		] );
	}
	
	/**
	 * Gets the project name.
	 * @param unknown $id
	 * @return \App\Http\Controllers\Ambigous
	 */
	public function getProjectName($id) {
		$allProjects = $this->getAllProjects ();
		foreach ( $allProjects as $project ) {
			if ($project ['id'] == $id) {
				$name = $project ['title'];
				return $name;
			}
		}
	}
	
	/**
	 * Gets all the bmcs of a project.
	 * @param unknown $id
	 * @return multitype:
	 */
	public function getAllProjectBMCs($id) {
		$allBMCs = BMC::all ();
		$allProjectBMCs = array ();
		
		foreach ( $allBMCs as $bmc ) {
			if ($bmc ['project_id'] == $id) {
				array_push ( $allProjectBMCs, $bmc );
			}
		}
		
		return $allProjectBMCs;
	}
	
	/**
	 * Deletes the project.
	 * @param unknown $id
	 * @return Ambigous <\Illuminate\Routing\Redirector, \Illuminate\Http\RedirectResponse>
	 */
	public function deleteProject($id) {
		$project = Project::find ( $id );
		
		Project::destroy ( $id );
		
		return redirect ( 'projects' );
	}
	
	/**
	 * Saves or updated a project.
	 * @param string $id
	 * @return \Illuminate\View\View
	 */
	public function save($id = null) {
		$title = $_POST ["title"];
		
		if ($title == '') {
			return view ( 'newProject', ['error' => 1]);
		} else {
			
			$myProjects = $this->getMyProjects();
			$title_is_identical = false;
			
			foreach($myProjects as $myProject){
				if($title == $myProject["title"]){
					$title_is_identical = true;
				}
			}
			
			if($title_is_identical == false){
				if (is_null ( $id )) {
					$project = new Project ();
				} else {
					$project = Project::find ( $id );
				}
				
				$user_id = Auth::user ()->id;
				
				$project->title = $title;
				$project->assignee_id = $user_id;
				$project->save ();
				
				return redirect ( 'projects' );
			}else{
				return view ( 'newProject', ['error' => 2]);
			}
		}
	}
	
	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function create() {
		return view ( 'newProject', ['error' => 0]);
	}
	
	/**
	 * Validierung der Nutzereingaben vor der Speicheroperation.
	 * TODO Sollte man sicherlich noch einbauen!
	 */
	public function eingabeKorrekt() {
		$validator = Validator::make ( Input::all (), array (
				'title' => '$project_title' 
		) );
		
		if ($validator->fails) {
			return Redirect::action ( NewProjectController::index () );
		}
		return Redirect::action ( NewProjectController::createNewProject () );
	}
}
