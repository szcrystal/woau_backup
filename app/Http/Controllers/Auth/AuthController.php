<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Page;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use Mail;

use App\Siteinfo;

class AuthController extends Controller
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
    
    protected $redirectTo = '/'; //Login後のリダイレクト先 MiddleWare内のメソッドにも指定あり

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
        
//        $this->in = array(
//            'name',
//            'email',
//            //'password',
//            //'user_number',
//            'birth_year',
//            'birth_month',
//            'birth_day',
//            'address',
//            'work_history',
//            'office_posi',
//            'is_trip',
//            'eng_ability',
//            'get_year',
//            'exp_type',
//            'audit_posi',
//            //'other' => $data['other'],
//            //'admin'
//        );
    }
    
    
//    public function authenticate(array $data)
//    {
//    	//$data = $request->all();
//    
//        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']]))
//        {
//            return redirect('/')/*->intended('dashboard')*/;
//        }
//        else {
//        	return redirect()->back()->withErrors('メールかパスが違う');
//        }
//    }
    

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
            'password' => 'required|confirmed|min:5',
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
            
            'user_number' => mt_rand(10000, 20000),
            'birth' => $data['birth'],
            'address' => $data['address'],
            'work_history' => $data['work_history'],
            'is_trip' => $data['is_trip'],
            'eng_ability' => $data['eng_ability'],
            'get_year' => $data['get_year'],
            'exp_type' => $data['exp_type'],
            'audit_posi' => $data['audit_posi'],
            //'other' => $data['other'],
            
            'admin' => 10,
        ]);
    }
    
    public function getLogin() {
    
    	return view('auth.login');
    }
    
    public function postLogin(Request $request) {
    
    	$rules = [
            'user_id' => 'required|email|max:255',
            'password' => 'required|min:6',
        ];
        
        $this->validate($request, $rules); //errorなら自動で$errorが返されてリダイレクト、通過で自動で次の処理へ
        
        $data = $request->all();
        
        //LogIn認証チェック : Registerの時点でpasswordはHashされている必要があり
        if (Auth::attempt(['email' => $data['user_id'], 'password' => $data['password']])) //password:ここでのhashは不要
        {
        	return redirect()->intended('/');
        }
        else {
        	$errors[] = '入力内容が正しくありません';
        	/*
            if(! User::where('email', $data['email']) -> exists()) {
        		$errors[] = 'メールアドレスを確認して下さい。';
            }
            else {
            	$errors[] = 'パスワードを確認して下さい。';
            }
            */
            
            //return redirect('dashboard/login') -> withErrors('メールアドレスとパスワードを確認して下さい。');
            //session()->flash('email',$data['email']);
            return back() -> withInput($request->except('password')) -> withErrors($errors);
            //http://laravel.com/docs/5.1/requests#old-input
	    }
    }
    
    
    public function getRegister(Request $request) {
    	//session
//    	foreach($this->in as $val) {
//            $sess[$val] = $request->session()->pull($val, '');
//        }
    	
        //$obj = Page::where('url_name', $request->path()) -> first();
        //$headTitle = '新規'.$obj -> title;
        //$intro_ct = $obj -> intro_content;
        
        $headTitle = '新規ユーザー登録';
        
        return view('auth.register', ['headTitle'=>$headTitle/*, 'intro_ct'=>$intro_ct*/]);
    }
    
    
    //New Register Confirm
    public function postRegister(Request $request) {
    	
        $headTitle = '新規ユーザー登録';
    
    	if($request->input('end') == TRUE) { //ConfirmからのPOST送信時 送信or戻る
        	if( $request->input('_return') !== null ) { //戻るボタンを押した時
                return back() -> withInput();
                //withInput: old()にデータを渡す（sessionで）>> http://laravel.com/docs/5.1/requests#old-input
            }
        	else { //最終ページ：Finish
                $data = $request->all();
                //$this->reservation->fill($data); //モデルにセット
                //$this->reservation->save(); //モデルからsave
                
                $birth = $data['birth_year'] != '--' ? $data['birth_year'] : 0000;
                $birth .= '-'; 
                $birth .= $data['birth_month'] != '--' ? $data['birth_month'] : 00;
                $birth .= '-';
                $birth .= $data['birth_day'] != '--' ? $data['birth_day'] : 00;
                
                $user = User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => bcrypt($data['password']),
                    
                    'user_number' => mt_rand(10000, 50000),
                    'birth' => $birth,
                    'address' => $data['address'],
                    'work_history' => $data['work_history'],
                    //'office_posi' => $data['office_posi'],
                    'is_trip' => $data['is_trip'],
                    'eng_ability' => $data['eng_ability'],
                    'get_year' => $data['get_year'] != '--' ? $data['get_year'] : 0,
                    'exp_type' => $data['exp_type'],
                    'audit_posi' => $data['audit_posi'],
                    //'other' => $data['other'],
                    
                    'admin' => 10,
                ]);
                
                $data['id'] = $user->id;
                $data['user_number'] = $user->user_number;
                $data['info'] = Siteinfo::first();
                
                //mail action
                //for User
                $data['is_user'] = 1;
                Mail::send('emails.register', $data, function($message) use ($data) //引数について　http://readouble.com/laravel/5/1/ja/mail.html
                { 
                	//$dataは連想配列としてメールテンプレviewに渡され、その配列のkey名を変数（$name $mailなど）としてview内で取得出来る
                	$message -> from($data['info']->site_email, 'woman x auditor')
                    		 -> to($data['email'], $data['name'])
                             -> subject('【woman x auditor】ユーザー登録が完了しました');
                    //$message->attach($pathToFile);
                });
                
                //for Admin
                $data['is_user'] = 0;
                if(! env('MAIL_CHECK', 0)) { //本番時 env('MAIL_CHECK')がfalseの時
                    Mail::send('emails.register', $data, function($message) use ($data)
                    {
                        $message -> from($data['info']->site_email, 'woman x auditor')
                        		 -> to($data['info']->site_email, 'woman x auditor 管理者')
                                 -> subject('ユーザー登録がありました - woman x auditor -');
                    });
                    
                    $this -> mailToMe($data);
                }
                else { //メールのチェック時 env('MAIL_CHECK')がtrueの時
                	$this -> mailToMe($data);
                }
                
                Auth::login($user);
                            
                return view('auth.registerEnd', ['data'=>$data, 'headTitle'=>$headTitle.'-完了']);
            }
        }
        else { //Confirm
            $rules = [
                'name' => 'required',
                'email' => 'required|email|max:255|unique:users,email',
                'password' => 'required|confirmed|min:6',
                //'address' => 'required',
            ];
            $this->validate($request, $rules);
            
            $datas = $request->all(); //requestから配列として$dataにする
            //session($datas);
                        
            return view('auth.confirm', ['datas'=>$datas, 'headTitle'=>$headTitle.'-確認']); //配列なので、view遷移後はdatas[name]で取得する
        }
            //return redirect()->to('confirm');
            //return redirect('/contact');
    }
    
    
    public function mailToMe($data) {
    	Mail::send('emails.register', $data, function($message) use ($data) { 
            $message -> from($data['info']->site_email, 'woman x auditor')
                     -> to('szk@woman-auditor.com', $data['name'])
                     -> subject('【woman x auditor】ユーザー登録が完了しました');
        });
    }
    
    
    /*
    public function getAaa() {
    	$data['name'] = 'aaa';
        $data['email'] = 'aaa@aaa.aaa';
        $headTitle = 'aaaaa';
    	return view('auth.registerEnd', ['data'=>$data, 'headTitle'=>$headTitle]);
    }
 	*/
