<?php

/* ================== Homepage ================== */
// homepage
Route::get('/', 'Frontend\IndexController@index');
// login Doctor
Route::get('/userlogin', 'Frontend\IndexController@login');
// Register Patient
Route::get('/patient_register', 'Frontend\IndexController@patient_register');
// Login Check
Route::post('/login_check', 'Frontend\IndexController@login_check');
//forgot Password
Route::get('/forgot_password', 'Frontend\IndexController@forgot_password');
Route::post('/forgot_send_email', 'Frontend\IndexController@forgot_send_email');
Route::get('/enter_new_password/{GUID}', 'Frontend\IndexController@enter_new_password');
Route::post('/forgot_reset_password', 'Frontend\IndexController@forgot_reset_password');
//register doctor
Route::get('/register_doctor_init', 'Frontend\IndexController@register_doctor_init');
Route::post('/register_doctor_mid', 'Frontend\IndexController@register_doctor_mid');
Route::post('/register_doctor', 'Frontend\IndexController@register_doctor');
Route::post('/register_check', 'Frontend\IndexController@register_check');
//register confirmation
Route::get('/confirm_email/{hash_key}', 'Frontend\IndexController@confirm_email');
//register email change (wrong email enter)
Route::get('/change_register_email/{id}', 'Frontend\IndexController@change_register_email');
Route::post('/update_email', 'Frontend\IndexController@update_email');
//profile update page
Route::get('/my_data', 'Frontend\IndexController@my_data');
Route::post('/update_my_data', 'Frontend\IndexController@update_my_data');
// doctor profile update page
Route::get('/doctor_full_profile/{uniqid}', 'Frontend\IndexController@doctor_profile_full');
//update Exract
Route::post('/updateExract', 'Frontend\IndexController@updateExract');
//update Experience
Route::post('/updateExperience', 'Frontend\IndexController@updateExperience');
//update Bio
Route::post('/updateBio', 'Frontend\IndexController@updateBio');
//update About
Route::post('/updateAbout', 'Frontend\IndexController@updateAbout');
//update Web Links
Route::post('/updateWebLinks', 'Frontend\IndexController@updateWebLinks');
//update Training
Route::post('/updateTraining', 'Frontend\IndexController@updateTraining');
//upload profile Picture
Route::post('/upload_profile_image', 'Frontend\IndexController@upload_profile_image');
//remove profile Picture
Route::post('/removeProfilePic', 'Frontend\IndexController@removeProfilePic');
//Add Photos
Route::post('upload_photos','Frontend\IndexController@fileStore');
//Remove Photos
Route::post('remove_photos','Frontend\IndexController@fileDestroy');
//Consulting Time View
Route::get('consulting_time','Frontend\IndexController@consulting_time');
// Add Consulting Time
Route::post('consulting_add','Frontend\IndexController@consulting_add');
// all Doctors
Route::get('all_professional','Frontend\IndexController@all_professional');
// reservation Page for Patient
Route::get('reservations','Frontend\IndexController@reservations');
// Favourites Page for Patient
Route::get('favourites','Frontend\IndexController@favourites');
//Make Favourite
Route::post('make_fav','Frontend\IndexController@make_fav');
// Doctor Full View of profile
Route::get('doctor_profile_view/{id}/{uniqid}','Frontend\IndexController@doctor_profile_view');
// Review Given Page
Route::get('review_doctor/{id}/{uniqid}','Frontend\IndexController@review_doctor');
//insert Review in DB
Route::post('review_add','Frontend\IndexController@review_add');
// thank you page after review
Route::get('thankyou_review/{id}','Frontend\IndexController@thankyou_review');
// Remove Specialty with ajax
Route::post('remove_specialty','Frontend\IndexController@remove_specialty');
// Add Specialty with ajax
Route::post('addSpecialty','Frontend\IndexController@addSpecialty');
// Add Services
Route::post('addService','Frontend\IndexController@addService');
// View Appointment Page
Route::get('book_appointment','Frontend\IndexController@book_appointment');



















//Facebook login and register Patient
Route::get('auth/facebook', 'Frontend\FacebookController@redirectToFacebook')->name('facebook.login');
Route::get('auth/facebook/callback', 'Frontend\FacebookController@handleFacebookCallback');




Route::get('/admin', 'HomeController@index');

