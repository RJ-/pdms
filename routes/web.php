<?php
use Illuminate\Support\Facades\Input as input;
use App\CollegeCampus;
use App\AdminUsers;
use App\Faculty;
use App\User;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

// Route::get('upload', 'uploadController@index');
// Route::post('store', 'uploadController@store');
// Route::get('show', 'uploadController@show');


Auth::routes();

Route::post('/signin', [
  'uses' => 'UserController@postSignIn',
  'as' => 'signin'
]);

Route::get('/logout', [
  'uses' => 'UserController@getLogout',
  'as' => 'logout'
]);

Route::get('/', [
  'uses' => 'UserController@welcome',
  'as' => 'welcome'
]);

Route::get('/research', [
  'uses' => 'UserController@research',
  'as' => 'research'
]);


Route::get('/home', [
  'uses' => 'UserController@home',
  'as' => 'home'
]);

Route::get('/categories/{id}', [
  'uses' => 'UserController@categories',
  'as' => 'categories'
]);

Route::get('/facultyneeds/{id}', [
  'uses' => 'UserController@facultyneeds',
  'as' => 'facultyneeds'
]);

Route::get('/activity/{id}', [
  'uses' => 'FacultyController@activity',
  'as' => 'activity'
]);

//admin routes

Route::get('/admin/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('/admin/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
Route::get('/admin/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

Route::get('/president/login', 'Auth\PresLoginController@showLoginForm')->name('president.login');
Route::post('/president/login', 'Auth\PresLoginController@login')->name('president.login.submit');
Route::get('/president/logout', 'Auth\PresLoginController@logout')->name('president.logout');

Route::get('/vpaa/login', 'Auth\VpaaLoginController@showLoginForm')->name('vpaa.login');
Route::post('/vpaa/login', 'Auth\VpaaLoginController@login')->name('vpaa.login.submit');
Route::get('/vpaa/logout', 'Auth\VpaaLoginController@logout')->name('vpaa.logout');

Route::get('/dean/login', 'Auth\DeanLoginController@showLoginForm')->name('dean.login');
Route::post('/dean/login', 'Auth\DeanLoginController@login')->name('dean.login.submit');
Route::get('/dean/logout', 'Auth\DeanLoginController@logout')->name('dean.logout');

Route::get('/manage-activities', [
  'uses' => 'DeanController@manageactivities',
  'as' => 'manageactivities'
]);


Route::get('/user/logout', 'Auth\LoginController@userLogout')->name('user.logout');

Route::get('/admin', [
  'uses' => 'AdminController@admin',
  'as' => 'admin'
]);

// Route::get('/post-activity', [
//   'uses' => 'AdminController@postactivity',
//   'as' => 'postactivity'
// ]);

Route::get('/viewSubmittedPD', [
  'uses' => 'PDactivityController@viewSubmittedPD',
  'as' => 'viewSubmittedPD'
]);

Route::get('/approve-activity/{id}', [
  'uses' => 'PDactivityController@approvePdActivity',
  'as' => 'approvePdActivity'
]);

Route::get('/register-faculty', [
  'uses' => 'AdminController@registerfaculty',
  'as' => 'registerfaculty'
]);

Route::post('/save-faculty', [
  'uses' => 'AdminController@saveFaculty',
  'as' => 'saveFaculty'
]);

Route::get('/viewfaculty', [
  'uses' => 'AdminController@viewfaculty',
  'as' => 'viewfaculty'
]);

Route::get('/showfaculty/{id}', [
  'uses' => 'AdminController@showfaculty',
  'as' => 'showfaculty'
]);

Route::get('/updateStatus/{id}', [
  'uses' => 'AdminController@updateStatus',
  'as' => 'updateStatus'
]);

Route::resource('administrators', 'AdminUsersController');

Route::get('registeradmin', [
  'uses' => 'AdminUsersController@registeradmin',
  'as' => 'registeradmin'
]);

Route::put('/hrdApproveActivity/{id}', [
  'uses' => 'AdminController@hrdApproveActivity',
  'as' => 'hrdApproveActivity'
]);

Route::put('/hrdNotifyFacultyRequirements/{id}', [
  'uses' => 'AdminController@hrdNotifyFacultyRequirements',
  'as' => 'hrdNotifyFacultyRequirements'
]);

Route::put('/adminNotifyFaculty/{id}', [
  'uses' => 'VpaaController@adminNotifyFaculty',
  'as' => 'adminNotifyFaculty'
]);

Route::put('/presNotifyFaculty/{id}', [
  'uses' => 'VpaaController@adminNotifyFaculty',
  'as' => 'presNotifyFaculty'
]);
//end admin routes

// faculty routes
Route::resource('faculty', 'FacultyController');

Route::get('professional-development-record/{id}', [
  'uses' => 'FacultyController@pdrecord',
  'as' => 'pdrecord'
]);

Route::put('professional-development-update/{id}', [
  'uses' => 'FacultyController@updatepdrecord',
  'as' => 'updatepdrecord'
]);

Route::put('professional-development-activity-update/{id}', [
  'uses' => 'FacultyController@updatepdactivity',
  'as' => 'updatepdactivity'
]);

Route::resource('notification', 'NotificationController');

Route::resource('educbackground', 'EducBackgroundController');

// admin routes
Route::resource('pdactivity', 'PDactivityController');

Route::resource('campus-college', 'CollegeCampusController');

Route::post('submitApplication', [
  'uses' => 'UserController@application',
  'as' => 'application'
]);

Route::post('joinActivity', [
  'uses' => 'UserController@joinActivity',
  'as' => 'joinActivity'
]);

Route::put('acceptActivity/{id}', [
  'uses' => 'UserController@acceptActivity',
  'as' => 'acceptActivity'
]);

Route::put('declineActivity/{id}', [
  'uses' => 'UserController@declineActivity',
  'as' => 'declineActivity'
]);

Route::resource('field', 'FieldController');

Route::post('addOtherFields', [
  'uses' => 'FieldController@addOtherFields',
  'as' => 'addOtherFields'
]);

Route::resource('category', 'CategoryController');

Route::resource('needs', 'TrainingNeedsController');

//Route::resource('facultyneeds', 'FacultyNeedsController');

Route::resource('dean', 'DeanController');

Route::resource('vpaa', 'VpaaController');

Route::resource('president', 'PresController');

//Edit profile
Route::get('president-profile/{id}', [
  'uses' => 'PresController@PresidentProfile',
  'as' => 'PresidentProfile'
]);

Route::put('PresidentProfileUpdate/{id}', [
  'uses' => 'PresController@PresidentProfileUpdate',
  'as' => 'PresidentProfileUpdate'
]);

Route::get('vpaa-profile/{id}', [
  'uses' => 'VpaaController@VpaaProfile',
  'as' => 'VpaaProfile'
]);

Route::put('VpaaProfileUpdate/{id}', [
  'uses' => 'VpaaController@VpaaProfileUpdate',
  'as' => 'VpaaProfileUpdate'
]);

Route::get('dean-profile/{id}', [
  'uses' => 'DeanController@DeanProfile',
  'as' => 'DeanProfile'
]);

Route::put('DeanProfileUpdate/{id}', [
  'uses' => 'DeanController@DeanProfileUpdate',
  'as' => 'DeanProfileUpdate'
]);

Route::get('hrd-profile/{id}', [
  'uses' => 'AdminController@HrdProfile',
  'as' => 'HrdProfile'
]);

Route::put('HrdProfileUpdate/{id}', [
  'uses' => 'AdminController@HrdProfileUpdate',
  'as' => 'HrdProfileUpdate'
]);

//End Edit profile

Route::put('recommend/{id}', [
  'uses' => 'VpaaController@recommend',
  'as' => 'recommend'
]);

Route::put('removeVP/{id}', [
  'uses' => 'VpaaController@removeVP',
  'as' => 'removeVP'
]);

Route::put('remove/{id}', [
  'uses' => 'DeanController@remove',
  'as' => 'remove'
]);

Route::put('/updateStatus/{id}', [
  'uses' => 'PresController@updateStatus',
  'as' => 'updateStatus'
]);

Route::put('/approveActivity/{id}', [
  'uses' => 'PresController@approveActivity',
  'as' => 'approveActivity'
]);

Route::put('/removePres/{id}', [
  'uses' => 'PresController@remove',
  'as' => 'removePres'
]);

//Notifications
Route::get('/markAsRead', function(){
  Auth::user()->unreadNotifications->markAsRead();
});

Route::get('/markAsReadVpaa', function(){
  Auth::user()->unreadNotifications->markAsRead();
})->middleware('auth:vpaa');

Route::get('/markAsReadPresident', function(){
  Auth::user()->unreadNotifications->markAsRead();
})->middleware('auth:president');

Route::get('/markAsReadHrd', function(){
  Auth::user()->unreadNotifications->markAsRead();
})->middleware('auth:admin');


Route::get('VpaaNotification', [
  'uses' => 'VpaaController@VpaaNotification',
  'as' => 'VpaaNotification'
]);

Route::get('PresNotification', [
  'uses' => 'PresController@PresNotification',
  'as' => 'PresNotification'
]);

Route::get('DeanNotification', [
  'uses' => 'DeanController@DeanNotification',
  'as' => 'DeanNotification'
]);

Route::get('HrdNotification', [
  'uses' => 'AdminController@HrdNotification',
  'as' => 'HrdNotification'
]);

Route::post('/vpaachangepassword', function(){
  $user = AdminUsers::find(Auth::user()->id);
  if(Hash::check(Input::get('oldpassword'), $user['password']) && Input::get('password') == Input::get('confirmpassword')){
      $user->password = bcrypt(Input::get('password'));
      $user->save();
      return back()->with('success', 'Password successfully updated');
  }else{
      return back()->with('error', 'Opps..something went wrong while updating your password. Please try again.');
  }
})->middleware(['auth:vpaa']);

Route::post('/preschangepassword', function(){
  $user = AdminUsers::find(Auth::user()->id);
  if(Hash::check(Input::get('oldpassword'), $user['password']) && Input::get('password') == Input::get('confirmpassword')){
      $user->password = bcrypt(Input::get('password'));
      $user->save();
      return back()->with('success', 'Password successfully updated');
  }else{
      return back()->with('error', 'Opps..something went wrong while updating your password. Please try again.');
  }
})->middleware(['auth:president']);

Route::post('/deanchangepassword', function(){
  $user = Faculty::find(Auth::user()->id);
  if(Hash::check(Input::get('oldpassword'), $user['password']) && Input::get('password') == Input::get('confirmpassword')){
      $user->password = bcrypt(Input::get('password'));
      $user->save();
      return back()->with('success', 'Password successfully updated');
  }else{
      return back()->with('error', 'Opps..something went wrong while updating your password. Please try again.');
  }
})->middleware(['auth:dean']);

Route::post('/facultychangepassword', function(){
  $user = Faculty::find(Auth::user()->id);
  if(Hash::check(Input::get('oldpassword'), $user['password']) && Input::get('password') == Input::get('confirmpassword')){
      $user->password = bcrypt(Input::get('password'));
      $user->save();
      return back()->with('success', 'Password successfully updated');
  }else{
      return back()->with('error', 'Opps..something went wrong. Please try again.');
  }
})->middleware(['auth:web']);

Route::post('/hrdchangepassword', function(){
  $user = AdminUsers::find(Auth::user()->id);
  if(Hash::check(Input::get('oldpassword'), $user['password']) && Input::get('password') == Input::get('confirmpassword')){
      $user->password = bcrypt(Input::get('password'));
      $user->save();
      return back()->with('success', 'Password successfully updated');
  }else{
      return back()->with('error', 'Opps..something went wrong. Please try again.');
  }
})->middleware(['auth:admin']);

//Dashboard

//president
Route::get('/pres-faculty-roster', [
  'uses' => 'PresController@facultyroster',
  'as' => 'facultyrosterPres'
]);
Route::get('/pres-faculty-scholar', [
  'uses' => 'PresController@facultyscholar',
  'as' => 'facultyscholarPres'
]);
Route::get('/pres-faculty-post-studies', [
  'uses' => 'PresController@facultygradstudies',
  'as' => 'facultygradstudiesPres'
]);
Route::get('/pres-faculty-with-pd', [
  'uses' => 'PresController@facultywithPD',
  'as' => 'facultywithPDPres'
]);
Route::get('/pres-faculty-need-pd', [
  'uses' => 'PresController@facultyneedPD',
  'as' => 'facultyneedPDPres'
]);
Route::get('/pres-pd-activities', [
  'uses' => 'PresController@pdactivities',
  'as' => 'pdactivitiesPDPres'
]);

Route::get('/faculty-development-president/{id}',[
  'uses' => 'PresController@facultydevelopment',
  'as' => 'presidentfacultydevelopment'
]);

//vpaa
Route::get('/vpaa-faculty-roster', [
  'uses' => 'VpaaController@facultyroster',
  'as' => 'facultyrosterVPAA'
]);
Route::get('/vpaa-faculty-scholar', [
  'uses' => 'VpaaController@facultyscholar',
  'as' => 'facultyscholarVPAA'
]);
Route::get('/vpaa-faculty-post-studies', [
  'uses' => 'VpaaController@facultygradstudies',
  'as' => 'facultygradstudiesVPAA'
]);
Route::get('/vpaa-faculty-with-pd', [
  'uses' => 'VpaaController@facultywithPD',
  'as' => 'facultywithPDVPAA'
]);
Route::get('/vpaa-faculty-need-pd', [
  'uses' => 'VpaaController@facultyneedPD',
  'as' => 'facultyneedPDVPAA'
]);
Route::get('/vpaa-pd-activities', [
  'uses' => 'VpaaController@pdactivities',
  'as' => 'pdactivitiesPDVPAA'
]);


//hrd
Route::get('/faculty-roster', [
  'uses' => 'AdminController@facultyroster',
  'as' => 'facultyrosterHRD'
]);
Route::get('/faculty-scholar', [
  'uses' => 'AdminController@facultyscholar',
  'as' => 'facultyscholarHRD'
]);
Route::get('/faculty-post-studies', [
  'uses' => 'AdminController@facultygradstudies',
  'as' => 'facultygradstudiesHRD'
]);
Route::get('/faculty-with-pd', [
  'uses' => 'AdminController@facultywithPD',
  'as' => 'facultywithPDHRD'
]);
Route::get('/faculty-need-pd', [
  'uses' => 'AdminController@facultyneedPD',
  'as' => 'facultyneedPDHRD'
]);
Route::get('/pd-activities', [
  'uses' => 'AdminController@pdactivities',
  'as' => 'pdactivitiesPDHRD'
]);

Route::get('/faculty-development/{id}', [
  'uses' => 'AdminController@facultydevelopment',
  'as' => 'facultydevelopment'
]);

//Dean
Route::get('/college-faculty-development/{id}',[
  'uses' => 'DeanController@facultydevelopment',
  'as' => 'collegefacultydevelopment'
]);

Route::get('/dean-faculty-roster/{id}', [
  'uses' => 'DeanController@facultyroster',
  'as' => 'facultyrosterDean'
]);
Route::get('/dean-faculty-scholar/{id}', [
  'uses' => 'DeanController@facultyscholar',
  'as' => 'facultyscholarDean'
]);
Route::get('/dean-faculty-post-studies/{id}', [
  'uses' => 'DeanController@facultygradstudies',
  'as' => 'facultygradstudiesDean'
]);
Route::get('/dean-faculty-with-pd/{id}', [
  'uses' => 'DeanController@facultywithPD',
  'as' => 'facultywithPDDean'
]);
Route::get('/dean-faculty-need-pd/{id}', [
  'uses' => 'DeanController@facultyneedPD',
  'as' => 'facultyneedPDDean'
]);
Route::get('/dean-pd-activities/{id}', [
  'uses' => 'DeanController@pdactivities',
  'as' => 'pdactivitiesPDDean'
]);


Route::any ( '/search', function () {
  $college = CollegeCampus::all();
  $faculty = Faculty::simplePaginate(10);
  $counter = 1;

    $q = Input::get ( 'q' );
    $faculty = Faculty::where ( 'surname', 'LIKE', '%' . $q . '%' )->orWhere ( 'firstname', 'LIKE', '%' . $q . '%' )->get ();
    if (count ( $faculty ) > 0)
        return view ( 'admin-dashboard.pages.searchfaculty' )->withDetails ( $faculty )->withQuery ( $q )
        ->with('faculty', $faculty)
        ->with('colleges', $college)
        ->with('counter', $counter);
    else
        return view ( 'admin-dashboard.pages.searchfaculty' )->with('error', 'No Details found. Try to search again !')
        ->with('faculty', $faculty)
        ->with('colleges', $college)
        ->with('counter', $counter);
} );

Route::get('view-profile/{id}', [
  'uses' => 'DeanController@viewProfile',
  'as' => 'viewProfile'
]);

Route::get('vpaa-view-profile/{id}', [
  'uses' => 'VpaaController@viewProfile',
  'as' => 'viewProfileVpaa'
]);

Route::get('pres-view-profile/{id}', [
  'uses' => 'PresController@viewProfile',
  'as' => 'viewProfilePres'
]);

Route::get('dean-view-activity/{id}', [
  'uses' => 'DeanController@viewActivity',
  'as' => 'viewActivityDean'
]);

Route::get('vpaa-view-activity/{id}', [
  'uses' => 'VpaaController@viewActivity',
  'as' => 'viewActivityVpaa'
]);

Route::get('pres-view-activity/{id}', [
  'uses' => 'PresController@viewActivity',
  'as' => 'viewActivityPres'
]);
