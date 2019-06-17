<?php
/**
 * Controller genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Http\Controllers\LA;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Redirect;
use Dwij\Laraadmin\Models\ModuleFields;
use Collective\Html\FormFacade as Form;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Dwij\Laraadmin\Models\Module;
use App\Models\Patient_Question;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Http\Requests;
use Carbon\Carbon;
use Datatables;
use Validator;
use Session;
use Auth;
use File;
use Mail;
use Log;
use URL;
use DB;




class Patient_QuestionsController extends Controller
{
	public $show_action = true;
	public $view_col = 'question';
	public $listing_cols = ['id', 'question', 'specialty', 'email', 'user_id', 'status'];
	
	public function __construct() {
		// Field Access of Listing Columns
		if(\Dwij\Laraadmin\Helpers\LAHelper::laravel_ver() == 5.3) {
			$this->middleware(function ($request, $next) {
				$this->listing_cols = ModuleFields::listingColumnAccessScan('Patient_Questions', $this->listing_cols);
				return $next($request);
			});
		} else {
			$this->listing_cols = ModuleFields::listingColumnAccessScan('Patient_Questions', $this->listing_cols);
		}
	}
	
	/**
	 * Display a listing of the Patient_Questions.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$module = Module::get('Patient_Questions');
		
		if(Module::hasAccess($module->id)) {
			return View('la.patient_questions.index', [
				'show_actions' => $this->show_action,
				'listing_cols' => $this->listing_cols,
				'module' => $module
			]);
		} else {
            return redirect(config('laraadmin.adminRoute')."/");
        }
	}

	/**
	 * Show the form for creating a new patient_question.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created patient_question in database.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		if(Module::hasAccess("Patient_Questions", "create")) {
		
			$rules = Module::validateRules("Patient_Questions", $request);
			
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();
			}
			
			$insert_id = Module::insert("Patient_Questions", $request);
			
			return redirect()->route(config('laraadmin.adminRoute') . '.patient_questions.index');
			
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Display the specified patient_question.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		if(Module::hasAccess("Patient_Questions", "view")) {
			
			$patient_question = Patient_Question::find($id);
			if(isset($patient_question->id)) {
				$module = Module::get('Patient_Questions');
				$module->row = $patient_question;
				
				return view('la.patient_questions.show', [
					'module' => $module,
					'view_col' => $this->view_col,
					'no_header' => true,
					'no_padding' => "no-padding"
				])->with('patient_question', $patient_question);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("patient_question"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Show the form for editing the specified patient_question.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		if(Module::hasAccess("Patient_Questions", "edit")) {			
			$patient_question = Patient_Question::find($id);
			if(isset($patient_question->id)) {	
				$module = Module::get('Patient_Questions');
				
				$module->row = $patient_question;
				
				return view('la.patient_questions.edit', [
					'module' => $module,
					'view_col' => $this->view_col,
				])->with('patient_question', $patient_question);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("patient_question"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Update the specified patient_question in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		if(Module::hasAccess("Patient_Questions", "edit")) {
			
			$rules = Module::validateRules("Patient_Questions", $request, true);
			
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();;
			}

		    $getQuestion = DB::table('patient_questions')->where('id', $id)->first();


		    if ($getQuestion->status == 'deactive' && $request->status == 'active') {

			    $getPatient = DB::table('employees')->where('id', $getQuestion->user_id)->first();
		    	if ($getPatient) {

		    		// Email to Patient for question active 

		    	    $subject = 'Pregunta formulada';
	    	    	$questionURL = '/ask_expert/todo/'.$id.'/'.str_slug($getQuestion->question, "-");
		    		$patientEmail = $getPatient->email;
		    	    
		    	    $content = '
		    	    <div style="background: #ddd;display: block;width: 90%;padding: 50px;">
						<div style="padding: 26px;margin-right: auto;margin-left: auto;background: #fff;font-weight: 600;">
							<p>Hola '.$getPatient->first_name.',</p>

							<p>Su pregunta ha sido aprobada y publicada en nuestro <a href="'.URL::to('/ask_expert').'">foro de salud </a>.
								 Pronto comenzará a recibir respuestas de médicos calificados.
							</p>
							
							<p>Puedes ir a tu respuesta visitando este enlace: </p>
							<p> <a href="'.URL::to($questionURL).'">'.URL::to($questionURL).' </a></p>
							
							<p>¡Mantenerse sano! </p>
							<p>Atentamente, </p>
							<p>equipo Psicologos</p>
						</div>
					</div>
					';
		    		$data = array( 'email' => $patientEmail, 'subject' => $subject, 'message' => $content);
		    		Mail::send([], $data, function ($m) use($data) {
		               $m->to($data['email'])->subject($data['subject'])->setBody($data['message'], 'text/html');
		        	});

			    	if ($getQuestion->email != $getPatient->email) {
			    		$userPatientEmail = $getQuestion->email;
						$data = array( 'email' => $userPatientEmail, 'subject' => $subject, 'message' => $content);
						Mail::send([], $data, function ($m) use($data) {
				           $m->to($data['email'])->subject($data['subject'])->setBody($data['message'], 'text/html');
				    	});
			    	}

		        	// Email to all Doctors with specialty

			    	$specialty = $getQuestion->specialty.',';
			    	$allDoctors = DB::table('employees')->where('type', 'doctor');
					$allDoctors->where('sub_specialty', 'LIKE', "%$specialty%");
				    $findDoctors = $allDoctors->get();
				    if ($findDoctors) {
			    	    $subject = 'Pregunta formulada';
				    	foreach ($findDoctors as $key => $doctor) {
				    		$doctorEmail = $doctor->email;
				    	    $content = '
				    	    <div style="background: #ddd;display: block;width: 90%;padding: 50px;">
								<div style="padding: 26px;margin-right: auto;margin-left: auto;background: #fff;font-weight: 600;">
									<p>Hola '.$doctor->first_name.',</p>
									<p>Según su especialidad: '.$specialty.' El paciente '.$getPatient->first_name.' ha hecho una pregunta.</p>

									<p>Solo los miembros premium pueden responder la pregunta</p>
									<p> aquí está el enlace de la pregunta</p>
									<a href="'.URL::to($questionURL).'">'.URL::to($questionURL).'</a>

									<p>Atentamente, </p>
									<p>equipo Psicologos</p>
								</div>
							</div>
							';
				    		$data = array( 'email' => $doctorEmail, 'subject' => $subject, 'message' => $content);
				    		Mail::send([], $data, function ($m) use($data) {
				               $m->to($data['email'])->subject($data['subject'])->setBody($data['message'], 'text/html');
				        	});
				    	}
				    }
		    	}

		    }
			
			$insert_id = Module::updateRow("Patient_Questions", $request, $id);

			
			return redirect()->route(config('laraadmin.adminRoute') . '.patient_questions.index');
			
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Remove the specified patient_question from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		if(Module::hasAccess("Patient_Questions", "delete")) {
			Patient_Question::find($id)->delete();
			
			// Redirecting to index() method
			return redirect()->route(config('laraadmin.adminRoute') . '.patient_questions.index');
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}
	
	/**
	 * Datatable Ajax fetch
	 *
	 * @return
	 */
	public function dtajax()
	{
		$values = DB::table('patient_questions')->select($this->listing_cols)->whereNull('deleted_at')->orderBy('status', 'DESC')->orderBy('id', 'DESC');
		$out = Datatables::of($values)->make();
		$data = $out->getData();

		$fields_popup = ModuleFields::getModuleFields('Patient_Questions');
		
		for($i=0; $i < count($data->data); $i++) {
			for ($j=0; $j < count($this->listing_cols); $j++) { 
				$col = $this->listing_cols[$j];
				if($fields_popup[$col] != null && starts_with($fields_popup[$col]->popup_vals, "@")) {
					$data->data[$i][$j] = ModuleFields::getFieldValue($fields_popup[$col], $data->data[$i][$j]);
				}
				if($col == $this->view_col) {
					$data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/patient_questions/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
				}
				// else if($col == "author") {
				//    $data->data[$i][$j];
				// }
			}
			
			if($this->show_action) {
				$output = '';
				if(Module::hasAccess("Patient_Questions", "edit")) {
					$output .= '<a href="'.url(config('laraadmin.adminRoute') . '/patient_questions/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
				}
				
				if(Module::hasAccess("Patient_Questions", "delete")) {
					$output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.patient_questions.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
					$output .= ' <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>';
					$output .= Form::close();
				}
				$data->data[$i][] = (string)$output;
			}
		}
		$out->setData($data);
		return $out;
	}
}
