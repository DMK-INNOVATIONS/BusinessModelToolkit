<?php


namespace App\Http\Controllers;

use App\Persona;
use App\User;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Auth;

class PersonaController extends Controller {
	
	/*
	 * |--------------------------------------------------------------------------
	 * | Persona Controller
	 * |--------------------------------------------------------------------------
	 * |
	 * |
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
		$getMyPersonas = $this->getMyPersonas();
		
		return view ( 'persona', ['myPersonas' => $getMyPersonas]);
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
	
	public function edit($id){
		$inserts = explode(",", $id);
		
		$persona_id = $inserts[0];
		$view_type = $inserts[1];
		$bmc_id = $inserts[2];
		$project_id = $inserts[3];
		$bmc_status = $inserts[4];
		$owner = $inserts[5];
		
		$persona = Persona::find($id);
		
		return view('newPersona', ['view_type' => $view_type, 'bmc_id' => $bmc_id, 'project_id' => $project_id, 'bmc_status' =>$bmc_status, 'persona' => $persona, 'owner' => $owner]);
	}
	
	public function deletePersona($id){
		Persona::destroy($id);
	
		return redirect('persona');
	}
	
	public function save($id){
		
		$inserts = explode(",", $id);
		
		$persona_id = $inserts[0];
		$view_type = $inserts[1];
		$bmc_id = $inserts[2];
		$project_id = $inserts[3];
		$bmc_status = $inserts[4];	
		$owner = $inserts[5];
		
		$name = $_POST["name"];
		
		if($name == ''){
			print 'Falsch!!!'; //noch Fehlermeldung einfügen
			return view('newPersona');
	
		}else{
			//noch prüfen ob Titel schon in DB vorhanden ist in Kombi mit diesem Assignee
	
			if($persona_id == 'null'){
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
			$persona->quote = $_POST["quote"];
			$persona->personality = $_POST["personality"];
			$persona->skills = $_POST["skills"];
			$persona->needs = $_POST["needs"];
			$persona->save();
	
			if($view_type == 'persona'){
				return redirect('persona');
			}else {
				$view = '../public/bmc/viewBMC/'.$bmc_id.','.$project_id.','.$bmc_status.','.$owner;
					
				return redirect($view);
			}
		}
	}
	
	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function create($id)
	{
		$inserts = explode(",", $id);
		
		$view_type = $inserts[0];
		$bmc_id = $inserts[1];
		$project_id = $inserts[2];
		$bmc_status = $inserts[3];
		$owner = $inserts[4];
		
		return view('newPersona', ['view_type' => $view_type, 'bmc_id' => $bmc_id, 'project_id' => $project_id, 'bmc_status' =>$bmc_status, 'owner' => $owner]);
	}
	
	/**
	 * Validierung der Nutzereingaben vor der Speicheroperation.
	 * TODO Sollte man sicherlich noch einbauen!
	 */
	public function eingabeKorrekt(){
		$validator = Validator::make(Input::all(), array(
				'title' => '$project_title'
		));
	
		if($validator->fails){
			return Redirect::action(NewProjectController::index());
		}
		return Redirect::action(NewProjectController::createNewProject());
	}
}
