<?php namespace App\Http\Controllers;

use App\Project;
use App\User;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Auth;
use App\BMC;
use App\Notice;
use HTML2PDF;

class ExportController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Bmc Controller
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
	
	public function index($id){
		$inserts = explode(",", $id);
		
		$bmc_id = $inserts[0];
		$project_id = $inserts[1];
		$owner = $inserts[2];
		$view_type = $inserts[3];
		
		$getBMCProject = $this->getBMCProject($project_id);
		$getBMC = $this->getBMC($bmc_id);
		$getBMCNotices = $this->getBMCNotices($bmc_id);
		$getBMCPersonas = $this->getBMCPersonas($bmc_id);
		
		return view ( 'export', ['project' => $getBMCProject, 'bmc' => $getBMC, 'notices' => $getBMCNotices, 'personas' =>$getBMCPersonas, 'owner' => $owner, 'view_type' => $view_type] );
	}
	
	public function getBMCProject($id){
		$project = Project::find ($id);
		return $project;
	}
	
	public function getBMC($id){
		$bmc = BMC::find($id);
		return $bmc;
	}
	
	public function getBMCNotices($bmc_id){
		$getAllPostIts = Notice::all();
		$bmcPostIts = array();
		
		$dbPostIts = json_decode($getAllPostIts, true);
		
		foreach ($dbPostIts as $dbPostIt){
			if ($dbPostIt["bmc_id"] == $bmc_id){
				array_push($bmcPostIts, $dbPostIt);
			}
		}
		return $bmcPostIts;
	}
	
	public function getBMCPersonas($bmc_id){
		$bmc = BMC::find($bmc_id);
		$personas = $bmc->personas()->get();
		return $personas;
	}
	
	public function export($id){
		
		require_once('libraries/html2pdf.class.php');
		
		$inserts = explode(",", $id);
		
		$bmc_id = $inserts[0];
		$project_id = $inserts[1];
		$owner = $inserts[2];
		$format = $inserts[3];
		$date = date('Y_m_d');
		
		$bmc = $this->getBMC($bmc_id);
		$project = $this->getBMCProject($project_id);
		
		$user = User::find($project['assignee_id']);
		
		if($format == 'P'){
			$doc = $this->portrait($bmc_id.','.$project_id);	
		}else{
			$doc = $this->landscape($bmc_id.','.$project_id);
		}
			
		$html2pdf = new HTML2PDF($format,'A4','de', true, 'UTF-8');
   	 	$html2pdf->setDefaultFont('arialunicid0');
		$html2pdf->pdf->SetTitle($bmc['title']);
		$html2pdf->pdf->SetAuthor($user['name']);
		$html2pdf->setDefaultFont('Arial');
		$html2pdf->pdf->SetDisplayMode('fullpage');
		$html2pdf->writeHTML($doc, false);
		$datei=$bmc['title'].'-'.$date.'.pdf';
		$html2pdf->Output($datei, 'I');
// 		$html2pdf->Output($datei, 'D');
	}
	
	public function getStatusColor($status){
		$color = '';
		switch ($status) {
			case 'inWork':
				$color = '#F8D19C,#9C6619,#9C6619'; //background-color,border-color,color
				break;
			case 'approved':
				$color = '#9FDC9F,#1E781E,#1E781E';
				break;
			case 'rejected':
				$color = '#E48582,#83110E,#83110E';
				break;
		}	
		
		return $color;
	}
	
	public function getContent($id){
		$inserts = explode(",", $id);
		
		$bmc_id = $inserts[0];
		$canvas_box_id = $inserts[1];
		$box_width = $inserts[2];
		
		$notices = $this->getBMCNotices($bmc_id);
		$personas = $this->getBMCPersonas($bmc_id);
		
		if($canvas_box_id == 7){ //Customer Segments
			$content = '<div style="background-color:#ffffff; padding:5px; margin: 5px; width:'.$box_width.';"></div>';
			foreach($personas as $persona){
				if($content == '<div style="background-color:#ffffff; padding:5px; margin: 5px; width:'.$box_width.';"></div>'){
					$temp = '<div style="background-color:#ffffff; padding:5px; margin: 5px; border:1px solid #000000; color: #000000; border-radius:5px; width:'.$box_width.';"><b>'.$persona['name'].'</b><br>'.$persona['age'].'<br>'.$persona['occupation'].'</div>';
					$content = $temp;
				}else{
					$temp = $content.'<div style="background-color:#ffffff; padding:5px; margin: 5px; border:1px solid #000000; color: #000000; border-radius:5px; width:'.$box_width.';"><b>'.$persona['name'].'</b><br>'.$persona['age'].'<br>'.$persona['occupation'].'</div>';
					$content = $temp;
				}
			}
		}else{
			$content = '<div style="background-color:#ffffff; padding:5px; margin: 5px; width:'.$box_width.';"></div>'; //Inhalt wenn keine Notiz vorhanden
			
			foreach($notices as $notice){
				if($canvas_box_id == $notice['canvas_box_id']){
					$status_colors = $this->getStatusColor($notice['status']);
					$colors = explode(",", $status_colors);
					
					$backgroundColor = $colors[0];
					$borderColor = $colors[1];
					$fontColor = $colors[2];
					
					if($content == '<div style="background-color:#ffffff; padding:5px; margin: 5px; width:'.$box_width.';"></div>'){
						$temp = '<div style="background-color:'.$backgroundColor.'; padding:5px; margin: 5px; border:1px solid '.$borderColor.'; color: '.$fontColor.'; border-radius:5px; width:'.$box_width.';"><b>'.$notice['title'].'</b><br>'.$notice['content'].'</div>';
						$content = $temp;
					}else{
						$temp = $content.'<div style="background-color:'.$backgroundColor.'; padding:5px; margin: 5px; border:1px solid '.$borderColor.'; color: '.$fontColor.'; border-radius:5px; width:'.$box_width.';"><b>'.$notice['title'].'</b><br>'.$notice['content'].'</div>';
						$content = $temp;
					}	
				}
			}
		}
		return $content;
	}
	
	public function portrait($id){
		$inserts = explode(",", $id);
		
		$bmc_id = $inserts[0];
		$project_id = $inserts[1];
		
		$bmc = $this->getBMC($bmc_id);
		$project = $this->getBMCProject($project_id);
		
		$created_at = explode(' ', $bmc["created_at"]);
		$created_at_date = $created_at[0];
		$created_at_time = $created_at[1];
		
		$user = User::find($project['assignee_id']);
		
		$canvas_box_1 = $this->getContent($bmc_id.',1,100px');
		$canvas_box_2 = $this->getContent($bmc_id.',2,100px');
		$canvas_box_3 = $this->getContent($bmc_id.',3,100px');
		$canvas_box_4 = $this->getContent($bmc_id.',4,100px');
		$canvas_box_5 = $this->getContent($bmc_id.',5,100px');
		$canvas_box_6 = $this->getContent($bmc_id.',6,100px');
		$canvas_box_7 = $this->getContent($bmc_id.',7,100px');
		$canvas_box_8 = $this->getContent($bmc_id.',8,240px');
		$canvas_box_9 = $this->getContent($bmc_id.',9,240px');
		
		$content ='
		<page backtop="7mm" backbottom="7mm" backleft="10mm" backright="10mm">
			<table style="border: 1 solid #7f939b; border-radius: 4px; vertical-align: top; background-color: #dfe4e6; color:#7f939b;">
				<tr>
					<td colspan="5" style="background-color: #f5f5f5; border: 1 solid #7f939b; padding: 10px 15px; text-align:center;"><b>'.$bmc['title'].'</b></td>
				</tr>
				<tr>
					<td style="vertical-align: top;">
						<table>
							<tr>
								<td>
									<div style="background-color: #ffffff; border: 1 solid #7f939b; border-radius: 4px;">
										<div style="background-color: #f5f5f5; border-bottom: 1 solid #7f939b; padding: 2px 10px; text-align:center;"><b>Key <br>Partners</b></div>
										'.$canvas_box_1.'	
									</div>
								</td>
							</tr>
						</table>
					</td>
		
					<td style="vertical-align:top;">
						<table>
							<tr>
								<td>
									<div style="border: 1 solid #7f939b; border-radius: 3px; vertical-align: top; background:#ffffff;">
										<div style="background-color: #f5f5f5; border-bottom: 1 solid #7f939b; padding: 2px 10px; text-align:center;"><b>Key <br>Activities</b></div>
										'.$canvas_box_2.'
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<div style="border: 1 solid #7f939b; border-radius: 3px; vertical-align: top; background:#ffffff;">
										<div style="background-color: #f5f5f5; border-bottom: 1 solid #7f939b; padding: 2px 10px; text-align:center;"><b>Key <br>Ressources</b></div>
										'.$canvas_box_3.'
									</div>
								</td>
							</tr>
						</table>
					</td>
		
					<td style="vertical-align:top;">
						<table>
							<tr>
								<td>
									<div style="border: 1 solid #7f939b; border-radius: 3px; vertical-align: top; background:#ffffff;">
										<div style="background-color: #f5f5f5; border-bottom: 1 solid #7f939b; padding: 2px 10px; text-align:center;"><b>Value<br>Propositions</b></div>
										'.$canvas_box_4.'
									</div>
								</td>
							</tr>
						</table>
					</td>
		
					<td style="vertical-align:top;">
						<table>
							<tr>
								<td>
									<div style="background-color: #ffffff; border: 1 solid #7f939b; border-radius: 4px;">
										<div style="background-color: #f5f5f5; border-bottom: 1 solid #7f939b; padding: 2px 10px; text-align:center;"><b>Customer<br>Relationships</b></div>
										'.$canvas_box_5.'
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<div style="background-color: #ffffff; border: 1 solid #7f939b; border-radius: 4px;">
										<div style="background-color: #f5f5f5; border-bottom: 1 solid #7f939b; padding: 2px 10px; text-align:center;"><b>Channels</b><br><br></div>
										'.$canvas_box_6.'
									</div>
								</td>
							</tr>
						</table>
					</td>
		
					<td style="vertical-align: top;">
						<table>
							<tr>
								<td>
									<div style="border: 1 solid #7f939b; border-radius: 3px; vertical-align: top; background:#ffffff;">
										<div style="background-color: #f5f5f5; border-bottom: 1 solid #7f939b; padding: 2px 10px; text-align:center; width:100px;"><b>Customer<br>Segments</b></div>
										'.$canvas_box_7.'
									</div>
								</td>
							</tr>
						</table>
					</td>
			    </tr>
			    <tr>
					<td colspan="2">
						<table>
							<tr style="vertical-align:top; width:250px;">
								<td>
									<div style="background-color: #ffffff; border: 1 solid #7f939b; border-radius: 4px;">
										<div style="background-color: #f5f5f5; border-bottom: 1 solid #7f939b; padding: 2px 10px; text-align:center;"><b>Cost Structure</b></div>
										'.$canvas_box_8.'
									</div>
								</td>
							</tr>
						</table>
					</td>
					<td colspan="2">
						<table>
							<tr style="vertical-align:top; width:250px;">
								<td>
									<div style="background-color: #ffffff; border: 1 solid #7f939b; border-radius: 4px;">
										<div style="background-color: #f5f5f5; border-bottom: 1 solid #7f939b; padding: 2px 10px; text-align:center;"><b>Revenue Streams</b></div>
										'.$canvas_box_9.'
									</div>
								</td>
							</tr>
						</table>
					</td>
			    </tr>
		
				<tr>
					<td colspan="5" style="background-color: #ffffff; color:#7f939b; border: 1 solid #7f939b; padding: 5px; text-align:center; font-size:10px; color: grey;">Project Title: '.$project['title'].', Created by: '.$user['name'].', Created on: '.$created_at_date.', '.$created_at_time.'</td>
				</tr>
			</table>
		</page>
		';
		return $content;
	}
	
	public function landscape($id){
		
		$inserts = explode(",", $id);
		
		$bmc_id = $inserts[0];
		$project_id = $inserts[1];
		
		$bmc = $this->getBMC($bmc_id);
		$project = $this->getBMCProject($project_id);
		
		$created_at = explode(' ', $bmc["created_at"]);
		$created_at_date = $created_at[0];
		$created_at_time = $created_at[1];
		
		$user = User::find($project['assignee_id']);
		
		$canvas_box_1 = $this->getContent($bmc_id.',1,160px');
		$canvas_box_2 = $this->getContent($bmc_id.',2,160px');
		$canvas_box_3 = $this->getContent($bmc_id.',3,160px');
		$canvas_box_4 = $this->getContent($bmc_id.',4,160px');
		$canvas_box_5 = $this->getContent($bmc_id.',5,160px');
		$canvas_box_6 = $this->getContent($bmc_id.',6,160px');
		$canvas_box_7 = $this->getContent($bmc_id.',7,160px');
		$canvas_box_8 = $this->getContent($bmc_id.',8,355px');
		$canvas_box_9 = $this->getContent($bmc_id.',9,355px');
		
		$content='
		<page backtop="7mm" backbottom="7mm" backleft="10mm" backright="10mm">
			<table style="border: 1 solid #7f939b; border-radius: 4px; vertical-align: top; background-color: #dfe4e6; color:#7f939b; width:100%; font-size: 11px;">
				<tr>
					<td colspan="5" style="background-color: #f5f5f5; border: 1 solid #7f939b; padding: 10px 15px; text-align:center; font-size: 15px;"><b>'.$bmc['title'].'</b></td>
				</tr>
				<tr>
					<td style="vertical-align: top;">
						<table>
							<tr>
								<td>
									<div style="background-color: #ffffff; border: 1 solid #7f939b; border-radius: 4px;">
										<div style="background-color: #f5f5f5; border-bottom: 1 solid #7f939b; padding: 10px 15px; text-align:center; font-size: 15px;"><b>Key <br>Partners</b></div>
										'.$canvas_box_1.'
									</div>
								</td>
							</tr>
						</table>
					</td>
			
					<td style="vertical-align:top;">
						<table>
							<tr>
								<td>
									<div style="border: 1 solid #7f939b; border-radius: 3px; vertical-align: top; background:#ffffff;">
										<div style="background-color: #f5f5f5; border-bottom: 1 solid #7f939b; padding: 10px 15px; text-align:center; font-size: 15px;"><b>Key <br>Activities</b></div>
										'.$canvas_box_2.'
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<div style="border: 1 solid #7f939b; border-radius: 3px; vertical-align: top; background:#ffffff;">
										<div style="background-color: #f5f5f5; border-bottom: 1 solid #7f939b; padding: 10px 15px; text-align:center; font-size: 15px;"><b>Key <br>Ressources</b></div>
										'.$canvas_box_3.'
									</div>
								</td>
							</tr>
						</table>
					</td>
			
					<td style="vertical-align:top;">
						<table>
							<tr>
								<td>
									<div style="border: 1 solid #7f939b; border-radius: 3px; vertical-align: top; background:#ffffff;">
										<div style="background-color: #f5f5f5; border-bottom: 1 solid #7f939b; padding: 10px 15px; text-align:center; font-size: 15px;"><b>Value<br>Propositions</b></div>
										'.$canvas_box_4.'
									</div>
								</td>
							</tr>
						</table>
					</td>
			
					<td style="vertical-align:top;">
						<table>
							<tr>
								<td>
									<div style="background-color: #ffffff; border: 1 solid #7f939b; border-radius: 4px;">
										<div style="background-color: #f5f5f5; border-bottom: 1 solid #7f939b; padding: 10px 15px; text-align:center; font-size: 15px;"><b>Customer<br>Relationships</b></div>
										'.$canvas_box_5.'
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<div style="background-color: #ffffff; border: 1 solid #7f939b; border-radius: 4px;">
										<div style="background-color: #f5f5f5; border-bottom: 1 solid #7f939b; padding: 10px 15px; text-align:center; font-size: 15px;"><b>Channels</b><br><br></div>
										'.$canvas_box_6.'
									</div>
								</td>
							</tr>
						</table>
					</td>
			
					<td style="vertical-align: top;">
						<table>
							<tr>
								<td>
									<div style="border: 1 solid #7f939b; border-radius: 3px; vertical-align: top; background:#ffffff;">
										<div style="background-color: #f5f5f5; border-bottom: 1 solid #7f939b; padding: 10px 15px; text-align:center; font-size: 15px;"><b>Customer<br>Segments</b></div>
										'.$canvas_box_7.'
									</div>
								</td>
							</tr>
						</table>
					</td>
			    </tr>
			    <tr>
					<td colspan="2">
						<table>
							<tr style="vertical-align:top;">
								<td>
									<div style="background-color: #ffffff; border: 1 solid #7f939b; border-radius: 4px;">
										<div style="background-color: #f5f5f5; border-bottom: 1 solid #7f939b; padding: 10px 15px; text-align:center; font-size: 15px;"><b>Cost Structure</b></div>
										'.$canvas_box_8.'
									</div>
								</td>
							</tr>
						</table>
					</td>
					<td></td>
					<td colspan="2">
						<table>
							<tr style="vertical-align:top;">
								<td>
									<div style="background-color: #ffffff; border: 1 solid #7f939b; border-radius: 4px;">
										<div style="background-color: #f5f5f5; border-bottom: 1 solid #7f939b; padding: 10px 15px; text-align:center; font-size: 15px;"><b>Revenue Streams</b></div>
										'.$canvas_box_9.'
									</div>
								</td>
							</tr>
						</table>
					</td>
			    </tr>
			
				<tr>
					<td colspan="5" style="background-color: #ffffff; border: 1 solid #7f939b; padding: 5px; text-align:center; font-size:10px; color: grey;">Project Title: '.$project['title'].', Created by: '.$user['name'].', Created on: '.$created_at_date.', '.$created_at_time.'</td>
				</tr>
			</table>
		</page>
		';
		return $content;
	}
}