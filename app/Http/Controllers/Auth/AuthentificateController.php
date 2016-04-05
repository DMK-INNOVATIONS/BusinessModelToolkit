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
			}
			return redirect()->guest('auth/login');
		}
			
		return response()->view('errors.400');
	}
}
