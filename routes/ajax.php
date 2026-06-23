<?php

use App\Http\Controllers\AjaxController;


Route::group(['middleware' => 'auth:teacher,web'], function () {
 // get Classroom
		Route::get('/get_classroom/{id}', [AjaxController::class,'getClassroom']);
	// get section
		Route::get('/get_section/{id}', [AjaxController::class,'getSection']);

});