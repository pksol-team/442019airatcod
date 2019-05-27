<?php

/* ================== Homepage ================== */
// homepage
Route::get('/', 'Frontend\IndexController@index');
// view all city/specialty/forecast
Route::get('/viewFull/{tag}', 'Frontend\IndexController@viewFullbyTag');
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
// confirm email with email link
Route::get('/verify_email/{id}/{hash_key}', 'Frontend\IndexController@verify_email');
// thank you page after email verify
Route::get('/thankyou_email','Frontend\IndexController@thankyou_email');
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
// all Doctors with filters
Route::get('all_professional','Frontend\IndexController@all_professional');
//contact Us Page
Route::get('contact_us','Frontend\IndexController@contact_us');
//contact us email
Route::post('contact_us_email','Frontend\IndexController@contact_us_email');
// reservation Page for Patient
Route::get('reservations','Frontend\IndexController@reservations');
// Quote Doctor Form Page
Route::get('quote_doctor','Frontend\IndexController@quote_doctor');
// Send Quote Emails with Form
Route::post('send_quote_email','Frontend\IndexController@send_quote_email');
// Favourites Page for Patient
Route::get('favourites','Frontend\IndexController@favourites');
//Make Favourite
Route::post('make_fav','Frontend\IndexController@make_fav');
// Doctor Full View of profile
Route::get('doctor_profile_view/{id}/{uniqid}','Frontend\IndexController@doctor_profile_view');
// Review Given Page
Route::get('review_doctor/{id}/{uniqid}','Frontend\IndexController@review_doctor');
// Review View Page
Route::get('view_reviews_doctor/{id}/{uniqid}','Frontend\IndexController@view_reviews_doctor');
//insert Review in DB
Route::post('review_add','Frontend\IndexController@review_add');
// thank you page after review
Route::get('thankyou_review/{id}','Frontend\IndexController@thankyou_review');
// Remove Specialty with ajax
Route::post('remove_specialty','Frontend\IndexController@remove_specialty');
// Add Specialty with ajax
Route::post('addSpecialty','Frontend\IndexController@addSpecialty');
// Add Forecast with ajax
Route::post('addForecast','Frontend\IndexController@addForecast');
// Add Services
Route::post('addService','Frontend\IndexController@addService');
// View Appointment Page
Route::get('book_appointment/{userid}/{hash_key}/{date}/{timeid}','Frontend\IndexController@book_appointment');
// Booked appointment by patient
Route::post('booked_appointment','Frontend\IndexController@booked_appointment');
// Delete appointment by patient
Route::get('deleteReservations/{timeid}','Frontend\IndexController@deleteReservations');
// view appointment of doctor
Route::get('doctor_appointments/{id}/{hash_key}/','Frontend\IndexController@doctor_appointments');
// home page search request
Route::get('searchBySpecialty','Frontend\IndexController@searchBySpecialty');
// view Premium Profile
Route::get('premium_profile/{id}/{hash_key}','Frontend\IndexController@premium_profile');
// Write Article
Route::get('write_article/{id}/{hash_key}','Frontend\IndexController@write_article');
// add New Article
Route::post('/addNewArticle', 'Frontend\IndexController@addNewArticle');
// Edit Article
Route::get('edit_article/{article_id}/{id}/{hash_key}','Frontend\IndexController@edit_article');
// Update New Article
Route::post('/updateArticle', 'Frontend\IndexController@updateArticle');
// article / blog Listing
Route::get('/blog_article','Frontend\IndexController@blog_article');
// view article in detail
Route::get('/{id}/article_view','Frontend\IndexController@article_view');

// view F.A.Q
Route::get('frequently','Frontend\IndexController@frequently');
// view Tickets
Route::get('my_tickets','Frontend\IndexController@my_tickets');
// view Single Ticket
Route::get('/tickets/title/{id}','Frontend\IndexController@title_view');
// close Ticket
Route::get('/close_ticket/{ticket_id}/{status}', 'Frontend\IndexController@close_ticket');
// Tick Add Page
Route::get('/new_ticket', 'Frontend\IndexController@ticket_add_page');
// Add New Ticket
Route::post('/add_ticket_data', 'Frontend\IndexController@ticket_data_add');
// Reply to Ticket
Route::post('/add_reply', 'Frontend\IndexController@add_reply');
// Check Subscription on Daily basis
Route::get('/subscription_check', 'Frontend\IndexController@subscription_check');




/* ================== Flow Payment Routes ================== */

// subscription
Route::get('/subscribe/{package}', 'Frontend\IndexController@createCustomer');
// Register customer card
Route::post('/registeredurl', 'Frontend\IndexController@registeredUrl');
// Unsubscribe
Route::get('/unsubscribe', 'Frontend\IndexController@cancelSubscription');








































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

	/* ================== Cities ================== */
	Route::resource(config('laraadmin.adminRoute') . '/cities', 'LA\CitiesController');
	Route::get(config('laraadmin.adminRoute') . '/city_dt_ajax', 'LA\CitiesController@dtajax');

	/* ================== Forecasts ================== */
	Route::resource(config('laraadmin.adminRoute') . '/forecasts', 'LA\ForecastsController');
	Route::get(config('laraadmin.adminRoute') . '/forecast_dt_ajax', 'LA\ForecastsController@dtajax');

	/* ================== Questions ================== */
	Route::resource(config('laraadmin.adminRoute') . '/questions', 'LA\QuestionsController');
	Route::get(config('laraadmin.adminRoute') . '/question_dt_ajax', 'LA\QuestionsController@dtajax');

	/* ================== Tickets ================== */
	Route::resource(config('laraadmin.adminRoute') . '/tickets', 'LA\TicketsController');
	Route::get(config('laraadmin.adminRoute') . '/ticket_dt_ajax', 'LA\TicketsController@dtajax');

	/* ================== Tickets_replies ================== */
	Route::resource(config('laraadmin.adminRoute') . '/tickets_replies', 'LA\Tickets_repliesController');
	Route::get(config('laraadmin.adminRoute') . '/tickets_reply_dt_ajax', 'LA\Tickets_repliesController@dtajax');

	/* ================== Email_Templates ================== */
	Route::resource(config('laraadmin.adminRoute') . '/email_templates', 'LA\Email_TemplatesController');
	Route::get(config('laraadmin.adminRoute') . '/email_template_dt_ajax', 'LA\Email_TemplatesController@dtajax');


	/* ================== Articles ================== */
	Route::resource(config('laraadmin.adminRoute') . '/articles', 'LA\ArticlesController');
	Route::get(config('laraadmin.adminRoute') . '/article_dt_ajax', 'LA\ArticlesController@dtajax');
});
