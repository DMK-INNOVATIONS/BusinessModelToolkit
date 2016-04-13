<?php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use DB;

class AdminController extends Controller {
	
	public function __construct() {
		$this->middleware ( 'auth' );
	}
	
	public function index() {
		$user = $this->getRegisteredUsers();
		
		return view ( 'adminDashboard', ['user'=>$user]);
	}
	
	public function newUser() {
		return view ( 'adminNewUser');
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
}