<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
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
        $this->middleware('guest:admin', ['except' => 'logout']);
        $this->middleware('guest');

    }

    protected function guard()
    {
        return auth()->guard('admin');
    }
    public function showLoginForm()
    {
        return view('auth.login_t');
    }
    public function loginAjax(Request $r){
        $this->validateLogin($r);   //422
        $code=0;
        if(!\App\Admin::where('phone',$r->phone)->get()->count()){
            $code=1;
        }else if(!$this->attemptLogin($r)) {
            $code=2;
        }
        return response()->json(['code'=>$code]);

    }
}
