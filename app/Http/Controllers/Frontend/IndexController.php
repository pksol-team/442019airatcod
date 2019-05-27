<?php


namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Input;
use Session;
use Carbon\Carbon;
use Auth;
use Dwij\Laraadmin\Models\Module;
use Dwij\Laraadmin\Models\ModuleFields;
use Validator;
use App\User;
use App\Models\Employee;
use App\Role;
use App\Models\ImageUpload;
use App\Models\Tickets_reply;
use App\Models\Ticket;
use App\Models\Upload;
use Mail;
use Log;
use File;


class IndexController extends Controller
{

	/**
     * Create a new controller instance.
     *
     * @return void
     */

	public function __construct()
    {

    }

     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
	
	// View Home Page
	public function index()
	{
		$title = 'Home-psicologos';
		$allSpecialitiesBottom = DB::table('specialities')->take(10)->get();
		$allCities = DB::table('cities')->take(10)->get();
		$allForecasts = DB::table('forecasts')->take(10)->get();

		$allSpecialitiesSearch = DB::table('specialities')->get();
		$allCitiesSearch = DB::table('cities')->get();
		$allForecastsSearch = DB::table('forecasts')->take(10)->get();
		return view('frontend.index', compact('title', 'allSpecialitiesBottom', 'allCities', 'allForecasts', 'allSpecialitiesSearch', 'allCitiesSearch', 'allForecastsSearch'));
	}

	// View city/specialty/forecast
	public function viewFullbyTag($tag)
	{
		$title = 'Todas '.$tag;
		if ($tag == 'Specialty') {
			$table = 'specialities';
			$heading = 'Especialistas';
		}
		if ($tag == 'City') {
			$table = 'cities';
			$heading = 'Profesionales de la salud chile';
		}
		if ($tag == 'Forecast') {
			$table = 'forecasts';
			$heading = 'Pronóstico';
		}
		$allTags = DB::table($table)->get();
		return view('frontend.viewFullbyTag', compact('title', 'table', 'allTags', 'heading'));
	}

	

	// View Doctor Login Page
	public function login()
	{
		$title = 'Iniciar sesión';
		if (Auth::check()) {
			return redirect('/');
		} else {
			return view('frontend.login', compact('title'));
		}
	}

	//logout
	public function logout() {
		Auth::logout();
		session()->flush();
		return redirect()->back();
	}

	// View Patient register Page
	public function patient_register()
	{
		$title = 'Inicio de sesión del paciente';
		if (Auth::check()) {
			return redirect('/');
		} else {
			return view('frontend.patient_register', compact('title'));
		}
	}

	// check login Fields
	public function login_check(Request $request)
	{
		$email = $request->input('email');
		$password = $request->input('password');
		$userGet = DB::table('users')->WHERE('email', $email)->first();
		if ($userGet) {
			$passwordchecked = $userGet->password;
			if (Hash::check($password, $passwordchecked)) {
				Auth::attempt(['email' => $email, 'password' => $password]);
				return redirect('/');
			}
			else{
				return redirect()->back()->withInput()->with('error', '¡La contraseña del usuario no coincide! si no tienes tu cuenta  <a href="/register">Registrar aquí </a>');
			}
		}else {
			return redirect()->back()->withInput()->with('error', 'Esta dirección de email no está registrada <a href="/register">Registrar aquí </a>');
		}
	}

	// View Forgot password Page
	public function forgot_password()
	{
		$title = 'Se te olvidó tu contraseña';
		if (Auth::check()) {
			return redirect('/');
		} else {
			return view('frontend.forgot_password', compact('title'));
		}
	}

	//forgot password Email Send to user
	public function forgot_send_email(Request $request)
	{
		$GUID = $this->getGUID();
		$email = $request->input('email');
		$userGet = DB::table('users')->WHERE('email', $email)->first();
		if ($userGet) {
	    	$PasswordKey = ['GUID' => $GUID];
	        $UserUpd = DB::table('users')->where('email', $email)->update($PasswordKey);

        	$baseUrl = url('/');
        	$msg_template = '
        		<div style="text-align: left;padding-left: 20px;padding-top: 50px;padding-bottom: 30px;">
				<h3>psicologosVibemar.cl restablecimiento de contraseña: </h3>
				<h4 style="padding: 0 20px 0 0;">Hola! <span style="color: #52a2f5;">'.$email.'</span>, Haga clic en el enlace de abajo para restablecer su contraseña</h4><h4 style="padding: 0 20px 0 0;"> </h4>
				<button style="cursor: pointer;color: #fff;background-color: #28a745;border-color: #28a745;display: inline-block;font-weight: 400;text-align: center;white-space: nowrap;vertical-align: middle;user-select: none;border: 1px solid transparent;padding: .375rem .75rem;font-size: 1rem;line-height: 1.5;border-radius: .25rem;"><a href="'.$baseUrl.'/enter_new_password/'.$GUID.'" style="color:#fff;">Restablecer la contraseña</a></button>
				</div>';
            
            //Updating Email content [Metakey]
            $content = $msg_template;
            $subject = 'Restablecer la contraseña';

			$data = array( 'email' => $email, 'subject' => $subject, 'message' => $content);
			Mail::send([], $data, function ($m) use($data) {
	           $m->to($data['email'])->subject($data['subject'])->setBody($data['message'], 'text/html');
	    	});
			return redirect()->back()->withInput()->with('message', 'Contraseña Restablecer enlace enviar a su correo electrónico Revise amablemente su correo electrónico');
		}else {
			return redirect()->back()->withInput()->with('error', 'Esta dirección de email no está registrada <a href="/register">Registrar aquí </a>');
		}
		
	}

	// enter new password after forgot page
	public function enter_new_password($GUID)
	{
		$title = 'Restablecer la contraseña';
		if (Auth::check()) {
			return redirect('/');
		} else {
			$userGet = DB::table('users')->WHERE('GUID', $GUID)->first();
			if ($userGet != NULL) {
				return view('frontend.reset_password', compact('title', 'userGet'));
			} else {
				return redirect('/');
			}
		}
	}

	// update new password after forgot
	public function forgot_reset_password(Request $request)
	{
		if (Auth::check()) {
			return redirect('/');
		} else {
			$GUID = $request->input('GUID');
			$password = $request->input('password');
			$confirm_password = $request->input('confirm_password');
			if ($password == $confirm_password) {
		    	$Updatepassword = ['password' => bcrypt($confirm_password), 'GUID' => NULL];
		        $UserUpd = DB::table('users')->WHERE('GUID', $GUID)->update($Updatepassword);
		        if ($UserUpd == TRUE) {
					return redirect('/userlogin')->with('message', 'Contraseña restablecida con éxito');
		        } else {
					return redirect()->back()->withInput()->with('error', '¡Uy! Algo salió mal..');
		        }
			} else {
				return redirect()->back()->with('error', 'Su contraseña y la contraseña de confirmación no coinciden');	
			}
		}
	}

	// Doctor register page
	public function register_doctor_init()
	{
		$title = 'Registro doctor';
		if (Auth::check()) {
			return redirect('/');
		} else {
			$allCities = DB::table('cities')->whereNull('deleted_at')->get();
			$allForecasts = DB::table('forecasts')->whereNull('deleted_at')->get();
			return view('frontend.register_init', compact('title', 'allCities', 'allForecasts'));
		}
	}

	// Doctor register page select speciality
	public function register_doctor_mid(Request $request)
	{
		$title = 'Registro doctor';
		if (Auth::check()) {
			return redirect('/');
		} else {
			$allSpecialities = DB::table('specialities')->get();
			$inputFields = [
				'first_name' => $request->first_name,
				'last_name' => $request->last_name,
				'city' => $request->city,
				'forecast' => $request->forecast,
				'address' => $request->address,
				'gender' => $request->gender
			];
			return view('frontend.register_mid', compact('title', 'inputFields', 'allSpecialities'));
		}
	}
	// Doctor register page
	public function register_doctor(Request $request)
	{
		$title = 'Registro doctor';
		if (Auth::check()) {
			return redirect('/');
		} else {
			$inputFields = [
				'first_name' => $request->first_name,
				'last_name' => $request->last_name,
				'city' => $request->city,
				'forecast' => $request->forecast,
				'address' => $request->address,
				'gender' => $request->gender,
				'specialty' => $request->specialty,
				'sub_specialty' => $request->specialtyName
			];

			return view('frontend.register', compact('title', 'inputFields'));
		}
	}

