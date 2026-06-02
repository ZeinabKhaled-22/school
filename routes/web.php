<?php

namespace App\Http\Controllers;

use App\Http\Controllers\GradeController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// routes/web.php


Auth::routes();


Route::group(['middleware' => 'guest'], function () {
	Route::get('/', function () {
		return view('auth.login');
	});

});



// localize (language)
Route::group(
	[
		'prefix' => LaravelLocalization::setLocale(),
		'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']
	],
	function () {
		// auth
		Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');


		// grade
		Route::resource('/grade', GradeController::class);


		// classroom
		Route::resource('/classroom', ClassroomController::class);


		// delete all classroom from checkbox
		Route::post('delete_all', [ClassroomController::class, 'deleteAll'])->name('delete_all');
		// filter search
		Route::post('filter_search', [ClassroomController::class, 'filterSearch'])->name('filter_search');


		// section
		Route::resource('section', SectionController::class);
		// get class in section
		Route::get('classes/{id}', [SectionController::class, 'getClasses']);


		// parent
		Route::view('parent', 'components.show-form');


		// teacher
		Route::resource('teacher', TeacherController::class);


		// student
		Route::resource('student', StudentController::class);
		// get Classroom
		Route::get('/get_classroom/{id}', [StudentController::class,'getClassroom']);
		// get section
		Route::get('/get_section/{id}', [StudentController::class,'getSection']);
		// upload images
		Route::post('upload_attachment', [StudentController::class,'uploadAttachment'])->name('upload_attachment');
        // download Image
		Route::get('download_attachment/{studentname}/{filename}', [StudentController::class,'downloadAttachment']);
		// delete image
		Route::post('delete_attachment',[StudentController::class,'deleteAttachment'])->name('delete_attachment');


		// promotion
		Route::resource('promotion', PromotionController::class);


		// graduate student
		Route::resource('graduate', GraduateController::class);


		// fee
		Route::resource('fee',FeeController::class);


		// fee invoice
		Route::resource('fee_invoice',FeeInvoiceController::class);


		// receipt student
		Route::resource('receipt_student',ReceiptStudentController::class);


		// processing fee
		Route::resource('processing_fee',ProcessingFeeController::class);


		// payment
		Route::resource('payment',PaymentController::class);


		// attendance
		Route::resource('attendance',AttendanceController::class);


		// subject
		Route::resource('subject',SubjectController::class);

		// exam
		Route::resource('exam',ExamController::class);

		// quizz
		Route::resource('quizz',QuizzController::class);

		// question
		Route::resource('question',QuestionController::class);

		// library
		Route::resource('library',LibraryController::class);

	}   
);



