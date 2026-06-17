<?php

use App\Http\Controllers\teacher\dashboard\QuestionDashboardController;
use App\Http\Controllers\teacher\dashboard\QuizzDashboardController;
use App\Http\Controllers\teacher\dashboard\StudentDashboardController;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| student Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//==============================Translate all pages============================
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:teacher']
    ], function () {

    //==============================dashboard============================
    Route::get('/teachers/dashboard', function () {
        $ids = Teacher::findorFail(auth()->user()->id)->sections()->pluck('section_id');
        $data['count_sections']= $ids->count();
        $data['count_students']= Student::whereIn('section_id',$ids)->count();

        return view('teachers.dashboard.dashboard',$data);
    });

     Route::group([['namespace' => 'teacher\dashboard']], function () {
        //==============================students============================
     Route::get('students',[StudentDashboardController::class,'index'])->name('students.index');

     Route::get('sections',[StudentDashboardController::class,'sections'])->name('sections.index');

     Route::post('attendances',[StudentDashboardController::class,'attendance'])->name('attendances');
     Route::post('edit_attendance',[StudentDashboardController::class,'editAttendance'])->name('attendance.edit');
     Route::get('attendance_report',[StudentDashboardController::class,'attendanceReport'])->name('attendance.report');
     Route::post('attendance_report',[StudentDashboardController::class,'attendanceSearch'])->name('attendance.search');

     Route::resource('quizzes', QuizzDashboardController::class)->names('quizzes');
     // get Classroom
		Route::get('/get_classroom/{id}', [QuizzDashboardController::class,'getClassroom']);
	// get section
		Route::get('/get_section/{id}', [QuizzDashboardController::class,'getSection']);
     Route::resource('questions', QuestionDashboardController::class)->names('questions');
    //  Route::resource('online_zoom_classes', 'OnlineZoomClassesController');
    //  Route::get('/indirect', 'OnlineZoomClassesController@indirectCreate')->name('indirect.teacher.create');
    //  Route::post('/indirect', 'OnlineZoomClassesController@storeIndirect')->name('indirect.teacher.store');
    //  Route::get('profile', 'ProfileController@index')->name('profile.show');
    //  Route::post('profile/{id}', 'ProfileController@update')->name('profile.update');
    //  Route::get('student_quizze/{id}','QuizzController@student_quizze')->name('student.quizze');
    //  Route::post('repeat_quizze', 'QuizzController@repeat_quizze')->name('repeat.quizze');


    });

});