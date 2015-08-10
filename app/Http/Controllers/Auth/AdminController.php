<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Illuminate\Http\Request;
use App\Http\Requests;

use Auth;

class AdminController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;
    
    protected $redirectTo = '/dashboard'; //Login後のリダイレクト先 MiddleWare内のメソッドにも指定あり

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('adminGuest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'admin' => 99,
        ]);
    }
    
    public function getLogin() {
    	return view('dashboard.login');
    }
    
    public function postLogin(Request $request) {
    
    	$rules = [
            'email' => 'required|email|max:255',
            'password' => 'required|min:6',
        ];
        
        $this->validate($request, $rules); //errorなら自動で$errorが返されてリダイレクト、通過で自動で次の処理へ
        
        $data = $request->all();
        
        //LogIn認証チェック : Registerの時点でpasswordはHashされている必要があり
        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) //password:ここでのhashは不要
        {
        	return redirect()->intended('dashboard');
        }
        else {
        	$error[] = 'メールアドレスとパスワードを確認して下さい。';
            //$error[] = 'hogehoge';
            //return redirect('dashboard/login') -> withErrors('メールアドレスとパスワードを確認して下さい。');
            return redirect() -> back() -> withErrors($error);
	    }
    
    
    }
    
}