/*
    //New Register Finish
    public function postRegisterEnd(Request $request) {
    	$data = $request->all();
        //$this->reservation->fill($data); //モデルにセット
        //$this->reservation->save(); //モデルからsave
        
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            
            'user_number' => mt_rand(10000, 20000),
            'birth' => $data['birth_year'] . '/' . $data['birth_month'] . '/' . $data['birth_day'],
            'address' => $data['address'],
            'work_history' => $data['work_history'],
            'office_posi' => $data['office_posi'],
            'is_trip' => $data['is_trip'],
            'eng_ability' => $data['eng_ability'],
            'get_year' => $data['get_year'],
            'exp_type' => $data['exp_type'],
            'audit_posi' => $data['audit_posi'],
            //'other' => $data['other'],
            
            'admin' => 10,
        ]);
        
        Auth::login($user);
        
        $mailAdd = $data['email'];
		//mail action
        Mail::send('emails.register', $data, function($message) use ($data) //引数について　http://readouble.com/laravel/5/1/ja/mail.html
        {
        	//$dataは連想配列としてメールテンプレviewに渡され、その配列のkey名を変数（$name $mailなど）としてview内で取得出来る
            $message->to($data['email'], $data['name'])->subject('登録が完了しました');
            
            //$message->attach($pathToFile);
        });
        
        //return redirect('/');
        return view('auth.registerEnd') ->with(compact('data'));
    }
*/
    
        
    
    public function getLogout() { //Logout後、Redirectさせる
    	Auth::logout();
    	return redirect('/');
    }
    
}


