<?php
/**
 * Controller genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Http\Controllers\LA;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

/**
 * Class DashboardController
 * @package App\Http\Controllers
 */
class DashboardController extends Controller
{
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
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        $allDoctorsCount = DB::table('employees')->where('type', 'doctor')->count();
        $unVerifiedDoctors = DB::table('users')->where('confirm_email', '!=', NULL)->count();
        $allPatientCount = DB::table('employees')->where('type', 'patient')->count();
        $todayDate = Carbon::now()->toDateString();
        $upcomingAppointments = DB::table('appointments')->where('appointment_date', '>=', $todayDate)->count();
        return view('la.dashboard', compact('allDoctorsCount', 'allPatientCount', 'upcomingAppointments', 'unVerifiedDoctors'));
    }
}