<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use App\Invitation;
use Mail;
use DB;
use App\User;
use App\Project;

class AuthentificateController extends Controller {
	
	//authentificate Users
	public function authentificateUser(Request $request) {
		
		if($request->token){
			$user = User::where('email', $request->email)->first();
			if($user){
				$user->status_enable = 1;
				$user->save();
				$this->sendMessageToAdmins($user->id);
				
				$was_invited = Invitation::where(['invitee_email' => $request->email])->get();
				if(!empty($was_invited)){
					foreach($was_invited as $i){
						$project = Project::find($i['project_id']);
						$project->members()->attach($user['id']);
						$project->save();
						$invitation = Invitation::find($i['id']);
						$invitation->delete();
					}
				}
			}
			return redirect()->guest('auth/login');
		}
		return response()->view('errors.400');
	}
	
	public function sendMessageToAdmins($user_id){
		$admins = User::where('is_Admin','=','1' )->get();
		$newUser = User::find($user_id);
		
		foreach($admins as $admin){
			$email = $admin->email;
			Mail::send('registering.emailAdminNewReg', ['name'=>$newUser->name,'user_email'=>$newUser->email], function($message) use ($email)
			{
				$message->from('support@toolkit.builders', 'support@toolkit.builders');
				$message->to($email);
				$message->subject('A new User has Registered!');
			});
		}
	}
	
	public function getLogin($email)
	{
		return view('registerInvitee', ['email'=>$email]);
	}
}