	// registration fields check and register
	public function register_check(Request $request)
	{
		$first_name = $request->input('first_name');
		$last_name = $request->input('last_name');
		$gender = $request->input('gender');
		$specialty = $request->input('specialty');
		$sub_specialty = $request->input('sub_specialty');
		$RUT_number = $request->input('RUT_number');
		$contact = $request->input('contact');
		$email = $request->input('email');
		$confirm_password = $request->input('confirm_password');
		$subscribe_notifications = $request->input('notification');

		$rules = Module::validateRules("Employees", $request);

		$validator = Validator::make($request->all(), $rules);
		
		if ($first_name != NULL) {
			$type = 'doctor';
			$profile = 'basic';
			$address = $request->input('address');
			$city = $request->input('city');
			$forecast = $request->input('forecast');
			if ($validator->fails()) {
				return redirect()->back()->withInput()->with('error', '¡Uy! Algo salió mal..');;
			}
		} else {
			$type = 'patient';
			$profile = '';
			$address = '';
			if ($email == '' || $confirm_password == '' || $request->input('password') == '' || $confirm_password != $request->input('password')) {
				return redirect()->back()->withInput()->with('error', '¡Uy! Algo salió mal..');
			}

			$first_name = 'user';
			$last_name = '';
			$gender = '';
			$city = '';
			$forecast = '';
			$RUT_number = '';
			$contact = '';
			$subscribe_notifications = 'on';
		}

		$authenticateResult = $this->register_authenticate($email);
		if ($authenticateResult === true) {
		$hashKey = uniqid(time());
		$employee = [
		    'first_name' => $first_name,
		    'last_name' => $last_name,
		    'RUT_number' => $RUT_number,
		    'notification' => $subscribe_notifications,
		    'mobile' => $contact,
		    'profile' => $profile,
		    'visitor_count' => 0,
            'hash_key' => $hashKey,
		    'mobile2' => "",
		    'type' => $type,
		    'specialty' => $specialty,
		    'sub_specialty' => $sub_specialty,
		    'email' => $email,
		    'gender' => $gender,
		    'dept' => "1",
		    'city' => $city,
		    'address' => $address,
		    'about' => "",
		    'date_birth' => date("Y-m-d"),
		    'date_hire' => date("Y-m-d"),
		    'date_left' => date("Y-m-d"),
		    'salary_cur' => 0,
		    'created_at' => Carbon::now(),
		  ];
		$insertedEmployees = DB::table('employees')->insert($employee);
		$getInsertedId = DB::getPdo()->lastInsertId();
       
		if ($insertedEmployees) {
			$confirm_email = uniqid(time()).uniqid();
			$user = [
	            'name' => $first_name,
	            'email' => $email,
	            'password' => bcrypt($confirm_password),
	            'context_id' => $getInsertedId,
	            'type' => $type,
	            'hash_key' => $hashKey,
			    'created_at' => Carbon::now(),
			    'status' => 'deactive',
			    'confirm_email' => $confirm_email,
			    
	        ];
			$insertedUsers = DB::table('users')->insert($user);
			if ($insertedUsers) {
				if ($type == 'doctor') {
					$role_id = 2;
				} else {
					$role_id = 3;
				}
				$role = [
					'role_id' => 2,
					'user_id' => $getInsertedId,
				];
				DB::table('role_user')->insert($role);
			}
		}
		$baseUrl = url('/');
		$msg_template = '
			<div style="text-align: left;padding-left: 20px;padding-top: 50px;padding-bottom: 30px;">
				<h3>Le damos la bienvenida a registro psicologosVibemar.cl<br></h3>
				<h4 style="padding: 0 20px 0 0;">
					<span lang="ES-CL" style="font-size:11.0pt;line-height:107%;color:#3e4247">Gracias
					por registrarse en. En las próximas 48-72 horas&nbsp;</span>
					<strong>
					<span lang="ES-CL" style="font-size:11.5pt;line-height:107%;color:#3e4247; border:none;padding:0">revisaremos
					los datos de su perfil para asegurarnos de que son válidos.</span>
					</strong><br>
				</h4>
				<button style="cursor: pointer;color: #fff;background-color: #28a745;border-color: #28a745;display: inline-block;font-weight: 400;text-align: center;white-space: nowrap;vertical-align: middle;user-select: none;border: 1px solid transparent;padding: .375rem .75rem;font-size: 1rem;line-height: 1.5;border-radius: .25rem;"><a href="'.$baseUrl.'/verify_email/'.$getInsertedId.'/'.$confirm_email.'" style="color:#fff;">Confirme su correo electrónico aquí</a>
				</button>
			</div>
		';
		$to = $email;
	    $subject = 'Registro de cuenta';
	    $content = $msg_template;

		$data = array( 'email' => $to, 'subject' => $subject, 'message' => $content);
		Mail::send([], $data, function ($m) use($data) {
           $m->to($data['email'])->subject($data['subject'])->setBody($data['message'], 'text/html');
    	});

		return redirect('/confirm_email/'.$user['hash_key']);
		} else {
			return redirect()->back()->withInput()->with('error', $authenticateResult);
		}

	}

	// email address check if already check
	public function register_authenticate($email)
	{
        $haveUser = DB::table('users')->WHERE('email', $email)->first();
        if ($haveUser) {
    		return $messsage = '¡La dirección de correo ya existe!';
        }
        else {
        	return true;
        }
	}

	//view Confirm email page
	public function confirm_email($hash_key)
	{
		$title = 'Confirmar correo electrónico';
		if (Auth::check()) {
			// return redirect('/');
			return view('frontend.confirm_email', compact('title'));
		} else {
			return view('frontend.confirm_email', compact('title'));

		}
	}

	// change register email page
	public function change_register_email($hash_key)
	{
		$title = 'Cambiar e-mail';
        $NewUser = DB::table('users')->WHERE('hash_key', $hash_key)->first();
		if (Auth::check()) {
			return redirect('/');
		} else {
			return view('frontend.change_email', compact('title', 'NewUser'));
		}
	}

	// update new email (new user)
	public function update_email(Request $request)
	{
		if (Auth::check()) {
			return redirect('/');
		} else {
			$Userid = $request->input('id');
			$NewEmail = $request->input('email');
	    	$UpdateEmail = ['email' => $NewEmail];
	        $UserUpd = DB::table('users')->where('email', $NewEmail)->first();
	    	if ($UserUpd == NULL) {
		        $EmpUpd = DB::table('employees')->where('id', $Userid)->update($UpdateEmail);
		        $UserUpd = DB::table('users')->where('id', $Userid)->update($UpdateEmail);
		        
		        $NewUser = DB::table('users')->WHERE('id', $Userid)->first();

	        	$baseUrl = url('/');
	        	$msg_template = '
	        		<div style="text-align: left;padding-left: 20px;padding-top: 50px;padding-bottom: 30px;">
	        			<h3>Le damos la bienvenida a registro psicologosVibemar.cl<br></h3>
	        			<h4 style="padding: 0 20px 0 0;">
	        				<span lang="ES-CL" style="font-size:11.0pt;line-height:107%;color:#3e4247">Gracias
	        				por registrarse en. En las próximas 48-72 horas&nbsp;</span>
	        				<strong>
	        				<span lang="ES-CL" style="font-size:11.5pt;line-height:107%;color:#3e4247; border:none;padding:0">revisaremos
	        				los datos de su perfil para asegurarnos de que son válidos.</span>
	        				</strong><br>
	        			</h4>
	        			<button style="cursor: pointer;color: #fff;background-color: #28a745;border-color: #28a745;display: inline-block;font-weight: 400;text-align: center;white-space: nowrap;vertical-align: middle;user-select: none;border: 1px solid transparent;padding: .375rem .75rem;font-size: 1rem;line-height: 1.5;border-radius: .25rem;"><a href="'.$baseUrl.'/verify_email/'.$Userid.'/'.$NewUser->confirm_email.'" style="color:#fff;">Confirme su correo electrónico aquí</a>
	        			</button>
	        		</div>
	        	';

        		$to = $NewEmail;
        	    $subject = 'Registro de cuenta';
        	    $content = $msg_template;

        		$data = array( 'email' => $to, 'subject' => $subject, 'message' => $content);
        		Mail::send([], $data, function ($m) use($data) {
                   $m->to($data['email'])->subject($data['subject'])->setBody($data['message'], 'text/html');
            	});

				return redirect('confirm_email/'.$NewUser->hash_key);
	    	} else {
				return redirect()->back()->withInput()->with('error', '¡La dirección de correo ya existe!');
	    	}
		}
	}

	// Verify Email through email
	public function verify_email($id, $hashkey)
	{
		$title = 'Correo electrónico de verificación';
        $userFound = DB::table('users')->where([['id', $id], ['confirm_email', $hashkey]])->first();
        if ($userFound) {

        	$confirm_email = [
        		'confirm_email' => NULL,
        		'status' => 'active',
        	];
        
        	DB::table('users')->where([['id', $id], ['confirm_email', $hashkey]])->update($confirm_email);
        	$message = 'Gracias por verificar su correo electrónico. Por favor complete su perfil';

        } else {
        	$message = '¡Uy! Enlace caducado o cuenta ya confirmada';
        }
		return view('frontend.thankyou_email', compact('title', 'message'));
	}

	// View normal Profile Page
	public function my_data()
	{
		$title = 'Editar perfil';
		if (Auth::check()) {
			
			$userID = Auth::user()->id;
	        $EmpTbl = DB::table('employees')->where('id', $userID)->first();
	        $UserTbl = DB::table('users')->where('id', $userID)->first();
			return view('frontend.my_data', compact('title', 'EmpTbl', 'UserTbl'));
		} else {
			return redirect('/');
		}
	}

	// Update Normal Profile
	public function update_my_data(Request $request)
	{
		$userID = Auth::user()->id;
		$first_name = $request->input('first_name');
		$last_name = $request->input('last_name');
		$mobile = $request->input('mobile');
		$postal_code = $request->input('postal_code');
		$email = $request->input('email');
		$password = $request->input('password');
		$isapre = $request->input('isapre');
		$address = $request->input('address');
		$subscribe_notifications = $request->input('notification');

		$rulesEmp = Module::validateRules("Employees", $request);
		$rulesUsr = Module::validateRules("Users", $request);

		$validatorEmp = Validator::make($request->all(), $rulesEmp);
		$validatorUsr = Validator::make($request->all(), $rulesUsr);
		
		if (Auth::check()) {

			$employee = [
		    'first_name' => $first_name,
		    'last_name' => $last_name,
		    'notification' => $subscribe_notifications,
		    'mobile' => $mobile,
		    'email' => $email,
		    'postal_code' => $postal_code,
		    'isapre' => $isapre,
		    'address' => $address,
		  ];

	        $UpdateEmployee = DB::table('employees')->where('id', $userID)->update($employee);

			$user = [
	            'name' => $first_name,
	            'email' => $email,
		    ];
		    if ($password != '') {

			    $NewPassword = [
		            'password' => bcrypt($password),
			    ];

			    $final_array_user = array_merge($user, $NewPassword);
		        $done = DB::table('users')->where('id', $userID)->update($final_array_user);
		    	
		    } else {
		        $done = DB::table('users')->where('id', $userID)->update($user);	
		    }
			return redirect()->back()->withInput()->with('message', 'Perfil actualizado con éxito');

		} else {
			return redirect('/');
		}

	}

