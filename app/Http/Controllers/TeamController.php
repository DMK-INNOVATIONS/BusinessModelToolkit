<?php namespace App\Http\Controllers;

use App\Project;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Invitation;
use Mail;
use Carbon\Carbon;
use DateTime;
class TeamController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Team Controller
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
		$invitations = $this->sortInvitations();
		
		return view('team', ['assignedTeamMembers' => $assignedTeamMembers, 'myProjects' => $myProjects, 'invitations'=> $invitations]);
	}
	
	public function getAssignedTeamMembers(){
		$allProjects = Project::all();
		$user_id = Auth::user()->id;
		$myAssignedTeamMembers = array();
		
		foreach($allProjects as $project){
			if($project['assignee_id'] == $user_id){
				$projekt = Project::find($project['id']);
				$assignedTeamMembers = $projekt->members()->get();
				
				$project_id = 'n';
				
				foreach($assignedTeamMembers as $assignedTeamMember){
					
					if($assignedTeamMember['pivot']['project_id'] == $project['id']){
						if($project_id != $project['id']){
							array_push($myAssignedTeamMembers, $assignedTeamMembers);
							$project_id = $project['id'];
						}
						
					}
					
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
	
	public function delete($id){
		$inserts= explode(",", $id);
		
		$project_id = $inserts[0];
		$user_id = $inserts[1];
		
		$project = Project::find($project_id);
		$assignedTeamMembers = $project->members()->get();
		
		foreach ($assignedTeamMembers as $assignedTeamMember){
			if($assignedTeamMember['pivot']['user_id'] == $user_id){
				$project->members()->detach($user_id);
				
				return redirect('team');
			}		
		}
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
		$token = Input::get('_token');
		$teamMemberEmail = Input::get('Email');
		$project_id = Input::get('projects');
		$project = Project::find($project_id);
		$project_name = $project['title'];
		$inviter_id = $project['assignee_id'];
		$myProjects = $this->getMyProjects();
		$inviter = User::find($inviter_id);
		$inviterMail = $inviter['email'];
		$teamMember = User::where('email',$teamMemberEmail)->get();
		$teamMemberId = '';
		$allreadyConnected = false;
		
		if(!empty($teamMember)){
			foreach($teamMember as $t){
				$teamMemberId =  $t['id'];
			}
		}
		
		if(is_numeric($teamMemberId)){
			$assignedTeamMembers = $project->members()->get();
			
			foreach ($assignedTeamMembers as $assignedTeamMember){
				if ($assignedTeamMember['id'] == $teamMemberId){
					$errorMessage = 'There is already a connection between '.$assignedTeamMember['name'].' and your Project: '.$project['title'].'.';
					$allreadyConnected = true;
					
					return redirect('team')->with('error', $errorMessage);
				}
			}
			
			$project->members()->attach($teamMemberId);
			$project->save();
			
			return redirect('team');
		}else{
			$is_Invitee_already_invited = Invitation::where(['inviter_id' =>$inviter_id, 'invitee_email' => $teamMemberEmail])->get();
			$newInvitee = Invitation::where(['invitee_email' => $teamMemberEmail, 'project_id' => $project_id])->get();
			if(!empty($newInvitee)){
				if(count($is_Invitee_already_invited) >=1){//keine message schicken + hinzufügen zu Invitations Tabelle
					$this->saveInvitation($inviter_id, $teamMemberEmail, $project_id);
					
					return redirect('team');
				}else{// message versenden + hinzufügen zu Invitations Tabelle
					$this->saveInvitation($inviter_id, $teamMemberEmail, $project_id);
					
					$this->sendMessageToInvitee($token, $teamMemberEmail, $inviterMail, $project_name);
					
					return redirect('team');
				}
			}else{
				$message = 'There is already a connection between '.$teamMemberEmail.' and your Project.';
				return redirect('team')->with('error', $message);
			}
		}
	}
	
	public function saveInvitation($inviter_id, $teamMemberEmail, $project_id){
		$invitation = new Invitation();
		$invitation->inviter_id = $inviter_id;
		$invitation->invitee_email = $teamMemberEmail;
		$invitation->project_id = $project_id;
		$invitation->assigned_on = Carbon::now('Europe/Berlin');
		$invitation->expires_on = Carbon::now('Europe/Berlin')->addDays(30);
		$invitation->save();
	}
	
	public function sendMessageToInvitee($token, $email, $inviterMail, $project_name){
		Mail::send('registering.emailTeamNewInvitee', ['token'=>$token, 'email'=>$email, 'inviterMail'=>$inviterMail, 'project_name'=>$project_name], function($message) use ($email)
		{
			$message->from('support@toolkit.builders', 'support@toolkit.builders');
			$message->to($email);
			$message->subject('You where invited to a toolkit.builders Project');
				
		});
	}
	public function sortInvitations(){
		$invitations = Invitation::where(['inviter_id' => Auth::user()->id])->get();
		$invitationArray = array();
		
		foreach($invitations as $invitation){
			$project = Project::find($invitation['project_id']);
			$project_name = $project['title'];
			
			$datetime1 = new DateTime($invitation['assigned_on']);
			$datetime2 = new DateTime($invitation['expires_on']);
			$diff = $datetime1->diff($datetime2);
			array_push($invitationArray, ['id'=>$invitation['id'],'inviter_id'=>$invitation['inviter_id'], 'invitee_email'=>$invitation['invitee_email'], 'project_id'=>$invitation['project_id'], 'project_name'=>$project_name, 'created_at'=>$invitation['created_at'], 'assigned_on' =>$invitation['assigned_on'], 'expires_on' =>$diff->format('%a')]);
		}
		
		return $invitationArray;
	}
	
}
