<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/assignee', [App\Http\Controllers\AssigneeController::class, 'index'])->name('assignee');
Route::post('/assignee add', [App\Http\Controllers\AssigneeController::class, 'store'])->name('assignee add');
Route::post('/assignee_status', [App\Http\Controllers\AssigneeController::class, 'status'])->name('assignee_status');
Route::post('/assignee_delete', [App\Http\Controllers\AssigneeController::class, 'destroy'])->name('assignee_delete');
Route::get('/get_assignee/{id}', [App\Http\Controllers\AssigneeController::class, 'edit'])->name('get_assignee');
Route::post('/assignee_update', [App\Http\Controllers\AssigneeController::class, 'update'])->name('assignee_update');
Route::get('/sig', [App\Http\Controllers\AssigneeController::class, 'sig'])->name('sig');
Route::post('/upsig', [App\Http\Controllers\AssigneeController::class, 'upsig'])->name('upsig');

// my profile
Route::get('/My Profile', [App\Http\Controllers\MyprofileController::class, 'index'])->name('My Profile');
Route::post('/update_pro', [App\Http\Controllers\MyprofileController::class, 'updateProfile'])->name('update_pro');
Route::post('/update_info', [App\Http\Controllers\MyprofileController::class, 'update'])->name('update_info');
// Student
Route::get('/student', [App\Http\Controllers\StudentController::class, 'index'])->name('student');
Route::post('/student_add', [App\Http\Controllers\StudentController::class, 'store'])->name('student_add');
Route::post('/student_update', [App\Http\Controllers\StudentController::class, 'update'])->name('student_update');
Route::get('/get_student/{id}', [App\Http\Controllers\StudentController::class, 'edit'])->name('get_student');
Route::post('/student_status', [App\Http\Controllers\StudentController::class, 'status'])->name('student_status');
Route::post('/student_delete', [App\Http\Controllers\StudentController::class, 'destroy'])->name('student_delete');

Route::get('/profile', 'App\Http\Controllers\ProfileController@index')->name('profile');

Route::get('/department', 'App\Http\Controllers\departmentController@index')->name('department');
Route::post('/dept_add', 'App\Http\Controllers\departmentController@store')->name('dept_add');
Route::post('/dept_update', 'App\Http\Controllers\departmentController@update')->name('dept_update');
Route::post('/dept_delete', 'App\Http\Controllers\departmentController@destroy')->name('dept_delete');

Route::get('/clearance', 'App\Http\Controllers\ClearanceController@index')->name('clearance');

Route::get('/course', 'App\Http\Controllers\CourseController@index')->name('course');
Route::post('/course_add', 'App\Http\Controllers\CourseController@store')->name('course_add');
Route::post('/course_update', 'App\Http\Controllers\CourseController@update')->name('course_update');
Route::post('/course_delete', 'App\Http\Controllers\CourseController@destroy')->name('course_delete');
// position
Route::get('/Position', 'App\Http\Controllers\PositionController@index')->name('Position');
Route::post('/position_add', 'App\Http\Controllers\PositionController@store')->name('position_add');
Route::post('/position_update', 'App\Http\Controllers\PositionController@update')->name('position_update');
Route::post('/position_delete', 'App\Http\Controllers\PositionController@destroy')->name('position_delete');

// Prefix_Suffix
Route::get('/Prefix Suffix', 'App\Http\Controllers\Prefix_SuffixController@index')->name('Prefix Suffix');
Route::post('/prefix_add', 'App\Http\Controllers\Prefix_SuffixController@store_prefix')->name('prefix_add');
Route::post('/prefix_update', 'App\Http\Controllers\Prefix_SuffixController@update_prefix')->name('prefix_update');
Route::post('/prefix_delete', 'App\Http\Controllers\Prefix_SuffixController@destroy_prefix')->name('prefix_delete');
Route::post('/suffix_add', 'App\Http\Controllers\Prefix_SuffixController@store_suffix')->name('suffix_add');
Route::post('/suffix_update', 'App\Http\Controllers\Prefix_SuffixController@update_suffix')->name('suffix_update');
Route::post('/suffix_delete', 'App\Http\Controllers\Prefix_SuffixController@destroy_suffix')->name('suffix_delete');

