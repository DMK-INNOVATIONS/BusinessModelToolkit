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
		
		return view ( 'persona', [ 
				'myPersonas' => $getMyPersonas 
		] );
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
		$persona = Persona::find($id);
	
		return view('newPersona', ['persona' => json_decode($persona, true)]);
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
	
	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('newPersona');
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
