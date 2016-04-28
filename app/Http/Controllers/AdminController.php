<?php
namespace App\Http\Controllers;

use App\BMC;
use App\Notice;
use App\Persona;
use App\Project;
use App\User;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mail;

class AdminController extends Controller {
	
	public function __construct() {
		$this->middleware ( 'auth' );
	}
	
	/* *************** Shows the Admin Dashboard  *************** */
	public function index() {
		$user = $this->getRegisteredUsers();
		$myProjects = Project::where('assignee_id', '=', Auth::user ()->id)->get();

		return view ( 'adminDashboard', ['user'=>$user, 'myProjects'=>$myProjects]);
	}
	public function getRegisteredUsers(){
		$user = User::all();
		$sortedUsers= array();
	
		foreach($user as $u){
			if($u['status_enable']){
				$projects = $this->getUserProjects($u['id']);
				array_push($sortedUsers, [
						'id' => $u['id'],
						'name' => $u['name'],
						'email' => $u['email'],
						'is_Admin' => $u['is_Admin'],
						'last_Login' => $u['last_Login'],
						'projects' => $projects
				]);
			}
		}
		return $sortedUsers;
	}
	
	public function getUserProjects($user_id){
		$userProjects = DB::table('projects')->select('id', 'title', 'created_at', 'updated_at')->where('assignee_id', $user_id)->get();
		return $userProjects;
	}
	
	/* *************** Adds a new User  *************** */
	public function newUser() {
		return redirect('adminDashboard');
	}
	
	/* *************** Gives or Takes Admin Rights  *************** */
	public function handleAdminRights($id){
		$inserts = explode ( ",", $id );
		
		$user_id = $inserts[0];
		$request = $inserts[1];
		
		$user = User::find($user_id);
		
		if($request == 'add'){
			$user->is_Admin = '1';
			$user->save();
			return redirect('adminDashboard');
		}else{
			$user->is_Admin = '0';
			$user->save();
			return redirect('adminDashboard');
		}
	}
	
	/* *************** deletes a User and all of his Elements *************** */
	public function deleteUser($user_id){
		$this->deleteUserElements($user_id);
		
		User::destroy($user_id); //deletes the User
		return redirect('adminDashboard');
	}
	
	public function deleteUserElements($user_id){
		$projectsOfUser = Project::where('assignee_id', '=', $user_id)->get();
		$personasOfUser = Persona::where('assignee_id', '=', $user_id)->get();

		if(!empty($projectsOfUser)){
			foreach($projectsOfUser as $projectOfUser){ // deletes all Projects of a User
				$bmcsOfProject = BMC::where('project_id', '=', $projectOfUser['id'])->get();
				if(!empty($projectOfUser)){
					foreach($bmcsOfProject as $bmcOfProject){ // deletes all BMC of a Project
						$noticesOfBmc = Notice::where('bmc_id', '=', $bmcOfProject['id'])->get();
						if(!empty($bmcOfProject)){
							foreach($noticesOfBmc as $noticeOfBmc){ // deletes all Notices of a BMC
								if(!empty($noticeOfBmc)){
									Notice::destroy($noticeOfBmc['id']);
								}
							}
							BMC::destroy($bmcOfProject['id']);
						}
					}
					
					$project = Project::find($projectOfUser['id']);
					$assignedTeamMembers = $project->members()->get();
					
					foreach ($assignedTeamMembers as $assignedTeamMember){ //detaches assignes users from Project
						if($assignedTeamMember['pivot']['user_id'] == $user_id){
							$project->members()->detach($user_id);
						}		
					}
					Project::destroy($projectOfUser['id']);
				}
			}
		}
		
		if(!empty($personasOfUser)){
			foreach($personasOfUser as $personaOfUser){
				if(!empty($personaOfUser['id'])){
					Persona::destroy($personaOfUser['id']);
					
				}
			}
		}
		
		$assignedProjects = DB::table('project_members')->where('user_id', '=', $user_id)->get();
		
		if(!empty($assignedProjects)){
			foreach ($assignedProjects as $assignedProject){ //detaches the User from the projects he was assigned to
				$project = Project::find($assignedProject->project_id);
				$project->members()->detach($assignedProject->user_id);
			}
		}
	}
	
	/* *************** creates a new User with or without Admin Rights *************** */
	public function createNewUser(){
		$token = Input::get('_token');
		$username = Input::get('username');
		$email = Input::get('email');
		$password = bcrypt(Input::get('password'));
		$password_confirmation = bcrypt(Input::get('password_confirmation'));
		$is_admin = Input::get('is_admin');
		
		$user = $this->getRegisteredUsers();
		$myProjects = Project::where('assignee_id', '=', Auth::user ()->id)->get();
		
		if(Input::get('password') == Input::get('password_confirmation')){
			if(strlen(Input::get('password')) >= 6){
				if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
					$newUser = User::create([
							'name' => $username,
							'email' => $email,
							'password' => $password,
							'remember_token' => '',
							'status_enable' => '0',
							'is_Admin' => '0'
					]);
					if(Input::get('is_admin')=='Admin'){
						$insert = $newUser->id.',add';
						$this->handleAdminRights($insert);
					}
					Mail::send('registering.emailAdminNewUser', ['token'=>$token, 'email'=>$email, 'password' => Input::get('password')], function($message) use ($email)
					{
						$message->from('support@toolkit.builders', 'support@toolkit.builders');
						$message->to($email);
						$message->subject('Complete your toolkit.builders sign up');
					});
					$message = 'The new User <b>was created successfully</b> and has received an activation email.';
					$color = 'success';
				}else{
					$message = 'The received <b>E-Mail Address is not valid</b>.';
					$color = 'danger';
				}
			}
			else{
				$message = 'The password <b>must be at least 6 characters</b>.';
				$color = 'danger';
			}
		}else{
			$message = 'The <b>password confirmation</b> does not match.';
			$color = 'danger';
		}
		$id = $message.','.$color;
		return redirect()->back()->with('data', $id);
	}
	
	/* *************** edit's a User *************** */
	public function adminEditUser($user_id){
		$path = $this->getPath();
		return view('profile', ['user' => json_decode ( User::find($user_id), true ), 'path' => $path]);
	}
}