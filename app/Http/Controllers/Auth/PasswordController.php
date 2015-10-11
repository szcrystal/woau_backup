<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\User;
use Mail;
use DB;
//use Hash;

use Illuminate\Auth\Passwords\DatabaseTokenRepository;
//use App\Http\Controllers\Auth\token;


class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;
    //use DatabaseTokenRepository;
    
    protected $redirectTo = '/';
    
    //protected $connection;

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        //$this -> token = new token('password_resets', 'abcde', 120);
        
        $db = DB::connection(getenv('DB_CONNECTION')); //getenv('DB_CONNECTION') :mysql or pgsql
        $hashkey = md5(microtime() * 100000);
        //echo $hashkey;
        $this-> token = new DatabaseTokenRepository($db, 'password_resets', $hashkey, 120); 
        //第一引数はDb connectionのintefaceなので単にDBを送るだけではダメらしい
    }
    
    public function postEmail(Request $request) {
    	$rules = [
            'email' => 'required|email|max:255|exists:users,email',
        ];
        
        $this->validate($request, $rules); //errorなら自動で$errorが返されてリダイレクト、通過で自動で次の処理へ
        
        $data = $request->all();
        
        $user = User::where('email', $data['email']) -> first();
        $data['name'] = $user -> name;
        
        //token作成 パスワードリセット（Token作成）サービスからのインスタンスを使用
        $data['token'] = $this->token->create($user);
        
        Mail::send('emails.password', $data, function($message) use ($data) //引数について　http://readouble.com/laravel/5/1/ja/mail.html
        {
            $message->to($data['email'], $data['name'])->subject('【woman x auditor】パスワードリセットリンク');
        });
        
        return redirect('password/email') -> with('status', 'メールを送信しました。'."<br />".'メール内に記載されているリセット用リンクをクリックして手続きをお進め下さい。');
        
    }
}

