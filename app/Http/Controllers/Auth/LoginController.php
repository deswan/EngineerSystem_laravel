<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
        $this->middleware('guest:admin');
    }

    public function showLoginForm()
    {
        return view('auth.login_s');
    }
    public function loginAjax(Request $r){
        $this->validateLogin($r);   //422
        $code=0;
        if(!\App\User::where('phone',$r->phone)->get()->count()){
            $code=1;
        }else if(!$this->attemptLogin($r)) {
            $code=2;
        }
        return response()->json(['code'=>$code]);

    }
}
