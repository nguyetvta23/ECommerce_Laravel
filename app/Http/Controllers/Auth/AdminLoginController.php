<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    protected function redirectTo(){
        if(Auth()->user()->role == 1){
            return route('admintrator');
        }elseif(Auth()->user()->role == 0){
            return route('home');
        }
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function showLogin(){
        return view('Admin.auth.login');
    }
    public function login(Request $request){
        $input = $request->all();
        $this->validate($request,[
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
            'password' =>['required', 'max:16'],
        ],[
            'email.required'=> 'Email không được bỏ trống!', 
            'email.regex'=>'Email không đúng định dạng!',
            'password.required'=> 'Mật khẩu không được bỏ trống!', 
            'password.max:55'=> 'Mật khẩu quá dài!',
        ]);
        if(auth()->attempt(array('email'=>$input['email'], 'password'=>$input['password']))){
            if (auth()->user()->role == 1) {
                    return redirect()->route('admintrator');
                }
                elseif (auth()->user()->role == 0) {
                    return redirect()->route('home');
                }
        }
        else{
            return back()->with('error', 'Kiểm tra lại email hoặc mật khẩu không đúng!');
        }
    }
        // echo 'Đăng nhập thành công!';

        // if(auth()->attempt(array('email'=>$input['email'], 'password'=>$input['password']))){
        //     if (auth()->user()->role == 1) {
        //         return redirect()->route('admintrator');
        //     }
        //     elseif (auth()->user()->role == 0) {
        //         return redirect()->route('home');
        //     }
        // }
        // else{
        //     return redirect()->route('login');
        // }
        // // ->with('error', 'Email hoặc mật khẩu không đúng');  
    public function logout(){
        Auth::logout();
        return redirect()->route('home');
    }
	/**
	 * Where to redirect users after login.
	 * 
	 * @return string
	 */
	function getRedirectTo() {
		return $this->redirectTo;
	}
	
	/**
	 * Where to redirect users after login.
	 * 
	 * @param string $redirectTo Where to redirect users after login.
	 * @return AdminLoginController
	 */
	function setRedirectTo($redirectTo): self {
		$this->redirectTo = $redirectTo;
		return $this;
	}
}