	// create GUID (General Uniquq ID)
	function getGUID(){
	    if (function_exists('com_create_guid')){
	        return com_create_guid();
	    }else{
	        mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
	        $charid = strtoupper(md5(uniqid(rand(), true)));
	        $hyphen = chr(45);// "-"
	        $uuid = chr(123)// "{"
	            .substr($charid, 0, 8).$hyphen
	            .substr($charid, 8, 4).$hyphen
	            .substr($charid,12, 4).$hyphen
	            .substr($charid,16, 4).$hyphen
	            .substr($charid,20,12)
	            .chr(125);// "}"
	        return $uuid;
	    }
	}
	// Premium Profile view
	public function premium_profile($id, $uniqid) {

		if (Auth::check()) {
	        $UserTbl = DB::table('users')->WHERE([['id', $id], ['hash_key', $uniqid]])->first();
	        $EmpTbl = DB::table('employees')->WHERE('id', $id)->first();
	        $allPremiumDoctors = DB::table('employees')->WHERE([['type', 'doctor'], ['profile', 'premium']])->get();
			$title = $EmpTbl->first_name;
	        if ($UserTbl != NULL) {
				return view('frontend.premium_profile', compact('title','allPremiumDoctors', 'UserTbl', 'EmpTbl'));
	        } else {
				return redirect('/');
	        }

		} else {
			return redirect('/');
		}
	}

	// Write Article Premium Profile Only
	public function write_article($id, $uniqid) {

		if (Auth::check()) {
	        $UserTbl = DB::table('users')->WHERE([['id', $id], ['hash_key', $uniqid]])->first();
	        $EmpTbl = DB::table('employees')->WHERE([['id', $id], ['type', 'doctor'], ['profile', 'premium']])->first();
			$title = 'Escribir articulo';
	        if ($EmpTbl != NULL) {
				return view('frontend.write_article', compact('title', 'UserTbl', 'EmpTbl'));
	        } else {
				return redirect('/');
	        }

		} else {
			return redirect('/');
		}
	}

	// add New Article
	public function addNewArticle(Request $request)
	{	
		if (Auth::check()) {

			if(Input::hasFile('image')) {
				$file = Input::file('image');
				$folder = storage_path('uploads');
				$filename = $file->getClientOriginalName();
	
				$date_append = date("Y-m-d-His-");
				$upload_success = Input::file('image')->move($folder, $date_append.$filename);
				
				if( $upload_success ) {
	
					$upload = Upload::create([
						"name" => $filename,
						"path" => $folder.DIRECTORY_SEPARATOR.$date_append.$filename,
						"extension" => pathinfo($filename, PATHINFO_EXTENSION),
						"caption" => "",
						"hash" => "",
						"public" => 1,
						"user_id" => Auth::user()->id
					]);

					while(true) {
						$hash = strtolower(str_random(20));
						if(!Upload::where("hash", $hash)->count()) {
							$upload->hash = $hash;
							break;
						}
					}
					$upload->save();
				}
			}

			$userID = Auth::user()->id;
			$newArticle = [
		            'title' => $request->title,
		            'short_description' => $request->short_description,
		            'detail' => $request->detail,
		            'user_id' => $userID,
		            'image' => $upload->id,
			    ];
	        $done = DB::table('articles')->insert($newArticle);	
			return redirect('/blog_article');
        } else {
			return redirect('/');
		}
	}

	// edit Article Premium Profile Only
	public function edit_article($article_id, $id, $uniqid) {

		if (Auth::check()) {
	        $UserTbl = DB::table('users')->WHERE([['id', $id], ['hash_key', $uniqid]])->first();
	        $EmpTbl = DB::table('employees')->WHERE([['id', $id], ['type', 'doctor'], ['profile', 'premium']])->first();
	        $article = DB::table('articles')->WHERE('id', $article_id)->first();
			$title = 'Escribir articulo';
	        if ($EmpTbl != NULL) {
				return view('frontend.edit_article', compact('title', 'UserTbl', 'EmpTbl', 'article'));
	        } else {
				return redirect('/');
	        }

		} else {
			return redirect('/');
		}
	}

	// add New Article
	public function updateArticle(Request $request)
	{	
		if (Auth::check()) {

	        $article = DB::table('articles')->where('id', $request->article_id)->first();
	        $uploadTable = DB::table('uploads')->where('id', $article->image)->first();

			if(Input::hasFile('image')) {
				$file = Input::file('image');
				$folder = storage_path('uploads');
				$filename = $file->getClientOriginalName();
	
				$date_append = date("Y-m-d-His-");
				$upload_success = Input::file('image')->move($folder, $date_append.$filename);
				
				if( $upload_success ) {
	
					$upload = Upload::create([
						"name" => $filename,
						"path" => $folder.DIRECTORY_SEPARATOR.$date_append.$filename,
						"extension" => pathinfo($filename, PATHINFO_EXTENSION),
						"caption" => "",
						"hash" => "",
						"public" => 1,
						"user_id" => Auth::user()->id
					]);

					while(true) {
						$hash = strtolower(str_random(20));
						if(!Upload::where("hash", $hash)->count()) {
							$upload->hash = $hash;
							break;
						}
					}
					$upload->save();
					$uploadID = $upload->id;

					// Get old file name from path column
					$string = $uploadTable->path;
					$prefix = "uploads";
					$index = strpos($string, $prefix) + strlen($prefix);
					$result = substr($string, $index);

					// remove old pic
					$myFile = $folder.$result;
					if(file_exists($myFile)){
						unlink($myFile);
				        DB::table('uploads')->where('id', $article->image)->delete();
					}

				}
			} else {
				$uploadID = $uploadTable->id;
			}

			$userID = Auth::user()->id;
			$updateArticle = [
		            'title' => $request->title,
		            'short_description' => $request->short_description,
		            'detail' => $request->detail,
		            'image' => $uploadID,
			    ];
	        $done = DB::table('articles')->where('id', $request->article_id)->update($updateArticle);	
			return redirect('/blog_article');
        } else {
			return redirect('/');
		}
	}

	// Article/ Blog Listings
	public function blog_article()
	{
		$title = 'ARTÍCULOS DE PSICÓLOGO';
        $all_articles = DB::table('articles')->whereNull('deleted_at')->orderBy('id', 'DESC')->paginate(10);
		return view('frontend.blog_article', compact('title', 'all_articles'));
	}

	// Article/ Blog detail Page
	public function article_view($id)
	{
        $article = DB::table('articles')->where('id', $id)->whereNull('deleted_at')->first();
		$title = $article->title;
        $all_articles = DB::table('articles')->whereNull('deleted_at')->orderBy('id', 'DESC')->limit(10)->get();
		return view('frontend.article_view', compact('title', 'article', 'all_articles'));
	}

	// Doctor Full Profile Edit
	public function doctor_profile_full($uniqid)
	{
		if (Auth::check()) {
			$userID = Auth::user()->id;
	        $UserTbl = DB::table('users')->WHERE([['id', $userID], ['hash_key', $uniqid]])->first();
	        $EmpTbl = DB::table('employees')->WHERE('id', $userID)->first();
			$allSpecialities = DB::table('specialities')->get();
			$allForecasts = DB::table('forecasts')->get();
			$title = $EmpTbl->first_name;
	        if ($UserTbl != NULL) {
				return view('frontend.doctor_full_profile', compact('title', 'UserTbl', 'EmpTbl', 'allSpecialities', 'allForecasts'));
	        } else {
				return redirect('/');
	        }

		} else {
			return redirect('/');
		}
	}

	// Update Exract with ajax
	public function updateExract(Request $request){	

		$updateExract = [
	            'exract' => $request->Extract,
		    ];
        $done = DB::table('employees')->where('id', $request->user_id)->update($updateExract);	
        return $done;
	}

	// Update Experience with ajax
	public function updateExperience(Request $request){	

		$updateExperience = [
	            'experience' => serialize($request->data),
		    ];
        $done = DB::table('employees')->where('id', $request->user_id)->update($updateExperience);	
        return $done;
	}

	// Update Bios with ajax
	public function updateBio(Request $request){	

		$updateBio = [
	            'gender' => $request->gender,
	            'mobile' => $request->mobile,
	            'RUT_number' => $request->RUT_number
		    ];
        $done = DB::table('employees')->where('id', $request->user_id)->update($updateBio);	
        return $done;
	}

	// Update About User with ajax
	public function updateAbout(Request $request){	

		$updateAbout = [
	            'about' => $request->about,
		    ];
        $done = DB::table('employees')->where('id', $request->user_id)->update($updateAbout);	
        return $done;
	}

	// Update Web Links with ajax
	public function updateWebLinks(Request $request){	

		$updateWebLinks = [
	            'web_links' => serialize($request->data),
		    ];
        $done = DB::table('employees')->where('id', $request->user_id)->update($updateWebLinks);	
        return $done;
	}

	// Update Training with ajax
	public function updateTraining(Request $request){	

		$updateTraining = [
	            'training' => serialize($request->data),
		    ];
        $done = DB::table('employees')->where('id', $request->user_id)->update($updateTraining);	
        return $done;
	}

