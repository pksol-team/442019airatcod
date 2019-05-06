<?php


namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
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
use Socialite;
use Exception;



class FacebookController extends Controller
{

	/**
     * Create a new controller instance.
     *
     * @return void
     */

	public function __construct()
    {

    }
	
	public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleFacebookCallback()
    {
    	$time = Carbon::now();
        $user = Socialite::driver('facebook')->user();
		$checkUser = DB::table('users')->WHERE('email', $user->email)->first();
		if ($checkUser == NULL) {
	    	$employee = [
	    	    'first_name' => $user->name,
	    	    'email' => $user->email,
	    	    'type' => 'patient',
	    	    'created_at' => $time,
	    	  ];
	    	$insertedEmployees = DB::table('employees')->insert($employee);
	    	$getInsertedId = DB::getPdo()->lastInsertId();
	          
	    	if ($insertedEmployees) {
	    		$user = [
	                'name' => $user->name,
	                'email' => $user->email,
		            'password' => bcrypt(''),
	                'context_id' => $getInsertedId,
	                'type' => "patient",
				    'confirm_email' => uniqid(time()).uniqid(),
				    'status' => 'deactive',
	    		    'created_at' => $time,
	            ];
	    		$insertedUsers = DB::table('users')->insert($user);
	    		if ($insertedUsers) {
	    			$role = [
	    				'role_id' => 3,
	    				'user_id' => $getInsertedId,
	    			];
	    			DB::table('role_user')->insert($role);
	    			Auth::loginUsingId($getInsertedId);
	    			return redirect('/');
	    		}
	    	}

		} else {
			// if ($checkUser->type == 'doctor') {
		 //    	return redirect('/userlogin')->with('error', 'Entrar con facebook es solo para pacientes');
			// } else {
				Auth::loginUsingId($checkUser->id);
				return redirect('/');
			// }
		}
    		
    	return redirect('/userlogin')->with('error', '¡Uy! Algo salió mal..');
    }
	
}
