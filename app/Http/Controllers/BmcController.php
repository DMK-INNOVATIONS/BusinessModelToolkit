<?php namespace App\Http\Controllers;

use App\BMC;
use App\Status;
use App\Project;
use App\Persona;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Auth;
use App\Notice;
use App\App;
use Illuminate\Http\Request;
class BmcController extends Controller {

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
		return view('bmc');
	}
	
	public function create($id)
	{
		return view('newBmc',['project_id' => $id, 'error' => false]);
	}
	
	public function changeStatus($id){
		$inserts = explode(",", $id);
		
		$project_id = $inserts[0];
		$bmc_id = $inserts[1];
		$bmc_status = $title = $_POST["status"];
		$view_type = $inserts[3];
		
		$bmc = BMC::find($bmc_id);
			
		switch ($bmc_status) {
			case 'inWork':
				$bmc->status = Status::IN_WORK;
				$status = 1;
				break;
			case 'approved':
				$bmc->status = Status::APPROVED;
				$status = 2;
				break;
			case 'rejected':
				$bmc->status = Status::REJECTED;
				$status = 3;
				break;
		}

		$bmc->save();
			
		if($view_type == true){ //redirects to project BMCs View or to BMC View
			$view = 'projects/showBMCs/'.$project_id;
		}else{
			$view = '../public/bmc/viewBMC/'.$bmc_id.$project_id.$status;
		}
		
		return redirect($view);
		
	}
	
	public function save($id){
		$inserts= explode(",", $id); //divides Sring in 0-project_id, 1-bmc_id, 2-bmc-status[inWork, approved, rejected], 3-view_type[newBMC,viewBMC]
		
		$project_id = $inserts[0];
		$bmc_id = $inserts[1];
		$bmc_status = $inserts[2];
		$view_type = $inserts[3]; //true - newBMC.blade, false - viewBMC.blade
		
		$title = $_POST["title"];
	
		if($title == ''){ 
			return view('newBmc',['project_id' => $id, 'error' => true]);
	
		}else{
			//noch prüfen ob Titel schon in DB vorhanden ist in Kombi mit diesem Assignee
	
			if($bmc_id=='null'){
				$bmc = new BMC();
			} else {
				$bmc = BMC::find($bmc_id);
			}
	
			$bmc->title = $title;
			
			switch ($bmc_status) {
				case 'inWork':
					$bmc->status = Status::IN_WORK;
					$status = 1;
					break;
				case 'approved':
					$bmc->status = Status::APPROVED;
					$status = 2;
					break;
				case 'rejected':
					$bmc->status = Status::REJECTED;
					$status = 3;
					break;
			}
			
			$bmc->version = 1;
			$bmc->project_id = $project_id;
			$bmc->save();
			
			if($view_type == true){ //redirects to project BMCs View or to BMC View
				$view = 'projects/showBMCs/'.$project_id;
			}else{
				$view = '../public/bmc/viewBMC/'.$bmc_id.$project_id.$status;
			}

			return redirect($view);
		}
	}
	
	public function viewBMC($id){
		$inserts= str_split($id);
		
		$myPersonas = $this->getMyPersonas();
		
		$bmc = BMC::find($inserts[0]);
		
		$bmc_name= $bmc['title'];
		
		$bmc_id = $inserts[0];
		$project_id = $inserts[1];
		$bmc_status_id = $inserts[2];
		
		$bmc_postIts = $this->getBMCPostIts($bmc_id);
		
		switch ($bmc_status_id) {
			case 1:
				$bmc_status = 'inWork';
				break;
			case 2:
				$bmc_status = 'approved';
				break;
			case 3:
				$bmc_status = 'rejected';
				break;
		}
	
		return view('viewBMC', ['bmc_id' => $bmc_id, 'project_id' => $project_id, 'bmc_name' => $bmc_name, 'bmc_status' => $bmc_status, 'bmc_postIts' => $bmc_postIts, 'myPersonas' =>$myPersonas]);
	}
	
	public function getAllPersonas() {
		return Persona::all ();
	}
	
	public function getMyPersonas(){
		$allPersonas = $this->getAllPersonas();
		$personas = json_decode($allPersonas, true);
	
		$user_id = Auth::user()->id;
		$myPersonas = array();
	
		foreach ($personas as $persona){
	
			$assigne_id = $persona["assignee_id"];
	
			if($user_id == $assigne_id){
				$temp = json_encode($persona);
				array_push($myPersonas, $persona);
			}
		}
	
		return $myPersonas;
	}
	
	public function getBMCPostIts($bmc_id){
		$getAllPostIts = Notice::all();
		$bmcPostIts = array();
		
		$dbPostIts = json_decode($getAllPostIts, true);
		
		foreach ($dbPostIts as $dbPostIt){
			if ($dbPostIt["bmc_id"] == $bmc_id){
				array_push($bmcPostIts, $dbPostIt);
			}
		}
		return $bmcPostIts;
	}
	
	public function edit($id){
		$bmc = BMC::find($id);
		
		return view('newBmc',['bmc' =>json_decode($bmc, true) ,'project_id' => $bmc['project_id'], 'error' => false]);
	}
	
	/**
	 * deletes BMC
	 * @param unknown $id
	 * @return Ambigous <\Illuminate\Routing\Redirector, \Illuminate\Http\RedirectResponse>
	 */
	public function deleteBMC($id){
		$inserts= str_split($id);
		
		BMC::destroy($inserts[0]);
	
		$project_id = $inserts[1];
		$view = 'projects/showBMCs/'.$project_id;
			
		return redirect($view);
	}
	
	public function savePostIt($id){
		$inserts= explode(",", $id);
		
		$canvas_box_id = $inserts[0];
		$bmc_id = $inserts[1];
		$project_id = $inserts[2];
		$bmc_status = $inserts[3];
		$post_it_id = $inserts[4];
		
		$sort_anz = $this->getNoticeCount($canvas_box_id.$bmc_id);

		$title = $_POST["title"];
		$status = $_POST["status"];
		
		if($title == ''){
			print 'falsch';
		}else{
 			if($post_it_id=='null'){
 				$postIt = new Notice();
 			} else {
 				$postIt = Notice::find($post_it_id);
 			}
			
 			$postIt->title = $title;
 			$postIt->content = $_POST["content"];
			
 			switch ($status) {
 				case 'inWork':
 					$postIt->status = Status::IN_WORK;
 					break;
 				case 'approved':
 					$postIt->status = Status::APPROVED;
 					break;
 				case 'rejected':
 					$postIt->status = Status::REJECTED;
 					break;
 			}
			
 			$postIt->notice = $_POST["notice"];
 			$postIt->sort = $sort_anz+1;
 			$postIt->canvas_box_id = $canvas_box_id;
 			$postIt->bmc_id = $bmc_id;

 			$postIt->save();
				
 			$view = '../public/bmc/viewBMC/'.$bmc_id.$project_id.$bmc_status;
			
 			return redirect($view);
		}
	}
	
	public function getNoticeCount($id){
		$inserts= str_split($id);
		
		$canvas_box_id = $inserts[0];
		$bmc_id = $inserts[1];
		
		$allNotices = Notice::all();
		$canvas_Notices = null;
		
		foreach ($allNotices as $notice){
			if($notice['canvas_box_id'] == $canvas_box_id){
				if($notice['bmc_id'] == $bmc_id){
					$canvas_Notices = $canvas_Notices +1;
				}
			}
		}
		return $canvas_Notices;
	}
	
	public function deletePostIt($id){
		$inserts= str_split($id);
	
		$post_it_id = $inserts[0];
		$bmc_id = $inserts[1];
		$project_id = $inserts[2];
		$bmc_status = $inserts[3];

		Notice::destroy($post_it_id);
	
		$view = '../public/bmc/viewBMC/'.$bmc_id.$project_id.$bmc_status;
			
 		return redirect($view);
	}
	
	public function changePostItStatus($id){
		$inserts = explode(",", $id);
	
		$project_id = $inserts[0];
		$bmc_id = $inserts[1];
		$bmc_status = $inserts[2];
		$postIt_id = $inserts[3];
		$postIt_status = $_POST["postIt_status"];
	
		$postIt = Notice::find($postIt_id);
			
		switch ($postIt_status) {
			case 'inWork':
				$postIt->status = Status::IN_WORK;
				break;
			case 'approved':
				$postIt->status = Status::APPROVED;
				break;
			case 'rejected':
				$postIt->status = Status::REJECTED;
				break;
		}
	
		$postIt->save();
			
		$view = '../public/bmc/viewBMC/'.$bmc_id.$project_id.$bmc_status;
	
		return redirect($view);
	}
	
	public function addPersona(Request $request, $id){
		$bmc = BMC::find($id);
		
		if(empty($bmc)) return "ERROR!";
		
		$personaIds = $request->input('selectedPersona');
		if(!empty($personaIds)){
			// remove all existing
			$bmc->personas()->detach();
			// save new relations
			$bmc->personas()->attach($personaIds);
			$bmc->save();
		}
		
		switch ($bmc->status) {
			case 'inWork':
				$status = 1;
				break;
			case 'approved':
				$status = 2;
				break;
			case 'rejected':
				$status = 3;
				break;
		}
		
		//print($bmc->personas()->get());
		
		$view = '../public/bmc/viewBMC/'.$bmc->id.$bmc->project->id.$status;
		
		return redirect($view);
	}
}