	// Upload Profile Picture
	public function upload_profile_image(Request $request){	

		$data = $request->image;
		$image_array_1 = explode(";", $data);
		$image_array_2 = explode(",", $image_array_1[1]);
		$data2 = base64_decode($image_array_2[1]);
		$folder = 'upload/';
		$imageName = uniqid(time()).'.png';
		$nameWithFolder = $folder.$imageName;
		
		file_put_contents($nameWithFolder, $data2);

        $user = DB::table('employees')->where('id', $request->user_id);	
        $getUserRow = $user->first();
		$oldPic = $getUserRow->profile_picture;
		$myFile = public_path().'/upload/'.$oldPic;
		if(file_exists($myFile)){
			unlink($myFile);
		}
		$updatePicture = [
	            'profile_picture' => $imageName
		    ];
        $done = $user->update($updatePicture);	
        return $imageName;
	}

	// Remove Profile Picture with ajax
	public function removeProfilePic(Request $request){	

		$user = DB::table('employees')->where('id', $request->user_id);
		$getUserRow = $user->first();
		$oldPic = $getUserRow->profile_picture;
		$myFile = public_path().'/upload/'.$oldPic;
		unlink($myFile);
		$updatePicture = [
	            'profile_picture' => '0'
		    ];
        $done = $user->update($updatePicture);	
        return $done;
	}

	// Add Photos with Dropzone with ajax
	public function fileStore(Request $request) {

		$userRow = DB::table('employees')->where('id', $request->user_id);
		$user = $userRow->first();
		
		$arrayPhotos = explode(",", $user->photos);
		if (count($arrayPhotos) < 10) {
	        
	        $image = $request->file('file');
	        $extension = $image->getClientOriginalExtension();
			$imageName = uniqid(time()).'.'.$extension;
	        $image->move(public_path('upload'), $imageName);

			$newPhotos = '"'.$imageName.'"';
			array_push($arrayPhotos, $newPhotos);
			$filtered_array = array_filter($arrayPhotos);
			$newPhotosStr = implode(",",$filtered_array);
			
			$updatePhotos = [
		            'photos' => $newPhotosStr
			    ];
	        $done = $userRow->update($updatePhotos);	
	        
	        return response()->json(['success'=> $imageName]);
		} else {
	        return response()->json(['error'=>'error']);
		}	
    }

	// Remove Photos with Dropzone with ajax
    public function fileDestroy(Request $request)
    {
    	$userRow = DB::table('employees')->where('id', $request->user_id);
		$user = $userRow->first();
		
		$arrayPhotos = explode(",", $user->photos);

        $filename =  $request->image;

		$removedArrayPhotos = array_search($filename, $arrayPhotos);

		unset($arrayPhotos[$removedArrayPhotos]);

		$filtered_array = array_filter($arrayPhotos);
		
		$newPhotosStr = implode(",",$filtered_array);
		
		$updatePhotos = [
	            'photos' => $newPhotosStr
		    ];
        $done = $userRow->update($updatePhotos);	
        
        return response()->json(['success'=> $done]);
    }

    // View Consulting Time add page
    public function consulting_time()
	{
		$title = 'Tiempo de consulta';
		if (Auth::check()) {
			return view('frontend.consulting_time', compact('title'));
		} else {
			return redirect('/');
		}
	}

	// Add Consulting Time in DB
	public function consulting_add(Request $request)
	{
		if (Auth::check()) {
			$user_id = Auth::user()->id;
			$day = $request->day;
			$status = $request->status;
			$from_time = $request->from_time;
			$from_AM_PM = $request->from_AM_PM;
			$to_time = $request->to_time;
			$to_AM_PM = $request->to_AM_PM;
			$location = $request->location;

			$haveTime = DB::table('consulting_time')->where([['doctor_id' , $user_id], ['day', $day], ['from_time', $from_time], ['from_AM_PM', $from_AM_PM]])->first();

			if ($haveTime != NULL) {
				return redirect()->back()->with('error', 'La hora y el día seleccionados ya existen.');
			}
			
			$updateConsulting = [
	            'doctor_id' => $user_id,
	            'day' => $day,
	            'from_time' => $from_time,
	            'from_AM_PM' => $from_AM_PM,
	            'to_time' => $to_time,
	            'to_AM_PM' => $to_AM_PM,
	            'location' => $location,
	            'created_at' => Carbon::now()
		    ];

			if ($status != NULL) {
		        $done = DB::table('consulting_time')->insert($updateConsulting);
				return redirect()->back()->with('message', 'Tiempo de consulta actualizado con éxito.');
			} else {
				$updateConsultingOff = [
		            'doctor_id' => $user_id,
		            'day' => $day,
		            'status' => 'off'
				];

		        $done = DB::table('consulting_time')->insert($updateConsultingOff);
				return redirect()->back()->with('message', 'Tiempo de consulta actualizado con éxito.');
			}
		} else {
			return redirect('/');
		}
	}

	// View all Doctors
	public function all_professional(Request $request)
	{
		$title = 'Todos los profesionales';
		$allDoctorswithFilters = DB::table('employees')->where('type', 'doctor');
		$specialty = $request->specialty.',';
		$city = $request->city;
		$forecast = $request->forecast;
		$inputKeywords = $request->searchByInput;
		
		if ($request->searchByInput != '') {
			$allDoctorswithFilters->Where('first_name', 'LIKE', "%$inputKeywords%");
			// $allDoctorswithFilters->orWhere('city', 'LIKE', "%$inputKeywords%");
			$allDoctorswithFilters->orWhere('sub_specialty', 'LIKE', "%$inputKeywords%");
			// $allDoctorswithFilters->orWhere('forecast', 'LIKE', "%$inputKeywords%");
			$allDoctorswithFilters->orWhere('last_name', 'LIKE', "%$inputKeywords%");
			
		} else {

			if ($specialty != '') {
				$allDoctorswithFilters->where('specialty', 'LIKE', "%$specialty%");
			}
			if ($city != '') {
				$allDoctorswithFilters->where('city', 'LIKE', "%$city%");
			}
			if ($forecast != '') {
				$allDoctorswithFilters->where('forecast', 'LIKE', "%$forecast%");
			}

		}

		$allDoctors = $allDoctorswithFilters->orderBy('profile', 'DESC')->orderBy('reviews', 'DESC')->get();

		$allSpecialities = DB::table('specialities')->get();
		$allCities = DB::table('cities')->get();
		$allForecasts = DB::table('forecasts')->take(10)->get();
		return view('frontend.all_professional', compact('title', 'allDoctors', 'allSpecialities', 'allCities', 'allForecasts'));
	}

	// home page search request
	public function searchBySpecialty(Request $request)
	{
		return redirect('/all_professional/?specialty='.$request->specialty.'&city='.$request->city.'&forecast='.$request->forecast.'&searchByInput='.$request->searchByInput);
	}
	// Contact Us page
	public function contact_us()
	{
		$title = 'Contáctenos';
		return view('frontend.contact_us', compact('title'));
	}

	// Contact Us Email Section
	public function contact_us_email(Request $request)
	{
		$admin = DB::table('employees')->where('type', 'admin')->first();
		$first_name = $request->first_name;
		$email = $request->email;
		$telephone = $request->telephone;
		$who_you = $request->who_you;
		$comment = $request->comment;

    	$baseUrl = url('/');
    	$msg_template = '
		    	<div style="text-align: left;padding-left: 20px;padding-top: 50px;padding-bottom: 30px;">
			    	<h3>psicologosVibemar.cl contacto: </h3>
			    	<h4 style="padding: 0 20px 0 0;">Hola '.$admin->first_name.'! <br><br>
			    		'.$first_name.' ha enviado un mensaje a través del formulario de contacto.
			    		abajo están los detalles
			    	</h4>
			    	<p>
			    		<ul style="list-style: none;">
			    			<li>Nombre de pila: '.$first_name.'</li>
			    			<li>correo electrónico: '.$email.'</li>
			    			<li>apellido: '.$telephone.'</li>
			    			<li>Razón: '.$who_you.'</li>
			    			<li>Comentario: '.$comment.'</li>
			    		</ul>
			    	</p>
		    	</div>
		    	';
        
        //Updating Email content [Metakey]
        $content = $msg_template;
        $subject = 'Contacto';

		$data = array( 'email' => $admin->email, 'subject' => $subject, 'message' => $content);
		Mail::send([], $data, function ($m) use($data) {
           $m->to($data['email'])->subject($data['subject'])->setBody($data['message'], 'text/html');
    	});
		return redirect()->back()->withInput()->with('message', 'Gracias por contactarnos');
	}
	
	

	// view favourtie doctors of single patient
	public function favourites()
	{
		if (Auth::check()) {
			$userID = Auth::user()->id;
	        $EmpTbl = DB::table('employees')->where('id', $userID)->first();
	        $UserTbl = DB::table('users')->where('id', $userID)->first();
	        if ($UserTbl->type == 'patient') {
				$title = 'Mis favoritos';
				$favourite = DB::table('favourite_doctors')->where('patient_id', $userID)->first();
				return view('frontend.favourites', compact('title', 'userID', 'EmpTbl', 'UserTbl', 'favourite'));
        	} else {
				return redirect('/');
	        }

		} else {
			return redirect('/');
		}
	}
	
	// View Doctor Full Profile

	public function doctor_profile_view($id, $uniqid)
	{

        $UserTbl = DB::table('users')->WHERE([['id', $id], ['hash_key', $uniqid]])->first();
        $EmpTbl = DB::table('employees')->WHERE('id', $id)->first();
		
		$title = $EmpTbl->first_name;
		
        if ($UserTbl != NULL) {
			return view('frontend.doctor_view_profile', compact('title', 'UserTbl', 'EmpTbl'));
        } else {
			return redirect('/');
        }
	}

