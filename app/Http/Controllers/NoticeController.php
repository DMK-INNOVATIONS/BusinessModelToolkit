<?php namespace App\Http\Controllers;

use App\Persona;
use App\Project;
use App\User;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Auth;
use App\BMC;
use App\Notice;

class NoticeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Persona Controller
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

	public function edit($id){
		$postIT = Notice::find($id);
	
		return view('newPersona', ['postIT' => json_decode(postIT, true)]);
	}
	
	public function deletePersona($id){
		Persona::destroy($id);
	
		return redirect('persona');
	}
	
	public function save($id=null){
		$name = $_POST["name"];
	
		if($name == ''){
			print 'Falsch!!!'; //noch Fehlermeldung einfügen
			return view('newPersona');
	
		}else{
			//noch prüfen ob Titel schon in DB vorhanden ist in Kombi mit diesem Assignee
	
			if(is_null($id)){
				$persona = new Persona();
			} else {
				$persona = Persona::find($id);
			}
				
			$persona->name = $_POST["name"];
			$persona->assignee_id = Auth::user()->id;
			$persona->avatarImg = $_POST["avatarImg"];
			$persona->age = $_POST["age"];
			$persona->gender = $_POST["gender"];
			$persona->occupation = $_POST["occupation"];
			$persona->nationality = $_POST["nationality"];
			$persona->marital_status = $_POST["marital_status"];
			$persona->skills = $_POST["skills"];
			$persona->needs = $_POST["needs"];
			$persona->save();
	
			return redirect('persona');
		}
	}


	
}
