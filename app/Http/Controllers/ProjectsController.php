<?php

namespace App\Http\Controllers;

use App\Project;
use App\User;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Auth;
use App\BMC;
use App\Notice;
use Illuminate\Support\Facades\DB;
// use App\Http\Requests\Request;
use Illuminate\Support\Facades\Input;
use Request; // You're not using the facade, replace use Illuminate\Http\Request; with use Request;
use Illuminate\Validation\Validator;
class ProjectsController extends Controller {
	
	/*
	 * |-------------------------------------------------------------------------- | Persona Controller |-------------------------------------------------------------------------- | |
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
		//$user = Auth::user ();
		$user = self::userEnable();
		
		// $getMyProjects = $this->getMyProjects ();
		$myAssignedProjects = $this->getMyAssignedProjects ();
		$assignedProjects = $this->getAssignedProjects ();
		
		$assignedProjectsOwners = $this->getAssignedProjectsOwner ();
		$myProjects=$this->getAllMyAssignedMyProjects ();

		$path = $this->getPath();
		// send per ajax return parameter from sort
		if (Request::ajax ()) {
			$sort_field = Input::get ( 'sort_field' );
			$view = view ( 'projects', [ 
					'myProjects' => $myProjects,
					'user' => $user,
					'sort_field' => $sort_field,
					'myAssignedProjects' => $this->getAllMyAssignedMyProjects (),
					'assignedProjectsOwners' => $this->getAssignedProjectsOwner (),
					'assignedProjects'=> $assignedProjects,
					'path' => $path
			] )->renderSections ();
			return $view;
		}
		return view ( 'projects', [ 
				'myProjects' => $this->getAllMyAssignedMyProjects (),
				'user' => $user,
				'sort_field' => '',
				'myAssignedProjects' => $this->getAllMyAssignedMyProjects (),
				'assignedProjectsOwners' => $assignedProjectsOwners,
				'assignedProjects'=> $assignedProjects,
				'path' => $path
		] );
	}
	private function userEnable(){
		if(Auth::user () && Auth::user ()->status_enable!=0)
			return Auth::user ();
	}
	public function getProjects() {
		return Project::with ( 'members', 'assignee' )->get ();
	}
	public function getAllMyAssignedMyProjects() {
		/*$sort_field = Input::get ( 'sort_field' );
		$user_id = Auth::user ()->id;
		$projects = Project::with ( [ 
				'members' => function ($q) use($user_id) {
					$q->where ( 'user_id', '=', $user_id )->orderBy ( 'created_at', 'desc' );
				},
				'bmcs' 
		] )->where ( 'assignee_id', $user_id )->orderBy ( $sort_field ? $sort_field : 'updated_at', 'asc' )->get ();
		
				
		$myprojects = array ();
		foreach ( $projects as $project ) {
			$myprojects [$project->id] = $project;
		}
		return $myprojects;
		*/
		
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
	 * Gets all the projects.
	 *
	 * @return Ambigous <\Illuminate\Database\Eloquent\Collection, multitype:\Illuminate\Database\Eloquent\static >
	 */
	public function getAllProjects() {
		$sort_field = Input::get ( 'sort_field' );
		if($sort_field){
			return Project::orderBy ( $sort_field, strcmp($sort_field,'created_at') ? 'asc' : 'desc' )->get ();
		}else{
			return Project::orderBy ( 'updated_at', 'desc' )->get ();
			//return Project::all ();
		}
	}
	
	/**
	 * Gets my project.
	 *
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
	 *
	 * @param unknown $id        	
	 * @return \Illuminate\View\View
	 */
	public function edit($id) {
		$project = Project::find ( $id );
		
		return view ( 'newProject', [ 
				'project' => json_decode ( $project, true ),
				'error' => 0 
		] );
	}
	public function getShowBMCs($id) {
		$inserts = explode ( ",", $id );
		$sort = Input::get ( 'sort_field' );
		$project = Input::get ( 'project_id' );
		
		$sort_field = isset ( $sort ) ? $sort : 'updated_at';
		$project_id = isset ( $project ) ? $project : $inserts [0];
		$user_id = Auth::user ()->id;
		
		$projects = BMC::with ( 'project' )->where ( 'project_id', $project_id )->orderBy ( $sort_field, 'asc' )->get ();
		$myprojects = array ();
		foreach ( $projects as $project ) {
			$myprojects [$project->id] = $project;
		}
		return $myprojects;
	}
	
	/**
	 * Shows all bmcs of a project.
	 *
	 * @param unknown $id        	
	 * @return \Illuminate\View\View
	 */
	public function showBMCs($id) {
		$sort_field = Input::get ( 'sort_field' );
		$project_id = Input::get ( 'project_id' );
		$inserts = explode ( ",", $id );
		$sort_field = Input::get ( 'sort_field' );
		$project_id = isset ( $project_id ) ? $project_id : $inserts [0];
		$path = $this->getPath();
		
		if (Request::ajax ()) {
			$view = view ( 'showBMCs', [ 
					'bmcs' => $this->getAllProjectBMCs ( $id ),
					'project_id' => $project_id,
					'project_name' => $this->getProjectName ( $id ),
					'owner' => $project_id,
					'myProjects' => $this->getMyProjects (),
					'newget' => $this->getShowBMCs ( $project_id ),
					'sort_field' => isset ( $sort_field ) ? $sort_field : '',
					'path' => $path
			] )->renderSections ();
			return $view;
		}
		return view ( 'showBMCs', [ 
				'bmcs' => $this->getAllProjectBMCs ( $id ),
				'project_id' => $project_id,
				'project_name' => $this->getProjectName ( $id ),
				'owner' => $project_id,
				'myProjects' => $this->getMyProjects (),
				'newget' => $this->getShowBMCs ( $project_id ),
				'sort_field' => isset ( $sort_field ) ? $sort_field : '',
				'path' => $path
		] );
	}
	