	// return doctor Schedule
	public static function getTimingDoctor($day, $id, $date) {
		$allTimings = DB::table('consulting_time')->WHERE('day', $day)->WHERE('doctor_id', $id)->get();
        $EmpTbl = DB::table('employees')->WHERE('id', $id)->first();
		$times = '';
		if ($allTimings != NULL) {
			foreach ($allTimings as $key => $allTiming) {
				if ($allTiming->status == 'off') {
					continue;
				} else {
					$alreadyBooked = DB::table('appointments')->WHERE([['day', $allTiming->day], ['doctor_id', $id], ['from_time', $allTiming->from_time], ['from_AM_PM', $allTiming->from_AM_PM], ['appointment_date', 'LIKE', '%' . $date . '%']])->first();
					if ($alreadyBooked) {
						$times .= '<p class="doctortime"><del>'.$allTiming->from_time.' '.$allTiming->from_AM_PM.'</del></p>';
					} else {
						$times .= '<p class="doctortime"><a href="/book_appointment/'.$EmpTbl->id.'/'.$EmpTbl->hash_key.'/'.$date.'/'.$allTiming->id.'">'.$allTiming->from_time.' '.$allTiming->from_AM_PM.'</a></p>';
					}
				}
			}
		}
		return $times;
	}

	// return doctor Schedule for doctor's own profile
	public static function getTimingDoctorProfile($day, $id) {
		$allTimings = DB::table('consulting_time')->WHERE('day', $day)->WHERE('doctor_id', $id)->get();
        $EmpTbl = DB::table('employees')->WHERE('id', $id)->first();
		$times = '';
		if ($allTimings != NULL) {
			foreach ($allTimings as $key => $allTiming) {
				if ($allTiming->status == 'off') {
					continue;
				} else {
					$times .= '<p class="mb-1 text-black">'.$allTiming->from_time.' '.$allTiming->from_AM_PM.'</p>';
				}
			}
		}
		return $times;
	}

	// Make Doctor Favourite
	public function make_fav(Request $request)
	{
        $doctor_id = $request->doctor_id;
        $user_id = $request->user_id;

        $favTable = DB::table('favourite_doctors')->WHERE('patient_id', $user_id)->first();
        if ($favTable != NULL) {
        	$allDoctorsIDs = explode(',', $favTable->doctors_list);
        	if (in_array($doctor_id , $allDoctorsIDs)) {
        		$foundDoctor = array_search($doctor_id, $allDoctorsIDs);
        		unset($allDoctorsIDs[$foundDoctor]);
        	} else {
	        	array_push($allDoctorsIDs, $doctor_id);
        	}
        	$doctors = implode(',',$allDoctorsIDs);
        	$favDoctor = [
        		'doctors_list' => $doctors
        	];
	        $favTable = DB::table('favourite_doctors')->WHERE('patient_id', $user_id)->update($favDoctor);
        } else {
        	$favDoctor = [
        		'patient_id' => $user_id,
        		'doctors_list' => $doctor_id
        	];
	        $favTable = DB::table('favourite_doctors')->insert($favDoctor);
        }
	}

	// Review Given Page
	public function review_doctor($id, $uniqid)
	{
        $UserTbl = DB::table('users')->WHERE([['id', $id], ['hash_key', $uniqid]])->first();
        $EmpTbl = DB::table('employees')->WHERE('id', $id)->first();
		
		$title = $EmpTbl->first_name;
		
        if ($UserTbl != NULL) {
			return view('frontend.review_doctor', compact('title', 'UserTbl', 'EmpTbl'));
        } else {
			return redirect('/');
        }
	}
	// Review View Page
	public function view_reviews_doctor($id, $uniqid)
	{
        $UserTbl = DB::table('users')->WHERE([['id', $id], ['hash_key', $uniqid]])->first();
        $EmpTbl = DB::table('employees')->WHERE('id', $id)->first();
        $reviews = DB::table('review_doctors')->WHERE('doctor_id', $id)->orderBy('id', 'DESC')->get();
		
		$title = $EmpTbl->first_name;
		
        if ($UserTbl != NULL) {
			return view('frontend.view_review', compact('title', 'UserTbl', 'reviews'));
        } else {
			return redirect('/');
        }
	}
	// review add in database

	public function review_add(Request $request)
	{
        $doctor_id = $request->doctor_id;
        $patient_id = $request->user_id;
        $facilities = $request->facilities;
        $puntuality = $request->puntuality;
        $attention = $request->attention;
        $recommendable = $request->recommendable;
        $total = $facilities+$puntuality+$attention+$recommendable;
        $reason = $request->reason;
        $like = $request->like;
        $improved = $request->improved;
        if ($patient_id == $doctor_id) {
			return redirect()->back()->withInput()->with('error', 'No tienes permiso para dar una reseña.');
        } else {
        	if ($patient_id != NULL) {
		        if ($request->facilities != NULL && $request->puntuality != NULL && $request->attention != NULL && $request->recommendable != NULL) {
		        	$review = [
		        		'doctor_id' => $doctor_id,
		        		'patient_id' => $patient_id,
		        		'facilities' => $facilities,
		        		'puntuality' => $puntuality,
		        		'attention' => $attention,
		        		'recommendable' => $recommendable,
		        		'total' => $total,
		        		'reason' => $reason,
		        		'like' => $like,
		        		'improved' => $improved,
		        	];
			        $reviewInserted = DB::table('review_doctors')->insert($review);
			        // Insert review in doctor profile section
			        $allReviews = DB::table('review_doctors')->where('doctor_id', $doctor_id);
			        $allReviewsGet = $allReviews->get();

			        if ($allReviewsGet != NULL) {
	                  $reviewss = 0;
			          foreach ($allReviewsGet as $key => $reviewCount) {
			            $reviewss = $reviewss + $reviewCount->total;
			          }
			          $frstCalc = $reviewss/$allReviews->count();
			          $ratings = ($frstCalc/4);
			        } else {
			        	$ratings = 0;
			        }
			        $updateReview = [
			        	'reviews' => $ratings
			        ];

			        $updatedDoctorReview = DB::table('employees')->where('id', $doctor_id)->update($updateReview);
					return redirect('/thankyou_review/'.$doctor_id);
		        } else {
					return redirect()->back()->with('error', '¡Uy! Algo salió mal..');;
		        }
	        } else {
				return redirect()->back()->with('error', 'Por favor inicie sesión primero');
	        }
        }
	}


	// View Thank You page after review
	public function thankyou_review($hash_key)
	{
		$title = '¡Gracias! Tu opinion fue enviada';
		if (Auth::check()) {
			return view('frontend.thankyou_review', compact('title'));
		} else {
			return redirect('/');
		}
	}

	// Remove Specialty of Doctor with ajax
	public function remove_specialty(Request $request){	

		$user = DB::table('employees')->where('id', $request->user_id);
		$getUserRow = $user->first();
		$oldSpecialty = explode(',', substr($getUserRow->specialty, 0, -1));
		$oldsub_Specialty = explode(',', $getUserRow->sub_specialty);

		if (($key = array_search($request->specialty, $oldSpecialty)) !== false) {
		    unset($oldSpecialty[$key]);
		}
		if (($key = array_search($request->sub_specialty, $oldsub_Specialty)) !== false) {
		    unset($oldsub_Specialty[$key]);
		}

		$filtered_array = array_filter($oldSpecialty);
		$filtered_arraySubsp = array_filter($oldsub_Specialty);

		if (count($filtered_array) != 0) {
		
			$newSpecialtyStr = implode(",",$filtered_array);
			$newSubSpecialtyStr = implode(",",$filtered_arraySubsp);
			
			$updateSpecialty = [
		            'specialty' => $newSpecialtyStr.',',
		            'sub_specialty' => $newSubSpecialtyStr
			    ];
	        $done = $user->update($updateSpecialty);
	        return $done;
		} else {
			return 0;
		}
	}

	// Add Specialty of Doctor with ajax
	public function addSpecialty(Request $request)
	{
		$user = DB::table('employees')->where('id', $request->user_id);
		$getUserRow = $user->first();
		$oldSpecialty = explode(',', substr($getUserRow->specialty, 0, -1));
		$newSpecialty = explode(',', $request->specialty);
		$totalSpecialties = array_merge($oldSpecialty, $newSpecialty);

		$oldSubSpecialty = explode(',', $getUserRow->sub_specialty);
		$newSubSpecialty = explode(',', $request->sub_specialty);
		$totalSubSpecialties = array_merge($oldSubSpecialty, $newSubSpecialty);

		$allSpecialty = implode(',', $totalSpecialties);
		$newSubSpecialtyStr = implode(",", $totalSubSpecialties);

		$updateSpecialty = [
				'specialty' => $allSpecialty.',',
				'sub_specialty' => $newSubSpecialtyStr
			];
	    $done = $user->update($updateSpecialty);
	    return $totalSpecialties;
	}

	// Add/Update Forecast
	public function addForecast(Request $request)
	{
		$updateForecast = [
				'forecast' => $request->forecast
			];
	    $done = DB::table('employees')->where('id', $request->user_id)->update($updateForecast);
	    return $done;
	}

	// Add & Remove Service
	public function addService(Request $request)
	{
		$updateServices = [
	            'services' => serialize($request->data),
		    ];
        $done = DB::table('employees')->where('id', $request->user_id)->update($updateServices);	
        return $done;
	}

	// Book Appointment form page
	public function book_appointment($user_id, $hash_key, $date, $timeid)
	{
		if (Auth::check()) {
			$userID = Auth::user()->id;
	        $loginUser = DB::table('employees')->where('id', $userID)->first();
	    } else {
	    	$loginUser = NULL;
	    }
	    $appointment_date = $date;
		$doctor = DB::table('employees')->where([['id', $user_id],['hash_key', $hash_key]])->first();
		$consultantTime = DB::table('consulting_time')->where([['id', $timeid],['doctor_id', $user_id]])->first();
		if ($doctor) {
			$title = 'Book Appointment';
			return view('frontend.book_appointment', compact('title', 'loginUser', 'doctor', 'consultantTime', 'appointment_date'));
		} else {
			return redirect('/');
		}
	}

