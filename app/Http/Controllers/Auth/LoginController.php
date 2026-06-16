<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Traits\AuthTrait;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    //use AuthenticatesUsers;

    use AuthTrait;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');

    }


    public function loginForm($type){

        return view('auth.login',compact('type'));
    }

    public function login(Request $request){
        if (Auth::guard($this->chekGuard($request))->attempt(['email' => $request->email, 'password' => $request->password])) {
            
        $request->session()->regenerate();

           return $this->redirect($request);
        }
        else{
            return redirect()->back()->with('message', 'يوجد خطا في كلمة المرور او اسم المستخدم');
        }
    }

    public function logout(Request $request,$type)
    {

    Auth::guard('web')->logout();
    Auth::guard('student')->logout();
    Auth::guard('teacher')->logout();
    Auth::guard('parent')->logout();

    $request->session()->invalidate();

        return redirect('/');
    }



}