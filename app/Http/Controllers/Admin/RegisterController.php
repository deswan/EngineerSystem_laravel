<?php
namespace App\Http\Controllers\Admin;

use App\Admin;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
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

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $data['phone'] = (int)$data['phone'];
        $msg = [
            'required'=>1,
            'between'=>2,
            'unique'=>2,
            'digits'=>3,
            'email'=>3,
            'confirmed'=>3,
            'alpha_num'=>4,
        ];
        return Validator::make($data, [
            'name' => 'required|between:2,20',
            'phone' => 'required|unique:admins|digits:11',
            'email' => 'required|email|unique:admins',
            'class' => 'required|numeric|between:2,7',
            'password' => 'required|between:6,20|confirmed|alpha_num',
        ],$msg);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return Admin::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'type_id'=>$data['class'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function showRegistrationForm()
    {
        return view('auth.register_t');
    }

    protected function guard()
    {
        return auth()->guard('admin');
    }
    public function registerAjax(Request $r){
        $this->validator($r->all())->validate();   //422
        return response()->json(['code'=>0]);

    }
}