	// Appointment booking form submit action
	public function booked_appointment(Request $request)
	{
		if (Auth::check()) {
			if ($request->doctor_id != '' && $request->appointment_date != '' && $request->day != '' && $request->from_time && $request->from_AM_PM != '' && $request->patient_id != '' && $request->patient_id != 0 && $request->first_name != '' && $request->last_name != '' && $request->email != '' && $request->mobile != '' && $request->terms != '' && $request->location != '') {

			    $getDoctor = DB::table('employees')->where('id', $request->doctor_id)->first();
				$addAppointment = [
			            'doctor_id' => $request->doctor_id,
			            'patient_id' => $request->patient_id,
			            'first_name' => $request->first_name,
			            'last_name' => $request->last_name,
			            'email' => $request->email,
			            'mobile' => $request->mobile,
			            'day' => $request->day,
			            'appointment_date' => $request->appointment_date,
			            'status' => 'pending',
			            'from_time' => $request->from_time,
			            'from_AM_PM' => $request->from_AM_PM,
			            'location' => $request->location,
			            'comments' => $request->comments,
				    ];
			    $done = DB::table('appointments')->insert($addAppointment);

			    $baseUrl = url('/');

	        	$msg_template = '
					<div style="text-align: left;padding-left: 20px;padding-top: 50px;padding-bottom: 30px;">
						<h3>Reserva de cita<br></h3>
						<h4 style="padding: 0 20px 0 0;">
							<span lang="ES-CL" style="font-size:11.0pt;line-height:107%;color:#3e4247">'.$request->first_name.' '.$request->last_name.' ha reservado cita este '.$request->day.' a las '.$request->from_time.' '.$request->from_AM_PM.'</span>
							<br>
							<span lang="ES-CL" style="font-size:11.0pt;line-height:107%;color:#3e4247">Gracias por usar psicologos vibemar</span>
						</h4>
						<h5>A continuación se muestran los detalles.</h5>
						<ul style="list-style: none">
							<li>Nombre de pila: '.$request->first_name.'</li>
							<li>Apellido: '.$request->last_name.'</li>
							<li>correo electrónico: '.$request->email.'</li>
							<li>Contacto: '.$request->mobile.'</li>
							<li>Día: '.$request->day.'</li>
							<li>Hora: '.$request->from_time.' '.$request->from_AM_PM.'</li>
							<li>Comentario: '.$request->comments.'</li>
						</ul>
						
					</div>
	        	';
	        	$msg_templatePatient = '
					<div style="text-align: left;padding-left: 20px;padding-top: 50px;padding-bottom: 30px;">
						<h3>Reserva de cita<br></h3>
						<h4 style="padding: 0 20px 0 0;">
							<span lang="ES-CL" style="font-size:11.0pt;line-height:107%;color:#3e4247">Su cita con el Dr. '.$getDoctor->first_name.' ha sido reservada.</span>
							<br>
							<span lang="ES-CL" style="font-size:11.0pt;line-height:107%;color:#3e4247">Gracias por usar psicologos vibemar</span>
						</h4>
					</div>
	        	';
        	    $subject = 'Reserva de cita';
        	    $content = $msg_template;
        	    $contentPatient = $msg_templatePatient;

        		$data = array( 'email' => $getDoctor->email, 'subject' => $subject, 'message' => $content);
        		Mail::send([], $data, function ($m) use($data) {
                   $m->to($data['email'])->subject($data['subject'])->setBody($data['message'], 'text/html');
            	});

            	$dataPatient = array( 'email' => $request->email, 'subject' => $subject, 'message' => $contentPatient);
        		Mail::send([], $dataPatient, function ($m) use($dataPatient) {
                   $m->to($dataPatient['email'])->subject($dataPatient['subject'])->setBody($dataPatient['message'], 'text/html');
            	});


			    return redirect('/reservations')->with('message', 'Tu cita esta reservada');
			} else {
				return redirect()->back()->withInput()->with('error', '¡Uy! Algo salió mal..');
			}
		} else {
			return redirect()->back()->withInput()->with('error', 'Por favor, inicie sesión o regístrese para reservar su cita con el médico');
		}
	}

	// View all appointments
	public function reservations()
	{
		if (Auth::check()) {
			$userID = Auth::user()->id;
	        $EmpTbl = DB::table('employees')->where('id', $userID)->first();
		    $todayDate = Carbon::now()->toDateString();
		    $upcomingAppointments = DB::table('appointments')->where([['patient_id', $userID], ['appointment_date', '>=', $todayDate]])->orderBy('appointment_date', 'ASC')->get();
	        if ($EmpTbl->type == 'patient') {
				$title = 'Todas las reservas';
				$allDoctors = DB::table('employees')->where('type', 'doctor')->get();
				return view('frontend.quotes', compact('title', 'allDoctors', 'userID', 'EmpTbl', 'upcomingAppointments'));
	        } else {
				return redirect('/');
	        }

		} else {
			return redirect('/');
		}
	}

	// Quote Doctor form Page
	public function quote_doctor()
	{
		// if (Auth::check() && Auth::user()->type == 'patient') {
			$title = 'Cita doctor';
			if (Auth::check()) {
				$userID = Auth::user()->id;
		        $EmpTbl = DB::table('employees')->where('id', $userID)->first();
			} else {
				$EmpTbl = NULL;
			}
	        $allCities = DB::table('cities')->whereNull('deleted_at')->get();
			$allSpecialities = DB::table('specialities')->whereNull('deleted_at')->get();
			$allForecasts = DB::table('forecasts')->whereNull('deleted_at')->get();
			return view('frontend.quote_doctor', compact('title', 'userID', 'allCities', 'EmpTbl', 'allSpecialities', 'allForecasts'));
		// } else {
		// 	return redirect('/userlogin')->with('error', 'Por favor, inicie sesión primero');
		// }
	}

	// Send Emails to Doctors for quote
	public function send_quote_email(Request $request)
	{
		if ($request->name != '' && $request->contact != '' && $request->email != '' && $request->forecast != '' && $request->city != '' && $request->specialty != '' && $request->note != '') {

			$name = $request->name;
			$contact = $request->contact;
			$email = $request->email;
			$specialty = $request->specialty;
			$city = $request->city;
			$forecast = $request->forecast;
			$note = $request->note;
			$allDoctors = DB::table('employees')->where('type', 'doctor');
			$allDoctors->where('city', 'LIKE', "%$city%");
			$allDoctors->where('forecast', 'LIKE', "%$forecast%");
			if ($request->specialty) {
				foreach ($request->specialty as $key => $specialty) {
					$allDoctors->where('sub_specialty', 'LIKE', "%$specialty%");
				}
			}
			$findDoctors = $allDoctors->get();

			if ($findDoctors) {
				foreach ($findDoctors as $key => $findDoctor) {

					if ($findDoctor->profile == 'basic') {
						$explodedEmail = explode('@', $email);
						$newEmail = substr($explodedEmail[0], 0, -4) . 'xxxx';
						$explodedEmailDomain = explode('.', $explodedEmail[1]);
						$domain = str_repeat("x", strlen($explodedEmailDomain[0]));
						$email = $newEmail.'@'.$domain.'.'.$explodedEmailDomain[1];

						$contact = substr($contact, 0, -4) . 'xxxx';

						$specialty = 'xxx';

						$note = 'xxxxxxx';
					}
					
					//Updating Email content [Metakey]
					$get_email_content = DB::table('email_templates')->where('options', 'Quote')->whereNull('deleted_at')->first();
				    $content = $get_email_content->email_content;
				    $subject = $get_email_content->subject;
					
					$content = str_replace('[email]', $email, $content);
					$content = str_replace('[contact]', $contact, $content);
					$content = str_replace('[specialty]', $specialty, $content);
					$content = str_replace('[note]', $note, $content);
					$data = array( 'email' => $findDoctor->email, 'subject' => $subject, 'message' => $content);
					Mail::send([], $data, function ($m) use($data) {
			           $m->to($data['email'])->subject($data['subject'])->setBody($data['message'], 'text/html');
			    	});
				}
			}
			return redirect()->back()->with('message', 'Nota: Explícanos quesituación tienes para que te responda el psicólogo más adecuado.<br> Hemos enviado tu cotización ¡Pronto te contactara el psicólogo más adecuado!');
		} else {
			return redirect()->back()->with('error', '¡Uy! Algo salió mal..');
		}
	}
	
	// get doctor information on upcoming appointments
	public static function getDoctorInfo($id) {
        $EmpTbl = DB::table('employees')->WHERE('id', $id)->first();
		return $EmpTbl;
	}

	// Delete appointment
	public function deleteReservations($timeid)
	{
		if (Auth::check()) {
			$deleted = DB::table('appointments')->where('id', $timeid)->delete();
		    return redirect('/reservations')->with('message', 'Su cita es eliminada');
		} else {
			return redirect('/');
		}
	}

	// View All appointments
	public function doctor_appointments($id, $hash_key)
	{
		if (Auth::check()) {
			$title = 'Todas las citas';
		    $todayDate = Carbon::now()->toDateString();
			$upcomingAppointments = DB::table('appointments')->where([['doctor_id', $id], ['appointment_date', '>=', $todayDate]])->orderBy('appointment_date', 'ASC')->get();
	        $EmpTbl = DB::table('employees')->WHERE('id', $id)->first();
			return view('frontend.all_appointments', compact('title', 'EmpTbl', 'upcomingAppointments'));
		} else {
			return redirect('/');
		}
	}