	/**
	 * Gets the project name.
	 *
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
	 *
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
	 *
	 * @param unknown $id        	
	 * @return Ambigous <\Illuminate\Routing\Redirector, \Illuminate\Http\RedirectResponse>
	 */
	public function deleteProject($id) {
		$project = Project::find ( $id );
		
		// alle bmc's des Projektes finden
		$projectBMCs = $this->getAllProjectBMCs ( $project ['id'] );
		
		//delete all BMCs
		foreach ($project->bmcs as $bmc){
			foreach (Notice::where(array('bmc_id'=>$bmc->id))->get() as $n)
				{
					//delete all Notices for BMCs
					$notice=Notice::find($n->id);
					$notice->delete();
				}
			$bmc->delete();
		}
		//delete all members for Project
		foreach ($project->members as $member)
				$project->members()->detach($member->id);
		
		$project->delete();
		/*
		foreach ( $projectBMCs as $projectBMC ) {
			// alle personas von BMC's finden und detachen
			$bmc_personas = $projectBMC->personas ()->get ();
			
			foreach ( $bmc_personas as $bmc_persona ) {
				$projectBMC->personas ()->detach ( $bmc_persona ['id'] );
			}
			
			// alle post-IT's finden und l�schen
			$bmcPostIts = $this->getBMCPostIts ( $projectBMC ['id'] );
			
			foreach ( $bmcPostIts as $bmcPostIt ) {
				Notice::destroy ( $bmcPostIt ['id'] );
			}
			
			// bmc l�schen
			BMC::destroy ( $projectBMC ['id'] );
		}
		
		// Projekt l�schen
		Project::destroy ( $id );
		*/
		return redirect ( 'projects' );
	}
	public function getBMCPostIts($bmc_id) {
		$getAllPostIts = Notice::all ();
		$bmcPostIts = array ();
		
		$dbPostIts = json_decode ( $getAllPostIts, true );
		
		foreach ( $dbPostIts as $dbPostIt ) {
			if ($dbPostIt ["bmc_id"] == $bmc_id) {
				array_push ( $bmcPostIts, $dbPostIt );
			}
		}
		return $bmcPostIts;
	}
	
	/**
	 * Saves or updated a project.
	 *
	 * @param string $id        	
	 * @return \Illuminate\View\View
	 */
	public function save($id = null) {
		$title = Input::get('title');
		
		$validator = $this->eingabeKorrekt($title);
		$path = $this->getPath();
		
		if (!$validator) {
			return view ( 'newProject', [ 
					'error' => 1,
					'path' => $path
			] );
		} else {
			
			$myProjects = $this->getMyProjects ();
			$title_is_identical = false;
			
			foreach ( $myProjects as $myProject ) {
				if ($title == $myProject ["title"]) {
					$title_is_identical = true;
				}
			}
			
			if ($title_is_identical == false) {
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
			} else {
				return view ( 'newProject', [ 
						'error' => 2,
						'path' => $path
				] );
			}
		}
	}
	
	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function create() {
		return view ( 'newProject', [ 
				'error' => 0 
		] );
	}
	
	/**
	 * Validierung der Nutzereingaben vor der Speicheroperation.
	 */
	public function eingabeKorrekt($title) {
		if(empty($title)){
			return false;
		}else{
			if(is_string($title)){
				return true;
			}else{
				return false;
			}
		}
	}
	public function getMyAssignedProjects() {
		$allProjects = $this->getAllProjects ();
		$user_id = Auth::user ()->id;
		
		$myAssignedProjects = array ();
		
		foreach ( $allProjects as $aProject ) {
			$project = Project::find ( $aProject ['id'] );
			$assignedTeamMembers = $project->members ()->get ();
			
			foreach ( $assignedTeamMembers as $assignedTeamMember ) {
				if ($assignedTeamMember ['id'] == $user_id) {
					array_push ( $myAssignedProjects, $project );
				}
			}
		}
		return $myAssignedProjects;
	}
	public function getAssignedProjectsOwner() {
		$myAssignedProjects = $this->getMyAssignedProjects ();
		
		$owner = array ();
		
		foreach ( $myAssignedProjects as $myAssignedProject ) {
			
			$owner_array = User::find ( $myAssignedProject ['assignee_id'] );
			array_push ( $owner, $owner_array );
		}
		
		return $owner;
	}
	public function getAssignedProjects() {
		
		$sort_field = Input::get ( 'sort_field' );
		$allProjects = Project::orderBy ( 'updated_at', 'desc' )->get ();
		
		if($sort_field)
			$allProjects=Project::orderBy ( $sort_field, strcmp($sort_field,'created_at') ? 'desc' : 'asc' )->get ();
		
		$user_id = Auth::user ()->id;
		
		$myAssignedProjects = array ();
		$projects = $allProjects;
		foreach ( $projects as $project ) {
			foreach ( $project->members ()->get () as $assigned ) {
				foreach ( $assigned->memberOf ()->get () as $a ) {
					if ($assigned->id == $user_id) {
						if (! in_array ( $project, $myAssignedProjects, true ))
							array_push ( $myAssignedProjects, $project );
					}
				}
			}
		}
		
		
		return $myAssignedProjects;
	}
}
