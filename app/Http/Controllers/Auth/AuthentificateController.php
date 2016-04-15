<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Mail;
use DB;
use App\User;

class AuthentificateController extends Controller {
	
	//authentificate Users
	public function authentificateUser(Request $request) {
		
		if($request->token){
			$user = User::where('email', $request->email)->first();
			if($user){
				$user->status_enable = 1;
				$user->save();
				$this->sendMessageToAdmins($user->id);
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
}