	// View All appointments
	public function frequently(Request $request)
	{
		$question = $request->question;
		$title = 'F.A.Q';
        $faqs = DB::table('questions')->whereNull('deleted_at')->get();
		return view('frontend.frequently', compact('title', 'question', 'faqs'));
	}

    // ******************************************* Tickets Start ***************************************** //
	// View all Tickets Page
	public function my_tickets()
	{
		$title = 'Boleto';
		if (Auth::check()) {
			$user_id = Auth::user()->id;
	        $tickets = DB::table('tickets')->where('user_id', $user_id)->whereNull('deleted_at')->orderBy('id', 'DESC')->get();
			return view('frontend.support_ticket', compact('title', 'tickets'));
		} else {
			return redirect('/userlogin');
		}
	}

	// View Ticket Details page with chat
	public function title_view($id)
	{
		if (Auth::check()) {
			$title = 'Boleto';
	        $tickets = DB::table('tickets')->where('id', $id)->whereNull('deleted_at')->first(); 
	        $ticket_replytable = Tickets_reply::with('tickets')->with('users')->where('ticket_id', $id)->get();
	        $tickets_reply = json_decode($ticket_replytable);

	        return view('frontend.support_ticket_view',['data' => $tickets_reply, 'ticket' => $tickets, 'title' => $title]);
        } else {
			return redirect('/userlogin');
		}
    }
    // View add new tickets page
    public function ticket_add_page()
    {
		if (Auth::check()) {
			$title = 'Boleto';
        	return view('frontend.add_ticket', compact('title'));
		} else {
			return redirect('/userlogin');
		}     	
    }

    // Add New Ticket in D.B from Request
    public function ticket_data_add(Request $request)
    {
		if (Auth::check()) {
	        DB::table('tickets')->insert([
	            'ticket_title' => $request->ticket_title,
	            'ticket_description' => $request->ticket_description,
	            'user_id' => $request->user_id,
	            'date' => $request->date,
	            'ticket_status' => 'Open'
	        ]);
	        return redirect('/my_tickets');
        } else {
			return redirect('/userlogin');
		}
    }

    //reply to ticket message
    public function add_reply(Request $request)
    {
		if (Auth::check()) {
	        DB::table('tickets_replies')->insert([
	            'ticket_id' => $request->ticket_id,
	            'reply_date' => $request->reply_date,
	            'user_id' => $request->user_id,
	            'message' => $request->message
	            ]);
	        if (Auth::user()->type == 'admin') {
		        return redirect('/admin/title/'.$request->ticket_id);
	        } else {
		        return redirect('/tickets/tickets/'.$request->ticket_id);
	        }
	    } else {
			return redirect('/userlogin');
		}
    }

    // change ticket Status
    public function close_ticket($ticet_id, $status)
    {
    	if (Auth::check()) {
	        if($status == 'open'){
	            DB::table('tickets')->where('id', $ticet_id)->update( [ 'ticket_status' => 'Open']);
	        } else{
	            DB::table('tickets')->where('id', $ticet_id)->update( [ 'ticket_status' => 'Close']);    
	        }

	        if (Auth::user()->type == 'admin') {
		        return redirect('/admin/tickets');
	        } else {
		    	return redirect('/my_tickets');
	        }
	    } else {
			return redirect('/userlogin');
		}
    } 

    // ******************************************* Tickets End ***************************************** //


    /* ================== Flow Payment CronJob Start ================== */
    public function subscription_check()
    {
        $all_Doctors = DB::table('employees')->where([['type', 'doctor']])->get();
        if ($all_Doctors) {
            foreach ($all_Doctors as $key => $doctor) {
                
                $subscriptionID = $doctor->subscription_id;
                $premiumStartDate = $doctor->premium_start_date;
                $premiumEndDate = $doctor->premium_end_date;
                $doctorID = $doctor->id;
                $profile = $doctor->profile;
                
                if(!empty($subscriptionID)){
                    
                    $response = $this->getSubscription($subscriptionID);
                  
                    if(!empty($response)){
                        
                        $subscriptionData = json_decode($response);    
                        
                        if(!empty($subscriptionData->invoices)) {
                            
                            $invoices = $subscriptionData->invoices;
                            
                            $totalPayment = count($invoices);
                            
                            $paymentStatus = $invoices[$totalPayment - 1]->status;
                            // if the current duartion is paid
                            if($paymentStatus == 1) {
                                
                                $fetchedData = DB::table('employees')->where('id', $doctorID)->first();
                                
                                $planID = $fetchedData->premium;
                                
                                $startDate = date("Y-m-d h:i:s");
                                
                                if($planID == 'yearly') {
                                    
                                    $endDate = date('Y-m-d h:i:s', strtotime($startDate. ' + 1 Year'));    
                                    
                                } else{
                                    
                                    $endDate = date('Y-m-d h:i:s', strtotime($startDate. ' + 6 Month'));    
                                    
                                }
                                if(empty($premiumStartDate) || empty($premiumEndDate) || $profile == 'basic'){
                                    
                                      $dataUpdate = [
                            		    'profile' => 'premium',
                            		    'premium_start_date' => $startDate,
                            		    'premium_end_date' => $endDate,
                            		    'status' => 'cancelar suscripción'
                            		  ];
                                    $updated = DB::table('employees')->where('id', $doctorID)->update($dataUpdate);
                                }else{
                                    $invoices[$totalPayment - 1]->created;
                                    $flowStartDate = explode(' ', $invoices[$totalPayment - 1]->created);
                                    
                                    $dbStartDate = explode(' ', $premiumStartDate);
                                    
                                    if($flowStartDate[0] != $dbStartDate[0]){
                                        $dataUpdate = [
                                		    'profile' => 'premium',
                                		    'premium_start_date' => $startDate,
                                		    'premium_end_date' => $endDate,
                                		    'status' => 'cancelar suscripción'
                            		    ];
                            		  
                            		    $updated = DB::table('employees')->where('id', $doctorID)->update($dataUpdate);
                                    }
                                    
                                }
                                
                            } else {
                            	// if the current duration is not paid 
                                $data = [
                        		    'profile' => 'basic',
                        		    'premium_start_date' => null,
                        		    'premium_end_date' => null,
                        		    'status' => 'Pedido pendiente'
                        		  ];
                                DB::table('employees')->where('id', $doctorID)->update($data);
                            }
                        } else {
                            $data = [
                    		    'profile' => 'basic',
                    		    'premium_start_date' => null,
                    		    'premium_end_date' => null,
                    		    'status' => 'Pedido pendiente'
                    		  ];
                            DB::table('employees')->where('id', $doctorID)->update($data);
                        }
                    }
                       
                } else {
                	
                    if(!empty($premiumEndDate) || !empty($premiumStartDate)) {
                        
                        $endDate = strtotime($premiumEndDate);
                        
                        $now = time();
                        
                        if($endDate < $now || $endDate == $now){
                            $data = [
                    		    'profile' => 'basic',
                    		    'premium_start_date' => null,
                    		    'premium_end_date' => null,
                    		    'status' => 'Pedido pendiente',
                    		    'premium' => null
                    		];
                            DB::table('employees')->where('id', $doctorID)->update($data);
                        }
                    }
                }
            }
        }
    }
	
	/* ================== Flow Payment Functions Start================== */
	
	public function createCustomer($package)
    {  
        Session::set('package', $package);
        
        $flowApi = new FlowController;

        $url = $flowApi->apiURL.'/customer/create';

        $params = array( 
          "apiKey"      => $flowApi->apiKey,
          "email"       => Auth::user()->email,
          "externalId"  => uniqid(),
          "name"        => Auth::user()->name,
        );

        $data = '';
        foreach($params as $key => $value) {
            $data .= '&' . $key . '=' . $value;
        }

        $data = substr($data, 1);
        
        $signature = hash_hmac('sha256', $data , $flowApi->secretKey);
       

        $url = $url . '?' . $data . '?s=' . $signature;
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data . '&s=' . $signature);
            $response = curl_exec($ch);
            if($response === false) {
              $error = curl_error($ch);
              throw new Exception($error, 1);
            } 
            $info = curl_getinfo($ch);
            if(!in_array($info['http_code'], array('200', '400', '401'))) {
              throw new Exception('Ocurrió un error inesperado. HTTP_CODE: '.$info['http_code'] , $info['http_code']);
            }

            $customerData = json_decode($response);

            // save customerid in db to delete this customer when a customer unsubscribe
            $id = $customerData->customerId;
               
