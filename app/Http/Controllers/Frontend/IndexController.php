<?php


namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Hash;
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
use Mail;
use Log;



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
		$title = 'Home-Doctaria';
		$allSpecialitiesBottom = DB::table('specialities')->take(10)->get();
		$allCities = DB::table('cities')->take(10)->get();
		$allForecasts = DB::table('forecasts')->take(10)->get();
		return view('frontend.index', compact('title', 'allSpecialitiesBottom', 'allCities', 'allForecasts'));
	}

	// View city/specialty/forecast
	public function viewFullbyTag($tag)
	{
		$title = 'All '.$tag;
		if ($tag == 'Specialty') {
			$table = 'specialities';
			$heading = 'Specialists';
		}
		if ($tag == 'City') {
			$table = 'cities';
			$heading = 'Health professionals Chile';
		}
		if ($tag == 'Forecast') {
			$table = 'forecasts';
			$heading = 'Forecast';
		}
		$allTags = DB::table($table)->get();
		return view('frontend.viewFullbyTag', compact('title', 'table', 'allTags', 'heading'));
	}

	

	// View Doctor Login Page
	public function login()
	{
		$title = 'Login';
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
		$title = 'Patient Login';
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
				return redirect()->back()->withInput()->with('error', 'User Password Does Not Match! if you dont have your accout  <a href="/register">Register Here </a>');
			}
		}else {
			return redirect()->back()->withInput()->with('error', 'This Email address is not registered <a href="/register">Register Here </a>');
			
		}
		
	}

	// View Forgot password Page
	public function forgot_password()
	{
		$title = 'Forgot Password';
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
			return redirect()->back()->withInput()->with('message', 'Password Reset link send to your email Kindly check your email');
		}else {
			return redirect()->back()->withInput()->with('error', 'This Email address is not registered <a href="/register">Register Here </a>');
		}
		
	}

	// enter new password after forgot page
	public function enter_new_password($GUID)
	{
		$title = 'Reset Password';
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
					return redirect('/userlogin')->with('message', 'Password Reset Successfully');
		        } else {
					return redirect()->back()->withInput()->with('error', 'Oops! Something went wrong..');
		        }
			} else {
				return redirect()->back()->with('error', 'Your password and confirmation password do not match');	
			}
		}
	}

	// Doctor register page
	public function register_doctor_init()
	{
		$title = 'Register Doctor';
		if (Auth::check()) {
			return redirect('/');
		} else {
			$allCities = DB::table('cities')->get();
			$allForecasts = DB::table('forecasts')->get();
			return view('frontend.register_init', compact('title', 'allCities', 'allForecasts'));
		}
	}

	// Doctor register page select speciality
	public function register_doctor_mid(Request $request)
	{
		$title = 'Register Doctor';
		if (Auth::check()) {
			return redirect('/');
		} else {
			$allSpecialities = DB::table('specialities')->get();
			$inputFields = [
				'first_name' => $request->first_name,
				'last_name' => $request->last_name,
				'city' => $request->city,
				'forecast' => $request->forecast,
				'gender' => $request->gender
			];
			return view('frontend.register_mid', compact('title', 'inputFields', 'allSpecialities'));
		}
	}
	// Doctor register page
	public function register_doctor(Request $request)
	{
		$title = 'Register Doctor';
		if (Auth::check()) {
			return redirect('/');
		} else {
			$inputFields = [
				'first_name' => $request->first_name,
				'last_name' => $request->last_name,
				'city' => $request->city,
				'forecast' => $request->forecast,
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
			$city = $request->input('city');
			$forecast = $request->input('forecast');
			if ($validator->fails()) {
				return redirect()->back()->withInput()->with('error', 'Oops! Something went wrong..');;
			}
		} else {
			$type = 'patient';
			$profile = '';
			if ($email == '' || $confirm_password == '' || $request->input('password') == '' || $confirm_password != $request->input('password')) {
				return redirect()->back()->withInput()->with('error', 'Oops! Something went wrong..');
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
		    'forecast' => $forecast,
		    'address' => "",
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
			$user = [
	            'name' => $first_name,
	            'email' => $email,
	            'password' => bcrypt($confirm_password),
	            'context_id' => $getInsertedId,
	            'type' => $type,
	            'hash_key' => $hashKey,
			    'created_at' => Carbon::now(),
			    'status' => 'deactive',
			    'confirm_email' => uniqid(time()).uniqid(),
			    
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

			return redirect('/confirm_email/'.$user['hash_key']);
		}
		else {
			return redirect()->back()->withInput()->with('error', $authenticateResult);
		}

	}

	// email address check if already check
	public function register_authenticate($email)
	{
        $haveUser = DB::table('users')->WHERE('email', $email)->first();
        if ($haveUser) {
    		return $messsage = 'Email Address already exists!';
        }
        else {
        	return true;
        }
	}

	//view Confirm email page
	public function confirm_email($hash_key)
	{
		$title = 'Confirm Email';
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
		$title = 'Change Email';
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

				return redirect('confirm_email/'.$NewUser->hash_key);
	    	} else {
				return redirect()->back()->withInput()->with('error', 'Email Address already exists!');
	    	}
		}
	}

	// View normal Profile Page
	public function my_data()
	{
		$title = 'Edit Profile';
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
			return redirect()->back()->withInput()->with('message', 'Profile Updated Successfully');

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
	
	// Doctor Full Profile Edit
	public function doctor_profile_full($uniqid)
	{
		if (Auth::check()) {
			$userID = Auth::user()->id;
	        $UserTbl = DB::table('users')->WHERE([['id', $userID], ['hash_key', $uniqid]])->first();
	        $EmpTbl = DB::table('employees')->WHERE('id', $userID)->first();
			$allSpecialities = DB::table('specialities')->get();
			$title = $EmpTbl->first_name;
	        if ($UserTbl != NULL) {
				return view('frontend.doctor_full_profile', compact('title', 'UserTbl', 'EmpTbl', 'allSpecialities'));
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
		$title = 'Consulting Time';
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
			
			$updateConsulting = [
	            'doctor_id' => $user_id,
	            'day' => $day,
	            'from_time' => $from_time,
	            'from_AM_PM' => $from_AM_PM,
	            'to_time' => $to_time,
	            'to_AM_PM' => $to_AM_PM,
	            'location' => $location
		    ];

			if ($status != NULL) {
		        $done = DB::table('consulting_time')->insert($updateConsulting);
				return redirect()->back()->with('message', 'Consulting time updated successfully');
			} else {
				$updateConsultingOff = [
		            'doctor_id' => $user_id,
		            'day' => $day,
		            'status' => 'off'
				];

		        $done = DB::table('consulting_time')->insert($updateConsultingOff);
				return redirect()->back()->with('message', 'Consulting time updated successfully');
			}
		} else {
			return redirect('/');
		}
	}

	// View all Doctors
	public function all_professional(Request $request)
	{
		$title = 'All Professional';
		$allDoctorswithFilters = DB::table('employees')->where('type', 'doctor');
		$specialty = $request->specialty.',';
		$city = $request->city;
		$forecast = $request->forecast;
		$inputKeywords = $request->searchByInput;
		
		if ($request->searchByInput != '') {
			$allDoctorswithFilters->Where('first_name', 'LIKE', "%$inputKeywords%");
			$allDoctorswithFilters->orWhere('city', 'LIKE', "%$inputKeywords%");
			$allDoctorswithFilters->orWhere('sub_specialty', 'LIKE', "%$inputKeywords%");
			$allDoctorswithFilters->orWhere('forecast', 'LIKE', "%$inputKeywords%");
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
		$title = 'Contact Us';
		return view('frontend.contact_us', compact('title'));
	}

	// Contact Us Email Section
	public function contact_us_email()
	{
		return redirect()->back()->withInput()->with('message', 'Thank you for contacting us');
	}
	
	

	// view favourtie doctors of single patient
	public function favourites()
	{
		if (Auth::check()) {
			$userID = Auth::user()->id;
	        $EmpTbl = DB::table('employees')->where('id', $userID)->first();
	        $UserTbl = DB::table('users')->where('id', $userID)->first();
	        if ($UserTbl->type == 'patient') {
				$title = 'My Favourites';
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

	public static function getTimingDoctor($day, $id) {
		$allTimings = DB::table('consulting_time')->WHERE('day', $day)->WHERE('doctor_id', $id)->get();
        $EmpTbl = DB::table('employees')->WHERE('id', $id)->first();
		$times = '';
		if ($allTimings != NULL) {
			foreach ($allTimings as $key => $allTiming) {
				if ($allTiming->status == 'off') {
					continue;
				} else {
					$times .= '<p class="mb-1"><a href="/book_appointment/'.$EmpTbl->id.'/'.$EmpTbl->hash_key.'/'.$allTiming->id.'">'.$allTiming->from_time.' '.$allTiming->from_AM_PM.'</a></p>';
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
				return redirect()->back();
	        }
        } else {
			return redirect()->back();
        }
	}

	// View Thank You page after review
	public function thankyou_review($hash_key)
	{
		$title = 'Thank You! Your opinion was sent';
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
	public function book_appointment($userid, $hash_key, $timeid)
	{
		if (Auth::check()) {
			$userID = Auth::user()->id;
	        $loginUser = DB::table('employees')->where('id', $userID)->first();
	    } else {
	    	$loginUser = NULL;
	    }

		$doctor = DB::table('employees')->where([['id', $userid],['hash_key', $hash_key]])->first();
		$consultantTime = DB::table('consulting_time')->where([['id', $timeid],['doctor_id', $userid]])->first();
		if ($doctor) {
			$title = 'Book Appointment';
			return view('frontend.book_appointment', compact('title', 'loginUser', 'doctor', 'consultantTime'));
		} else {
			return redirect('/');
		}
	}

	// Appointment booking form submit action
	public function booked_appointment(Request $request)
	{
		if (Auth::check()) {
			if ($request->doctor_id != '' && $request->appointment_date != '' && $request->day != '' && $request->from_time && $request->from_AM_PM != '' && $request->patient_id != '' && $request->patient_id != 0 && $request->first_name != '' && $request->last_name != '' && $request->email != '' && $request->mobile != '' && $request->terms != '' && $request->location != '') {
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
			    return redirect('/reservations')->with('message', 'Your Appointment is booked');
			} else {
				return redirect()->back()->withInput()->with('error', 'Oops! Something went wrong..');
			}
		} else {
			return redirect()->back()->withInput()->with('error', 'Please Login or Register to book your Appointment with Doctor');
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
				$title = 'All Reservations';
				$allDoctors = DB::table('employees')->where('type', 'doctor')->get();
				return view('frontend.quotes', compact('title', 'allDoctors', 'userID', 'EmpTbl', 'upcomingAppointments'));
	        } else {
				return redirect('/');
	        }

		} else {
			return redirect('/');
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
		    return redirect('/reservations')->with('message', 'Your appointment is deleted');
		} else {
			return redirect('/');
		}
	}

	// View All appointments
	public function doctor_appointments($id, $hash_key)
	{
		if (Auth::check()) {
			$title = 'All Apointments';
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
		return view('frontend.frequently', compact('title'));
		
	}

	

	

	

	

	

	



	
	

	
	


	

	

	

	
	

	










	public function search($query)
	{
		$title = 'Ethical Hacking Course In Tamil';
        $haveCourses = DB::table('all_courses')->WHERE([['status', '=' , 'Active'], ['name', 'like', '%'.$query.'%']])->orderBy('created_at', 'DESC')->paginate(9);
        $haveCategories = DB::table('categories')->WHERE('parent_id', '!=', '[]')->orderBy('created_at', 'DESC')->get();
		return view('frontend.index', compact('title', 'haveCourses', 'haveCategories'));
	}

	
	public function course_questions($course_id)
	{		

		$title = 'F.A.Q';
		if (Auth::check()) {
	        $singleCourse = DB::table('all_courses')->WHERE('id', $course_id)->first();
	        $allQuestions = DB::table('faq_questions')->WHERE('course_id', $course_id)->orderBy('id', 'DESC')->limit(10)->get();

	        $purchased = explode(',', trim($singleCourse->purchased_by, "[]"));
	        if ($purchased != '') {
	           if (in_array('"'.Auth::user()->id.'"', $purchased))  {
					return view('frontend.questions', compact('title', 'singleCourse', 'allQuestions'));
				}
				return redirect('/single_course/'.$course_id);
			}
		} else {
			return redirect('/');
		}
	}

	public function questions_answer($course_id, $question_id)
	{		
		$title = 'Answers';
		if (Auth::check()) {
	        $singleCourse = DB::table('all_courses')->WHERE('id', $course_id)->first();
	        $Question = DB::table('faq_questions')->WHERE('id', $question_id)->first();
	        $AllAnswers = DB::table('faq_answers')->WHERE([['course_id', $course_id], ['question_id', $question_id]])->orderBy('created_at', 'DESC')->get();
	        $purchased = explode(',', trim($singleCourse->purchased_by, "[]"));
	        if ($purchased != '') {
	        	if (in_array('"'.Auth::user()->id.'"', $purchased))  {
					return view('frontend.answer', compact('title', 'singleCourse', 'AllAnswers', 'Question'));
				}
				return redirect('/single_course/'.$course_id);
			}
		} else {
			return redirect('/');
		}
	}



	public function ask_question(Request $request){	

		$UserImage = $request->user_image;
		$current_time = Carbon::now()->toDateTimeString();
		DB::table('faq_questions')->insert([
			'course_id' => $request->course_id,
			'user_id' => $request->user_id,
			'title' => $request->question_title,
			'created_at' => $current_time,
			'question' => $request->question_ask,
			'answer_count' => 0
		]);
		$getInsertedId = DB::getPdo()->lastInsertId();

		$current_comment = "
			<div class='question-list-question--wrapper--1zMqr question-overview--question--244jE'>
			    <div class='question-list-question--question-link--iEDXQ'>
			       <div>
			          <div>
			            <img alt='".$request->user_name."' src='".$UserImage."' class='user-avatar user-avatar--image img-circle'>
			          </div>
			       </div>
			       <div class='question-list-question--content--SEjFC question-overview--question-content--2M-k-'>
			          <div class='question-list-question--title--4K-V_'>".$request->user_name."</div>
			          <div class='question-list-question--body--2v0oT'><a href='/answer/".$request->course_id."/".$getInsertedId."'>".$request->question_title."</a></div>
			       </div>
			       <div>
			          <div class='question-list-question--num-answers--2vE_g'>0</div>
			          <div class='responses'>Responses</div>
			       </div>
			    </div>
			</div>";
      return $current_comment;
	}

	public function write_answer(Request $request){	

        $Question = DB::table('faq_questions')->WHERE('id', $request->question_id)->first();
        $newCount = (int)$Question->answer_count + 1;
		$current_time = Carbon::now()->toDateTimeString();
		DB::table('faq_answers')->insert([
			'user_id' => $request->user_id,
			'question_id' => $request->question_id,
			'course_id' => $request->course_id,
			'answer' => $request->answer_text,
			'created_at' => $current_time
		]);
		$UpdateCount = ['answer_count' => $newCount];
        $updates = DB::table('faq_questions')->where('id', $request->question_id)->update($UpdateCount);
	}

	public function load_questions(Request $request){	
	    $allQuestions = DB::table('faq_questions')->WHERE('course_id', $request->course_id)->orderBy('id', 'DESC')->offset($request->offset)->limit(10)->get();
	    $newQuestions = "";
	    if (!empty($allQuestions)) {
		    foreach ($allQuestions as $key => $allQuestion) {
		    	$User = DB::table('employees')->WHERE('id', $allQuestion->user_id)->first();
		    	if ($User->image != 0) {
                  $Image = DB::table('uploads')->WHERE('id', $User->image)->first();
                    if ($Image) {
                      $UserImage = "/files/$Image->hash/$Image->name";
                    } else {
                     $UserImage = "/frontend/images/defaultImage.jpg";
                    }
                } else {
                     $UserImage = "/frontend/images/defaultImage.jpg";
	            }
	            $newQuestions .= "<div class='question-list-question--wrapper--1zMqr question-overview--question--244jE'><div class='question-list-question--question-link--iEDXQ'><div><div><img alt='".$User->name."' src='".$UserImage."' class='user-avatar user-avatar--image img-circle'></div></div><div class='question-list-question--content--SEjFC question-overview--question-content--2M-k-'><div class='question-list-question--title--4K-V_'>".$User->name."</div><div class='question-list-question--body--2v0oT'><a href='/answer/".$request->course_id."/".$allQuestion->id."'>".$allQuestion->title."</a></div></div><div><div class='question-list-question--num-answers--2vE_g'>".$allQuestion->answer_count."</div><div class='responses'>Responses</div></div></div></div>";
		    }
	    }
	    return $newQuestions;
	}


}
