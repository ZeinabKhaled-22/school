<?php

use App\Http\Controllers\parent\dashboard\ChildrenParentController;
use App\Models\Student;
use Illuminate\Http\Request;
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
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:parent']
    ], function () {

    //==============================dashboard============================
    Route::get('/parents/dashboard', function () {
        $sons = Student::where('parent_id',auth()->user()->id)->get();
        return view('parents.dashboard',compact('sons'));
    })->name('dashboard.parents');

    Route::group(['namespace' => 'parent\dashboard'], function () {
        Route::get('children', [ChildrenParentController::class,'index'])->name('sons.index');
        Route::get('results/{id}', [ChildrenParentController::class,'results'])->name('sons.results');
        Route::get('attendances', [ChildrenParentController::class,'attendances'])->name('sons.attendances');
        Route::post('attendances',[ChildrenParentController::class,'attendanceSearch'])->name('sons.attendance.search');
        Route::get('fees', 'ChildrenController@fees')->name('sons.fees');
        Route::get('receipt/{id}', 'ChildrenController@receiptStudent')->name('sons.receipt');
        Route::get('profile/parent', 'ChildrenController@profile')->name('profile.show.parent');
        Route::post('profile/parent/{id}', 'ChildrenController@update')->name('profile.update.parent');
    });

});