            return redirect($this->registerCustomer($id));  
            
        } catch (Exception $e) {
            return 'Error: ' . $e->getCode() . ' - ' . $e->getMessage();
        }
    }

    public function registerCustomer($customerID)
    {
        $flowApi = new FlowController;

        $url = $flowApi->apiURL.'/customer/register';

        $params = array( 
          "apiKey"      => $flowApi->apiKey,
          "customerId"       => $customerID,
          "url_return"  => $flowApi->baseURL.'/registeredurl'
        );

        $data = '';
        foreach($params as $key => $value) {
            $data .= '&' . $key . '=' . $value;
        }

        $data = substr($data, 1);
        
        $signature = hash_hmac('sha256', $data , $flowApi->secretKey);
        

        $url = $url . '?' . $data . '?s=' . $signature;
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data . '&s=' . $signature);
            $response = curl_exec($ch);
            if($response === false) {
              $error = curl_error($ch);
              throw new Exception($error, 1);
            } 
            $info = curl_getinfo($ch);
            if(!in_array($info['http_code'], array('200', '400', '401'))) {
              throw new Exception('Ocurrió un error inesperado. HTTP_CODE: '.$info['http_code'] , $info['http_code']);
            }
            
            $data = json_decode($response);

            // url + "? token =" + token
            return $data->url.'?token='.$data->token;
                      
            
        } catch (Exception $e) {
            return 'Error: ' . $e->getCode() . ' - ' . $e->getMessage();
        }
    }   

    public function registeredUrl(Request $request)
    {
        $token = $request['token'];

        $flowApi = new FlowController;

        $url = $flowApi->apiURL.'/customer/getRegisterStatus';

        $params = array( 
          "apiKey"      => $flowApi->apiKey,
          "token"       => $token
        );

        $data = '';
        foreach($params as $key => $value) {
            $data .= '&' . $key . '=' . $value;
        }

        $data = substr($data, 1);
        
        $signature = hash_hmac('sha256', $data , $flowApi->secretKey);
        

        $url = $url . '?' . $data . '&s=' . $signature;
        
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            $response = curl_exec($ch);
            if($response === false) {
              $error = curl_error($ch);
              throw new Exception($error, 1);
            } 
            $info = curl_getinfo($ch);
            if(!in_array($info['http_code'], array('200', '400', '401'))) {
              throw new Exception('Ocurrió un error inesperado. HTTP_CODE: '.$info['http_code'] , $info['http_code']);
            }
            
            $data = json_decode($response);
            
            if($data->status == 1){
                
                $responseData = $this->purchaseSubscription($data->customerId);

                $data = json_decode($responseData);

                $subscriptionID = $data->subscriptionId; // save in db we need this id when user want to unsubscribe
                
                $startDate = date("Y-m-d h:i:s");
                
                $planID = Session::get('package');
                
                $data = [
        		    'premium' => $planID,
        		    'subscription_id' => $subscriptionID,
        		    'premium_start_date' => null,
        		    'premium_end_date' => null
        		  ];
                DB::table('employees')->where('id', Auth::user()->id)->update($data);
                
                \Session::flash('message','Gracias por la suscripción');

                return redirect('/premium_profile/'.Auth::user()->id.'/'.Auth::user()->hash_key);
                
            }else{
                \Session::flash('message','Pago cancelado');

                return redirect('/premium_profile/'.Auth::user()->id.'/'.Auth::user()->hash_key);
                
            }
                      
            
        } catch (Exception $e) {
            return 'Error: ' . $e->getCode() . ' - ' . $e->getMessage();
        }
    }

    public function purchaseSubscription($customerID)
    {       
        $planID = Session::get('package');

        $flowApi = new FlowController;

        $url = $flowApi->apiURL.'/subscription/create';

         $subscriptionParams = array( 
            "apiKey"      => $flowApi->apiKey,
            "customerId"  => $customerID ,           
            "planId"       => $planID
        );          

          $data = '';
          foreach($subscriptionParams as $key => $value) {
              $data .= '&' . $key . '=' . $value;
          }

          $data = substr($data, 1);
          
          $signature = hash_hmac('sha256', $data , $flowApi->secretKey);
         

          $url = $url . '?' . $data . '?s=' . $signature;
            try {
              $ch = curl_init();
              curl_setopt($ch, CURLOPT_URL, $url);
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
              curl_setopt($ch, CURLOPT_POST, TRUE);
              curl_setopt($ch, CURLOPT_POSTFIELDS, $data . '&s=' . $signature);
              $response = curl_exec($ch);
              if($response === false) {
                $error = curl_error($ch);
                throw new Exception($error, 1);
              } 
              $info = curl_getinfo($ch);
              if(!in_array($info['http_code'], array('200', '400', '401'))) {
                throw new Exception('Ocurrió un error inesperado. HTTP_CODE: '.$info['http_code'] , $info['http_code']);
              }

              return $response;

            } catch (Exception $e) {
              echo 'Error: ' . $e->getCode() . ' - ' . $e->getMessage();
            }
    }
    
     public function cancelSubscription()
    {       
        $fetchData = DB::table('employees')->where('id', Auth::user()->id)->first();
        
        $subscriptionID = $fetchData->subscription_id;
        
        if(!empty($subscriptionID)){
          $flowApi = new FlowController;

        $url = $flowApi->apiURL.'/subscription/cancel';

         $subscriptionParams = array( 
            "apiKey"      => $flowApi->apiKey,
            "subscriptionId"  => $subscriptionID 
        );       

          $data = '';
          foreach($subscriptionParams as $key => $value) {
              $data .= '&' . $key . '=' . $value;
          }

          $data = substr($data, 1);
          
          $signature = hash_hmac('sha256', $data , $flowApi->secretKey);
         

          $url = $url . '?' . $data . '&s=' . $signature;
            try {
              $ch = curl_init();
              curl_setopt($ch, CURLOPT_URL, $url);
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
              curl_setopt($ch, CURLOPT_POST, TRUE);
              curl_setopt($ch, CURLOPT_POSTFIELDS, $data . '&s=' . $signature);
              $response = curl_exec($ch);
              if($response === false) {
                $error = curl_error($ch);
                throw new Exception($error, 1);
              } 
              $info = curl_getinfo($ch);
              if(!in_array($info['http_code'], array('200', '400', '401'))) {
                throw new Exception('Ocurrió un error inesperado. HTTP_CODE: '.$info['http_code'] , $info['http_code']);
              }              

                $responseData = json_decode($response);
                
                $deleteClientData = $this->deleteClient($responseData->customerId);
                  $data = [
        		    'subscription_id' => '',
        		    'status' => 'Pedido pendiente'
    		      ];
            
                DB::table('employees')->where('id', Auth::user()->id)->update($data);
                
                \Session::flash('message','suscripción cancelada');
    
                return redirect('/premium_profile/'.Auth::user()->id.'/'.Auth::user()->hash_key);
                

            } catch (Exception $e) {
              echo 'Error: ' . $e->getCode() . ' - ' . $e->getMessage();
            }  
        }else{
            \Session::flash('message','Periodo de membresía no finalizado');

            return redirect('/premium_profile/'.Auth::user()->id.'/'.Auth::user()->hash_key);
        }
        
    }

    public function deleteClient($customerID = false)
    {

        if (!empty($customerID)) {
           
            $flowApi = new FlowController;

            $url = $flowApi->apiURL.'/customer/delete';

            $params = array( 
              "apiKey"		=> $flowApi->apiKey,
              "customerId"	=> $customerID
            );

            $data = '';
            foreach($params as $key => $value) {
                $data .= '&' . $key . '=' . $value;
            }

            $data = substr($data, 1);
            
            $signature = hash_hmac('sha256', $data , $flowApi->secretKey);
            

            $url = $url . '?' . $data . '?s=' . $signature;
            try {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                curl_setopt($ch, CURLOPT_POST, TRUE);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data . '&s=' . $signature);
                $response = curl_exec($ch);
                if($response === false) {
                  $error = curl_error($ch);
                  throw new Exception($error, 1);
                } 
                $info = curl_getinfo($ch);
                if(!in_array($info['http_code'], array('200', '400', '401'))) {
                  throw new Exception('Ocurrió un error inesperado. HTTP_CODE: '.$info['http_code'] , $info['http_code']);
                }
                
                $this->unRegisterCustomerCreditCard($customerID);
                
            } catch (Exception $e) {
                return 'Error: ' . $e->getCode() . ' - ' . $e->getMessage();
            }
        }
    }

    public function unRegisterCustomerCreditCard($customerID)
    {
        $flowApi = new FlowController;

        $url = $flowApi->apiURL.'/customer/unRegister';

        $params = array( 
          "apiKey"      => $flowApi->apiKey,
          "customerId"       => 'cus_gw0zcg0qf8'
        );

        $data = '';
        foreach($params as $key => $value) {
            $data .= '&' . $key . '=' . $value;
        }

        $data = substr($data, 1);
        
        $signature = hash_hmac('sha256', $data , $flowApi->secretKey);
        

        $url = $url . '?' . $data . '?s=' . $signature;
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data . '&s=' . $signature);
            $response = curl_exec($ch);
            if($response === false) {
              $error = curl_error($ch);
              throw new Exception($error, 1);
            } 
            $info = curl_getinfo($ch);
            if(!in_array($info['http_code'], array('200', '400', '401'))) {
              throw new Exception('Ocurrió un error inesperado. HTTP_CODE: '.$info['http_code'] , $info['http_code']);
            }
            
            return $response;
            
        } catch (Exception $e) {
            return 'Error: ' . $e->getCode() . ' - ' . $e->getMessage();
        }
    }
    
   public function getSubscription($subscriptionID)
    {      
    
        $flowApi = new FlowController;

        $url = $flowApi->apiURL.'/subscription/get';

        $params = array( 
          "apiKey"      => $flowApi->apiKey,
          "subscriptionId"  => $subscriptionID       
        );

        $data = '';
        foreach($params as $key => $value) {
            $data .= '&' . $key . '=' . $value;
        }

        $data = substr($data, 1);
        
        $signature = hash_hmac('sha256', $data , $flowApi->secretKey);
       

        $url = $url . '?' . $data . '&s=' . $signature;
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            $response = curl_exec($ch);
            if($response === false) {
              $error = curl_error($ch);
              throw new Exception($error, 1);
            } 
            $info = curl_getinfo($ch);
            if(!in_array($info['http_code'], array('200', '400', '401'))) {
              throw new Exception('Ocurrió un error inesperado. HTTP_CODE: '.$info['http_code'] , $info['http_code']);
            }

            return $response;
            
        } catch (Exception $e) {
            return 'Error: ' . $e->getCode() . ' - ' . $e->getMessage();
        }
    }
    
    /* ================== Flow Payment Functions End================== */


}
