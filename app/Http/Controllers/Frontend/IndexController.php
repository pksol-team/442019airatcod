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
		return view('frontend.index', compact('title'));
	}

	// View Login Page
	public function login()
	{
		$title = 'Login';
		if (Auth::check()) {
			return redirect('/');
		} else {
			return view('frontend.login', compact('title'));
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
	public function register_doctor()
	{
		$title = 'Register Doctor';
		if (Auth::check()) {
			return redirect('/');
		} else {
			return view('frontend.register', compact('title'));
		}
	}

	// registration fields check and register
	public function register_check(Request $request)
	{
		$RUT_number = $request->input('RUT_number');
		$contact = $request->input('contact');
		$email = $request->input('email');
		$confirm_password = $request->input('confirm_password');
		$how_did_know = $request->input('how_did_know');
		$subscribe_notifications = $request->input('notification');

		$rules = Module::validateRules("Employees", $request);

		$validator = Validator::make($request->all(), $rules);
		
		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$authenticateResult = $this->register_authenticate($email);
		if ($authenticateResult === true) {
		$employee = [
		    'first_name' => 'user',
		    'RUT_number' => $RUT_number,
		    'how_did_know' => $how_did_know,
		    'notification' => $subscribe_notifications,
		    'mobile' => $contact,
		    'mobile2' => "",
		    'email' => $email,
		    'gender' => '',
		    'dept' => "1",
		    'city' => "",
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
	            'name' => 'user',
	            'email' => $email,
	            'password' => bcrypt($confirm_password),
	            'context_id' => $getInsertedId,
	            'type' => "doctor",
	            'hash_key' => uniqid(time()),
			    'created_at' => Carbon::now(),
			    'status' => 'deactive',
	        ];
			$insertedUsers = DB::table('users')->insert($user);
			if ($insertedUsers) {
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

	//View Confirm email page
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
	public function doctor_profile()
	{
		$title = 'Edit Profile';
		if (Auth::check()) {
			$userID = Auth::user()->id;
	        $EmpTbl = DB::table('employees')->where('id', $userID)->first();
	        $UserTbl = DB::table('users')->where('id', $userID)->first();
			return view('frontend.doctor_profile', compact('title', 'EmpTbl', 'UserTbl'));
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

			if ($validatorEmp->fails()) {
				return redirect()->back()->withInput()->with('error', 'Oops! Something went wrong..');
			}

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

	public function doctor_profile_full($uniqid)
	{
		$title = 'Doctor Profile';
		if (Auth::check()) {
			$userID = Auth::user()->id;
	        $UserTbl = DB::table('users')->WHERE([['id', $userID], ['hash_key', $uniqid]])->first();
	        $EmpTbl = DB::table('employees')->WHERE('id', $userID)->first();
	        if ($UserTbl != NULL) {
				return view('frontend.doctor_full_profile', compact('title', 'UserTbl', 'EmpTbl'));
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

	public function fileStore(Request $request) {

        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('upload'), $imageName);
        
        $imageUpload = new doctor_profile_full();
        $imageUpload->filename = $imageName;
        $imageUpload->save();
        return response()->json(['success'=>$imageName]);
			
    }

	

	

	

	

	
	

	










	public function search($query)
	{
		$title = 'Ethical Hacking Course In Tamil';
        $haveCourses = DB::table('all_courses')->WHERE([['status', '=' , 'Active'], ['name', 'like', '%'.$query.'%']])->orderBy('created_at', 'DESC')->paginate(9);
        $haveCategories = DB::table('categories')->WHERE('parent_id', '!=', '[]')->orderBy('created_at', 'DESC')->get();
		return view('frontend.index', compact('title', 'haveCourses', 'haveCategories'));
	}

	public function single_course($id)
	{
        $singleCourse = DB::table('all_courses')->WHERE('id', $id)->first();
	    $title = $singleCourse->name;
		return view('frontend.single', compact('title', 'singleCourse'));
	}

	public function buyNow($course_id, $user_id)
	{
        $singleCourse = DB::table('all_courses')->WHERE('id', $course_id)->first();
        if ($singleCourse->purchased_by == '[]') {
        	$user = '["'.$user_id.'"]';
        } else {
        	$user = trim($singleCourse->purchased_by, ']');
        	$user .= ',"'.$user_id.'"]';
        }
    	$UpdatePur = ['purchased_by' => $user];
        $done = DB::table('all_courses')->where('id', $course_id)->update($UpdatePur);
        
        DB::table('payments')->insert([
			'user_id' => $user_id,
			'course_id' => $course_id,
			'amount' => $singleCourse->price,
			'instructor' => $singleCourse->user_id
		]);
        return redirect('/single_course/'.$course_id);
	}

	public function profile()
	{
		$title = 'Profile Ethical Hacking';
		if (Auth::check()) {
			return view('frontend.profile', compact('title'));
		} else {
			return redirect('/');
			
		}
	}

	public function course_videos($course_id)
	{
		$title = 'Course Videos Ethical Hacking';
		if (Auth::check()) {
	        $singleCourse = DB::table('all_courses')->WHERE('id', $course_id)->first();

	        $purchased = explode(',', trim($singleCourse->purchased_by, "[]"));
	        if ($purchased != '') {
	           if (in_array('"'.Auth::user()->id.'"', $purchased))  {
					return view('frontend.course_videos', compact('title', 'singleCourse'));
				}
				return redirect('/single_course/'.$course_id);
			}
		} else {
			return redirect('/');
		}
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

	public function make_fav($course_id, $user_id)
	{
        $singleCourse = DB::table('all_courses')->WHERE('id', $course_id)->first();

        $arrayfavourite = explode(',', trim($singleCourse->favourite, "[]"));
        if (in_array('"'.$user_id.'"', $arrayfavourite)) {
        	$array_without_Fav = array_diff($arrayfavourite, array('"'.$user_id.'"'));
        	$newFav = '['.implode(",",$array_without_Fav).']';
        	$UpdateFav = ['favourite' => $newFav];
        } else {
        	if ($singleCourse->favourite == '[]') {
        		$IDforUpdate = '["'.$user_id.'"]';
	        	$UpdateFav = ['favourite' => $IDforUpdate];
        		
        	} else {
        	array_push($arrayfavourite, '"'.$user_id.'"');
        	$newFav = '['.implode(",",$arrayfavourite).']';
        	$UpdateFav = ['favourite' => $newFav];
        	}
        }
        $done = DB::table('all_courses')->where('id', $course_id)->update($UpdateFav);
		return redirect()->back();
	}

	public function studentverify($hash)
	{
        $studentGet = DB::table('users')->WHERE('hash_key', $hash)->first();
        if ($studentGet) {
	        $Updatehash = ['status' => 'active', 'hash_key' => Null];
			$done = DB::table('users')->where('hash_key', $hash)->update($Updatehash);
			return redirect('/frontend/login')->with('message', 'Thank You for Register Please login with your Email & Password');
        } else {
			return redirect('/frontend/login')->with('message', 'Token Expire !');
        }
	}

	public function student_register()
	{
		$title = 'Register Ethical Hacking';
		if (Auth::check()) {
			return redirect('/');
		}else {
			return view('frontend.register', compact('title'));
			
		}
	}


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

	public function logout() {
		Auth::logout();
		session()->flush();
		return redirect()->back();
	}


	public function submit_comment(Request $request){	
		$UserImage = $request->user_image;

		$current_time = Carbon::now()->toDateTimeString();
		DB::table('comments')->insert([
			'course_id' => $request->course_name,
			'user_id' => $request->user_id,
			'user_comments' => $request->current_user_comment,
			'created_at' => $current_time,
			'instructor' => $request->instructorID
		]);

		$current_comment = "<div class='post-author' style='margin-top:2%;'>
                     <div class='alignleft no-shrink rounded-circle'>                        
                        <img src=".$UserImage." class='rounded-circle' alt='image description'>
                     </div>
                     <div class='description-wrap'>
                        <h2 class='author-heading'><b>". Auth::user()->name."</b>".\Carbon\Carbon::parse($request->currentDate)->diffForHumans()."</h2>
                        <h3 class='author-heading-subtitle'>". $request->current_user_comment."</h3>
                     </div>
                  </div> ";

                  return $current_comment;
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

	public function certificate($course_id){
	    $title = 'Certificate';
		return view('frontend.certificate', ['courseID' => $course_id], compact('title')); 

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
	
	// Payment

	public function createRequest(request $request){

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, 'https://www.instamojo.com/api/1.1/payment-requests/');
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
		curl_setopt($ch, CURLOPT_HTTPHEADER,
		            array("X-Api-Key:f020818fc4949ccf9b8e816cd37e281e",
		                  "X-Auth-Token:4839231580e63cd542b29ae45d3c682e"));
		$payload = Array(
		    'purpose' => $request->purpose,
		    'amount' => $request->amount,
		    'phone' => null,
		    'buyer_name' => $request->name,
		    'redirect_url' => 'https://frankeey.com/frontend/buyNow/'.$request->course_id.'/'.$request->user_id,
		    'send_email' => false,
		    'webhook' => 'http://instamojo.dev/webhook/',
		    'send_sms' => false,
		    'email' => $request->email,
		    'allow_repeated_payments' => false
		);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
		$response = curl_exec($ch);
		curl_close($ch); 

		 $data = json_decode($response, true);

		return redirect($data['payment_request']['longurl']);

	}

}