Route::auth();

/* ================== Access Uploaded Files ================== */
Route::get('files/{hash}/{name}', 'LA\UploadsController@get_file');

/*
|--------------------------------------------------------------------------
| Admin Application Routes
|--------------------------------------------------------------------------
*/

$as = "";
if(\Dwij\Laraadmin\Helpers\LAHelper::laravel_ver() == 5.3) {
	$as = config('laraadmin.adminRoute').'.';
	
	// Routes for Laravel 5.3
	Route::get('/logout', 'Auth\LoginController@logout');
}

Route::group(['as' => $as, 'middleware' => ['auth', 'permission:ADMIN_PANEL']], function () {
	
	/* ================== Dashboard ================== */
	
	Route::get(config('laraadmin.adminRoute'), 'LA\DashboardController@index');
	Route::get(config('laraadmin.adminRoute'). '/dashboard', 'LA\DashboardController@index');
	
	/* ================== Users ================== */
	Route::resource(config('laraadmin.adminRoute') . '/users', 'LA\UsersController');
	Route::get(config('laraadmin.adminRoute') . '/user_dt_ajax', 'LA\UsersController@dtajax');
	
	/* ================== Uploads ================== */
	Route::resource(config('laraadmin.adminRoute') . '/uploads', 'LA\UploadsController');
	Route::post(config('laraadmin.adminRoute') . '/upload_files', 'LA\UploadsController@upload_files');
	Route::get(config('laraadmin.adminRoute') . '/uploaded_files', 'LA\UploadsController@uploaded_files');
	Route::post(config('laraadmin.adminRoute') . '/uploads_update_caption', 'LA\UploadsController@update_caption');
	Route::post(config('laraadmin.adminRoute') . '/uploads_update_filename', 'LA\UploadsController@update_filename');
	Route::post(config('laraadmin.adminRoute') . '/uploads_update_public', 'LA\UploadsController@update_public');
	Route::post(config('laraadmin.adminRoute') . '/uploads_delete_file', 'LA\UploadsController@delete_file');
	
	/* ================== Roles ================== */
	Route::resource(config('laraadmin.adminRoute') . '/roles', 'LA\RolesController');
	Route::get(config('laraadmin.adminRoute') . '/role_dt_ajax', 'LA\RolesController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/save_module_role_permissions/{id}', 'LA\RolesController@save_module_role_permissions');
	
	/* ================== Permissions ================== */
	Route::resource(config('laraadmin.adminRoute') . '/permissions', 'LA\PermissionsController');
	Route::get(config('laraadmin.adminRoute') . '/permission_dt_ajax', 'LA\PermissionsController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/save_permissions/{id}', 'LA\PermissionsController@save_permissions');
	
	/* ================== Departments ================== */
	Route::resource(config('laraadmin.adminRoute') . '/departments', 'LA\DepartmentsController');
	Route::get(config('laraadmin.adminRoute') . '/department_dt_ajax', 'LA\DepartmentsController@dtajax');
	
	/* ================== Employees ================== */
	Route::resource(config('laraadmin.adminRoute') . '/employees', 'LA\EmployeesController');
	Route::get(config('laraadmin.adminRoute') . '/employee_dt_ajax', 'LA\EmployeesController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/change_password/{id}', 'LA\EmployeesController@change_password');
	
	/* ================== Organizations ================== */
	Route::resource(config('laraadmin.adminRoute') . '/organizations', 'LA\OrganizationsController');
	Route::get(config('laraadmin.adminRoute') . '/organization_dt_ajax', 'LA\OrganizationsController@dtajax');

	/* ================== Backups ================== */
	Route::resource(config('laraadmin.adminRoute') . '/backups', 'LA\BackupsController');
	Route::get(config('laraadmin.adminRoute') . '/backup_dt_ajax', 'LA\BackupsController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/create_backup_ajax', 'LA\BackupsController@create_backup_ajax');
	Route::get(config('laraadmin.adminRoute') . '/downloadBackup/{id}', 'LA\BackupsController@downloadBackup');

	/* ================== Specialities ================== */
	Route::resource(config('laraadmin.adminRoute') . '/specialities', 'LA\SpecialitiesController');
	Route::get(config('laraadmin.adminRoute') . '/speciality_dt_ajax', 'LA\SpecialitiesController@dtajax');
});