// School Year
Route::get('/School Year', 'App\Http\Controllers\SchoolYearController@index')->name('School Year');
Route::post('/SchoolYear_add', 'App\Http\Controllers\SchoolYearController@store')->name('SchoolYear_add');
Route::post('/SchoolYear_update', 'App\Http\Controllers\SchoolYearController@update')->name('SchoolYear_update');
Route::post('/SchoolYear_delete', 'App\Http\Controllers\SchoolYearController@destroy')->name('SchoolYear_delete');
// Year Level
Route::get('/Year Level', 'App\Http\Controllers\YearLevelController@index')->name('Year Level');
Route::post('/yearlevel_add', 'App\Http\Controllers\YearLevelController@store')->name('yearlevel_add');
Route::post('/yearlevel_update', 'App\Http\Controllers\YearLevelController@update')->name('yearlevel_update');
Route::post('/yearlevel_delete', 'App\Http\Controllers\YearLevelController@destroy')->name('yearlevel_delete');
// Route::get('/SchoolYear', 'App\Http\Controllers\SchoolYearController@index')->name('SchoolYear');


// Signatory Assign
Route::get('/Signatory-Assign', 'App\Http\Controllers\SignatoryAssignController@index')->name('Signatory-Assign');
Route::post('/Signatory-Assign-add', 'App\Http\Controllers\SignatoryAssignController@store')->name('Signatory-Assign-add');
Route::post('/Signatory-Assign-update', 'App\Http\Controllers\SignatoryAssignController@update')->name('Signatory-Assign-update');
Route::post('/Signatory-Assign-delete', 'App\Http\Controllers\SignatoryAssignController@destroy')->name('Signatory-Assign-delete');

Route::post('/profile/update', 'App\Http\Controllers\ProfileController@updateProfile')->name('profile.update');

Route::post('/Login/login2', 'App\Http\Controllers\Auth\LoginController@login2')->name('Login.login2');

Route::post('/checkUser', 'App\Http\Controllers\Auth\LoginController@check_user')->name('Login.check_user');

Route::post('/imgpath', 'App\Http\Controllers\ProfileController@imgpath')->name('imgpath');

Route::get('/create_tb', 'App\Http\Controllers\AccessRightsController@index')->name('create_tb');

Route::get('/check_all/{id}', [App\Http\Controllers\ClearanceController::class, 'checkall'])->name('check_all');

Route::get('/get_sig/{id}', [App\Http\Controllers\ClearanceController::class, 'getsignatory'])->name('get_sig');

Route::get('/update_sig/{id}', [App\Http\Controllers\ClearanceController::class, 'edit'])->name('update_sig');


Route::get('/Manage-Access', [App\Http\Controllers\AccessRightsController::class, 'index'])->name('Manage-Access');
Route::post('/add_access', [App\Http\Controllers\AccessRightsController::class, 'store'])->name('add_access');

Route::post('/new_per', [App\Http\Controllers\AccessRightsController::class, 'new_permission'])->name('new_per');
Route::post('/delete_per', [App\Http\Controllers\AccessRightsController::class, 'delete'])->name('delete_per');

Route::get('/get_all/{id}', [App\Http\Controllers\AccessRightsController::class, 'getAlldata'])->name('get_all');
Route::get('/check_sig/{id}', [App\Http\Controllers\AccessRightsController::class, 'check_sig'])->name('check_sig');

Route::get('/Student-Dash', [App\Http\Controllers\StudentDashController::class, 'index'])->name('Student-Dash');



Route::get('/messenger', [App\Http\Controllers\MessageController::class, 'index'])->name('messenger');
Route::post('/send_message', [App\Http\Controllers\MessageController::class, 'store'])->name('send_message');
Route::get('/display/{id}', [App\Http\Controllers\MessageController::class, 'show'])->name('display');


Route::get('/sample', [App\Http\Controllers\Clearance::class, 'index'])->name('sample');

Route::post('/alert', [App\Http\Controllers\Clearance::class, 'store'])->name('alert');

Route::get('/edit_chat_status/{id}', [App\Http\Controllers\StudentController::class, 'edit_chat_status'])->name('edit_chat_status');