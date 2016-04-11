<?php namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class Controller extends BaseController {

	use DispatchesCommands, ValidatesRequests;
	
	public function getPath(){
		if ($_SERVER ['SERVER_NAME'] == 'bmc.extranet.local' || $_SERVER ['SERVER_NAME'] == 'localhost' && $_SERVER ['REMOTE_ADDR'] == '127.0.0.1') {
			return '/public';
		} else {
			return '';
		}
	}

}
