<?php

namespace App\Http\Controllers;

use App\BMC;
use App\Status;
use App\Project;
use App\Persona;
use App\User;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Auth;
use App\Notice;
use App\App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class BmcController extends Controller {
	
	/*
	 * |-------------------------------------------------------------------------- | Bmc Controller |-------------------------------------------------------------------------- | |
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
		$myProjects = $this->getMyProjects ();
		return view ( 'bmc',[ 
				'myProjects' => $myProjects]);
	}
	public function create($id) {
		$inserts = explode ( ",", $id );
		$project_id = $inserts [0];
		$owner = $inserts [1];
		$view_type = $inserts [2];
		
		return view ( 'newBmc', [ 
				'project_id' => $project_id,
				'error' => false,
				'owner' => $owner,
				'view_type' => $view_type 
		] );
	}
	public function createModel() {
		$myProjects = $this->getMyProjects ();
		return view ( 'createModel', [ 
				'myProjects' => $myProjects 
		] );
	}
	public function changeStatus($id) {
		$inserts = explode ( ",", $id );
		
		$project_id = $inserts [0];
		$bmc_id = $inserts [1];
		$bmc_status = $title = $_POST ["status"];
		$view_type = $inserts [2];
		$owner = $inserts [3];
		$view_type_main = $inserts [4];
		
		$bmc = BMC::find ( $bmc_id );
		dump($inserts);
		echo "status:".$bmc_status;
		echo "<br>owner:".$owner;

		
		
		switch ($bmc_status) {
			case 'inWork' :
				$bmc->status = Status::IN_WORK;
				$status = 1;
				break;
			case 'approved' :
				$bmc->status = Status::APPROVED;
				$status = 2;
				break;
			case 'rejected' :
				$bmc->status = Status::REJECTED;
				$status = 3;
				break;
		}
		
		$bmc->save ();
		
		if ($view_type == 1) { // redirects to showBMCs
			if ($view_type_main == 'models') {
				$view = 'bmc/models';
				die('models');
			} else {
				$view = 'projects/showBMCs/' . $project_id . ',' . $owner;
				die('owner');
			}
		} else { // redirects to viewBMC
			$view = '/bmc/viewBMC/' . $bmc_id . ',' . $project_id . ',' . $status . ',' . $owner . ',' . $view_type_main;
			die('view BMC');
		}
		
		return redirect ( $view );
	}
	public function saveModel() {
		$bmc = new BMC ();
		
		$bmc->title = $_POST ["title"];
		$bmc->status = Status::IN_WORK;
		$bmc->version = 1;
		$bmc->project_id = $_POST ["projects"];
		$bmc->save ();
		
		$view = 'bmc/models';
		return redirect ( $view );
	}
	public function save($id) {
		$inserts = explode ( ",", $id );
		
		$project_id = $inserts [0];
		$bmc_id = $inserts [1];
		$bmc_status = $inserts [2];
		$view_type = $inserts [3]; // 1 - showBMC.blade, 0 - viewBMC.blade
		$owner = $inserts [4];
		$view_type_main = $inserts [6]; // 'models' || 'showBMCs'
		
		$title = $_POST ["title"];
		
		if ($title == '') {
			return view ( 'newBmc', [ 
					'project_id' => $id,
					'error' => true 
			] );
		} else {
			
			if ($bmc_id == 'null') {
				$bmc = new BMC ();
			} else {
				$bmc = BMC::find ( $bmc_id );
			}
			
			$bmc->title = $title;
			
			switch ($bmc_status) {
				case 'inWork' :
					$bmc->status = Status::IN_WORK;
					$status = 1;
					break;
				case 'approved' :
					$bmc->status = Status::APPROVED;
					$status = 2;
					break;
				case 'rejected' :
					$bmc->status = Status::REJECTED;
					$status = 3;
					break;
			}
			
			$bmc->version = 1;
			$bmc->project_id = $project_id;
			$bmc->save ();
			
			if ($view_type == 1) { // redirects to showBMCs
				if ($view_type_main == 'models') {
					$view = 'bmc/models';
				} else {
					$view = 'projects/showBMCs/' . $project_id . ',' . $owner;
				}
			} else { // redirects to viewBMC
				$view = '/bmc/viewBMC/' . $bmc_id . ',' . $project_id . ',' . $status . ',' . $owner . ',0';
			}
			
			return redirect ( $view );
		}
	}
	public function viewBMC($id) {
		$inserts = explode ( ",", $id );
		
		$myPersonas = $this->getMyPersonas ();
		
		$bmc = BMC::find ( $inserts [0] );
		
		$myAssignedPersonas = $this->getAssignedPersonas ( $inserts [0] );
		
		$bmc_name = $bmc ['title'];
		
		$bmc_id = $inserts [0];
		$project_id = $inserts [1];
		$bmc_status_id = $inserts [2];
		$owner = $inserts [3];
		$view_type = $inserts [4];
		
		$bmc_postIts = $this->getBMCPostIts ( $bmc_id );
		
		switch ($bmc_status_id) {
			case 1 :
				$bmc_status = 'inWork';
				break;
			case 2 :
				$bmc_status = 'approved';
				break;
			case 3 :
				$bmc_status = 'rejected';
				break;
			default :
				$bmc_status = 'inWork';
				break;
		}
		$status_option=self::getStatusOption();
		$myProjects = $this->getMyProjects ();
		
		return view ( 'viewBMC', [ 
				'bmc_id' => $bmc_id,
				'project_id' => $project_id,
				'bmc_name' => $bmc_name,
				'bmc_status' => $bmc['status'],
				'bmc_postIts' => $bmc_postIts,
				'myPersonas' => $myPersonas,
				'myAssignedPersonas' => $myAssignedPersonas,
				'owner' => $owner,
				'view_type' => $view_type,
				'myProjects'=>$myProjects,
				'status_option'=>$status_option, 
		] );
	}
	public function getAllPersonas() {
		return Persona::all ();
	}
	public function getMyPersonas() {
		$allPersonas = $this->getAllPersonas ();
		$personas = json_decode ( $allPersonas, true );
		
		$user_id = Auth::user ()->id;
		$myPersonas = array ();
		
		foreach ( $personas as $persona ) {
			
			$assigne_id = $persona ["assignee_id"];
			
			if ($user_id == $assigne_id) {
				$temp = json_encode ( $persona );
				array_push ( $myPersonas, $persona );
			}
		}
		
		return $myPersonas;
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
	public function edit($id) {
		$inserts = explode ( ",", $id );
		
		$bmc_id = $inserts [0];
		$owner = $inserts [1];
		$view_type = $inserts [2];
		
		$bmc = BMC::find ( $bmc_id );
		
		return view ( 'newBmc', [ 
				'bmc' => json_decode ( $bmc, true ),
				'project_id' => $bmc ['project_id'],
				'error' => false,
				'owner' => $owner,
				'view_type' => $view_type 
		] );
	}
	public function copyBmc($id) {
		$inserts = explode ( ",", $id );
		
		$bmc_original_id = $inserts [0];
		$project_id = $inserts [1];
		$owner = $inserts [2];
		$view_type = $inserts [3];
		
		$bmc_original = BMC::find ( $bmc_original_id );
		$bmc_original_PostIts = $this->getBMCPostIts ( $bmc_original_id );
		$assignedPersonas = $this->getAssignedPersonas ( $bmc_original_id );
		
		$bmc_copy = new BMC ();
		$bmc_copy->title = $bmc_original ['title'] . ' (Kopie)';
		$bmc_copy->status = $bmc_original ['status'];
		$bmc_copy->version = 1;
		$bmc_copy->project_id = $bmc_original ['project_id'];
		$bmc_copy->save ();
		
		foreach ( $bmc_original_PostIts as $bmc_original_PostIt ) {
			$sort_anz = 0;
			
			$postIt = new Notice ();
			
			$postIt->title = $bmc_original_PostIt ['title'];
			$postIt->content = $bmc_original_PostIt ['content'];
			$postIt->status = $bmc_original_PostIt ['status'];
			$postIt->notice = $bmc_original_PostIt ['notice'];
			$postIt->sort = $sort_anz + 1;
			$postIt->color = '';
			$postIt->canvas_box_id = $bmc_original_PostIt ['canvas_box_id'];
			$postIt->bmc_id = $bmc_copy ['id'];
			
			$postIt->save ();
		}
		
		foreach ( $assignedPersonas as $assignedPersona ) {
			$bmc_copy = BMC::find ( $bmc_copy ['id'] );
			$bmc_copy->personas ()->attach ( $assignedPersona ['id'] );
		}
		
		if ($view_type == 'models') { // redirects to Models View or to BMC View
			$view = 'bmc/models';
		} else {
			$view = 'projects/showBMCs/' . $project_id . ',' . $owner;
		}
		return redirect ( $view );
	}
	
	/**
	 * deletes BMC
	 *
	 * @param unknown $id        	
	 * @return Ambigous <\Illuminate\Routing\Redirector, \Illuminate\Http\RedirectResponse>
	 */
	public function deleteBMC($id) {
		$inserts = explode ( ",", $id );
		
		$bmc_id = $inserts [0];
		$project_id = $inserts [1];
		$owner = $inserts [2];
		$view_type = $inserts [3];
		
		$bmc = BMC::find ( $bmc_id );
		
		// personas detachen
		$assignedPersonas = $this->getAssignedPersonas ( $bmc_id );
		
		foreach ( $assignedPersonas as $assignedPersona ) {
			$bmc->personas ()->detach ( $assignedPersona ['id'] );
		}
		
		// post-IT's löschen
		$bmcPostIts = $this->getBMCPostIts ( $bmc_id );
		
		foreach ( $bmcPostIts as $bmcPostIt ) {
			Notice::destroy ( $bmcPostIt ['id'] );
		}
		
		// BMC löschen
		BMC::destroy ( $bmc_id );
		
		if ($view_type == 'models') { // redirects to Models View or to BMC View
			$view = 'bmc/models';
		} else {
			$view = 'projects/showBMCs/' . $project_id . ',' . $owner;
		}
		
		return redirect ( $view );
	}
	public function savePostIt($id) {
		$inserts = explode ( ",", $id );
		
		$canvas_box_id = $inserts [0];
		$bmc_id = $inserts [1];
		$project_id = $inserts [2];
		$bmc_status = $inserts [3];
		$post_it_id = $inserts [4];
		$owner = $inserts [5];
		$view_type = $inserts [6];
		
		$sort_anz = $this->getNoticeCount ( $canvas_box_id . $bmc_id );
		
		$title = $_POST ["title"];
		$status = $_POST ["status"];
		$color = $_POST ["color"];
		
		
		if ($title == '') {
			print 'falsch';
		} else {
			if ($post_it_id == 'null') {
				$postIt = new Notice ();
			} else {
				$postIt = Notice::find ( $post_it_id );
			}
			
			$postIt->title = $title;
			$postIt->content = $_POST ["content"];
			
			switch ($status) {
				case 'inWork' :
					$postIt->status = Status::IN_WORK;
					break;
				case 'approved' :
					$postIt->status = Status::APPROVED;
					break;
				case 'rejected' :
					$postIt->status = Status::REJECTED;
					break;
			}
			
			$postIt->notice = $_POST ["notice"];
			$postIt->sort = $sort_anz + 1;
			$postIt->color = $color;
			$postIt->canvas_box_id = $canvas_box_id;
			$postIt->bmc_id = $bmc_id;
			
			$postIt->save ();
			
			$view = '/bmc/viewBMC/' . $bmc_id . ',' . $project_id . ',' . $bmc_status . ',' . $owner . ',' . $view_type;
			
			return redirect ( $view );
		}
	}
	public function getNoticeCount($id) {
		$inserts = str_split ( $id );
		
		$canvas_box_id = $inserts [0];
		$bmc_id = $inserts [1];
		
		$allNotices = Notice::all ();
		$canvas_Notices = null;
		
		foreach ( $allNotices as $notice ) {
			if ($notice ['canvas_box_id'] == $canvas_box_id) {
				if ($notice ['bmc_id'] == $bmc_id) {
					$canvas_Notices = $canvas_Notices + 1;
				}
			}
		}
		return $canvas_Notices;
	}
	public function deletePostIt($id) {
		$inserts = explode ( ",", $id );
		
		$post_it_id = $inserts [0];
		$bmc_id = $inserts [1];
		$project_id = $inserts [2];
		$bmc_status = $inserts [3];
		$owner = $inserts [4];
		$view_type = $inserts [5];
		
		Notice::destroy ( $post_it_id );
		
		$view = '/bmc/viewBMC/' . $bmc_id . ',' . $project_id . ',' . $bmc_status . ',' . $owner . ',' . $view_type;
		
		return redirect ( $view );
	}
	public function changePostItStatus($id) {
		$inserts = explode ( ",", $id );
		
		$project_id = $inserts [0];
		$bmc_id = $inserts [1];
		$bmc_status = $inserts [2];
		$postIt_id = $inserts [3];
		$owner = $inserts [4];
		$view_type = $inserts [5];
		
		$postIt_status = $_POST ["postIt_status"];
		
		$postIt = Notice::find ( $postIt_id );
		
		switch ($postIt_status) {
			case 'inWork' :
				$postIt->status = Status::IN_WORK;
				break;
			case 'approved' :
				$postIt->status = Status::APPROVED;
				break;
			case 'rejected' :
				$postIt->status = Status::REJECTED;
				break;
		}
		
		$postIt->save ();
		
		$view = '/bmc/viewBMC/' . $bmc_id . ',' . $project_id . ',' . $bmc_status . ',' . $owner . ',' . $view_type;
		
		return redirect ( $view );
	}
	public function addPersona(Request $request, $id) {
		$inserts = explode ( ",", $id );
		$bmc_id = $inserts [0];
		$owner = $inserts [1];
		$view_type = $inserts [2];
		
		$bmc = BMC::find ( $bmc_id );
		
		if (empty ( $bmc ))
			return "ERROR!";
		
		$personaIds = $request->input ( 'selectedPersona' );
		if (! empty ( $personaIds )) {
			// remove all existing
			$bmc->personas ()->detach ();
			// save new relations
			$bmc->personas ()->attach ( $personaIds );
			$bmc->save ();
		}
		
		switch ($bmc->status) {
			case 'inWork' :
				$status = 1;
				break;
			case 'approved' :
				$status = 2;
				break;
			case 'rejected' :
				$status = 3;
				break;
		}
		
		$view = '/bmc/viewBMC/' . $bmc->id . ',' . $bmc->project->id . ',' . $status . ',' . $owner . ',' . $view_type;
		
		return redirect ( $view );
	}
	public function getAssignedPersonas($id) {
		$bmc = BMC::find ( $id );
		return $bmc->personas ()->get ();
	}
	public function deleteAssignedPersona($id) {
		$inserts = explode ( ",", $id );
		
		$bmc_id = $inserts [0];
		$project_id = $inserts [1];
		$bmc_status = $inserts [2];
		$persona_id = $inserts [3];
		$owner = $inserts [4];
		$view_type = $inserts [5];
		
		$bmc = BMC::find ( $bmc_id );
		$bmc->personas ()->detach ( $persona_id );
		
		$view = '/bmc/viewBMC/' . $bmc->id . ',' . $project_id . ',' . $bmc_status . ',' . $owner . ',' . $view_type;
		
		return redirect ( $view );
	}
	public function models() {
		$my_projects = $this->getMyProjects ();
		$my_bmcs = $this->getMyBMC ( $my_projects );
		
		$my_assigned_Projects = $this->getMyAssignedProjects ();
		$my_assigned_Projects_Owners = $this->getAssignedProjectsOwner ();
		$my_assigned_BMCs = $this->getMyBMC ( $my_assigned_Projects );
		
		return view ( 'models', [ 
				'projects' => $my_projects,
				'bmcs' => $my_bmcs,
				'my_assigned_Projects' => $my_assigned_Projects,
				'my_assigned_Projects_Owners' => $my_assigned_Projects_Owners,
				'my_assigned_BMCs' => $my_assigned_BMCs 
		] );
	}
	public function getAllProjects() {
		return Project::all ();
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
	public function getMyBMC($projects) {
		$my_bmcs = array ();
		foreach ( $projects as $project ) {
			$project_DB = Project::find ( $project ['id'] );
			
			$bmcs = $project_DB->bmcs ()->get ();
			array_push ( $my_bmcs, $bmcs );
		}
		return $my_bmcs;
	}
	public static function getStatusOption(){
		return array(
			'inWork'=>'in work',
			'rejected'=>'rejected',
			'approved'=>'approved',
		);
	}
}
