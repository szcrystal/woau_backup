<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Iroha;
use App\Studyentry;
use App\Siteinfo;

use Auth;
use Mail;

class IrohaController extends Controller
{
	protected $iroha;
    
    public function __construct(Iroha $iroha, Studyentry $studyentry, Siteinfo $siteinfo)
    {
    	$this->middleware('auth');
        $this-> iroha = $iroha;
        $this -> studyentry = $studyentry;
        $this -> pg = $siteinfo->first()->value('show_count');
    }
    
    
    public function getIndex() {
    	return redirect('iroha/1');
//    	$obj = $this -> iroha -> where(['url_name'=>'', 'slug'=>'irohas']) -> first();
//        
//        if($obj->closed == '非公開') {
//        	abort(404);
//        }
//        else {
//            $irohaObjs = $this -> iroha -> where(['slug'=>'irohas', 'closed'=>'公開中']) -> orderBy('created_at') -> get();
//            //$this -> topic -> orderBy('created_at','desc') ->paginate(10);
//            
//            //$links = array();
//            foreach($irohaObjs as $irohaObj) {
//                if($irohaObj->url_name != 'iroha')
//                    $links[] = $irohaObj->url_name;
//            }
//            
//            return view('irohas.index', ['obj'=>$obj, 'links'=>$links]);
//        }
    }
    
    public function show($url_name) {
    
        //$url_nameを$idとしても併用可能なので、併用する	
        if($obj = $this ->iroha ->find($url_name)) {
        
            if($obj->closed == '非公開' && (! Auth::user() || Auth::user()->admin != 99)) {
                abort(404);
            }
            else {
                if($url_name == 1)
                    return view('irohas.index', ['obj'=>$obj/*, 'links'=>$links*/]);
                else
                    return view('irohas.page', compact('obj'));
            }
        }
        else {
        	if($url_name == 'study') {
                $objs = $this -> iroha -> where(['slug'=>'study', 'closed'=>'公開中']) -> orderBy('created_at','desc') -> paginate($this->pg);
                $headTitle = '監査役いろは勉強会一覧';
                return view('irohas.study', ['objs'=>$objs, 'headTitle'=>$headTitle]);
            }
            else {
        		abort(404);
            }
        }
    }

//    public function getStudy() {
//        $objs = $this -> iroha -> where('slug', 'study') -> orderBy('created_at','desc') -> paginate(10);
//        return view('irohas.study', ['objs'=>$objs]);
//    }
    
    public function getStudy($id) {
    	
        if( $arr['atcl'] = $this -> iroha -> where(['id'=>$id, 'slug'=>'study']) -> first() ) {
        
            if($user = Auth::user()) {
                $entry = $user -> studyentries() -> where('iroha_id', $arr['atcl']->id) -> first();
                /* 
                $entry = $user -> jobentries; //リレーションJobEntriesのuser_idに対してgetするだけならプロパティ(メソッド()なし)として取得出来る
                foreach($entry as $en) {
                    echo $en -> company_name;
                }
                */
                if(isset($entry)) { //first()で取得したものはオブジェクト、get()で取得したものはコレクション isEmpty()はコレクションに対してのみ使える
                    $arr['already'] = '参加申込み済みです';
                }
            }
            
            return view('irohas.single', $arr);
        }
        else {
        	abort(404);	
        }
        
    }
    
    //勉強会参加フォーム
    public function getEntry(Request $request, $id) {
    	$obj = $this -> iroha -> find($id);
        
//        foreach($this->in as $val) {
//            $sess[$val] = $request->session()->pull($val, '');
//        }
        $headTitle = '勉強会参加申込み';
        return view('irohas.entry', ['obj'=>$obj, 'headTitle'=>$headTitle]);
    }
    
    public function postEntry(Request $request, $id) { //ORG:postIndex
    
    	$obj = $this ->iroha ->find($id);
        $headTitle = '勉強会参加申込み';
    
    	//お問い合わせ最終ページの表示：Finish Page
    	if($request->input('end') == TRUE) { // ConfirmからのPOST 送信or戻る
        	if($request->input('_return') !== null ) { //戻るボタンを押した時
                return back() -> withInput(); //withInput: old()にデータを渡す（sessionで）
            }
            else { //最終ページ：Finish
                $data = $request->all();
                //$this->reservation->fill($data); //モデルにセット
                //$this->reservation->save(); //モデルからsave
                $data['info'] = Siteinfo::first();
                
                //mail action
                //for User
                $data['is_user'] = 1;
                Mail::send('emails.studyentry', $data, function($message) use ($data) //引数について　http://readouble.com/laravel/5/1/ja/mail.html
                {
                    $message -> from($data['info']->site_email, 'woman x auditor')
                    		 -> to($data['mail'], $data['name'])
                             -> subject('【woman x auditor】勉強会のお申し込みが完了しました');
                    //$message->attach($pathToFile);
                });
                
                //for Admin
                $data['is_user'] = 0;
                if(! env('MAIL_CHECK', 0)) { //本番時 env('MAIL_CHECK')がfalseの時
                    Mail::send('emails.studyentry', $data, function($message) use ($data)
                    {
                        $message -> from($data['info']->site_email, 'woman x auditor')
                                 -> to($data['info']->site_email, 'woman x auditor 管理者')
                                 -> subject('勉強会の申し込みがありました - woman x auditor -');
                    });
                    
                    if(env('APP_ENV', 'local') == 'production') //or app()->environment()
	                    $this -> mailToMe($data);
                }
                else { //メールのチェック時 env('MAIL_CHECK')がtrueの時
                	$this -> mailToMe($data);
                }
                
                $this -> studyentry -> create([
                    'user_id' => $data['user_id'],
                    'user_name' => $data['name'],
                    'user_mail' => $data['mail'],
                    'iroha_id' => $data['iroha_id'],
                    'study_name' => $data['study_name'],
                    'note' => $data['note'],
                ]);
                
                //session()->forget($this->in);
                
                return view('irohas.finish', ['obj'=>$obj, 'headTitle'=>$headTitle.'-完了']);
            }
        }
    	else { //確認ページ：Confirm Page
            $rules = [
                'name' => 'required|max:255',
            	'mail' => 'required|email|max:255',
                //'note' => 'max:500',
            ];
            $this->validate($request, $rules);
            
            $datas = $request->all(); //requestから配列として$dataにする
            
            //session($datas);
            
            return view('irohas.confirm', ['datas'=>$datas, 'obj'=>$obj, 'headTitle'=>$headTitle.'-確認']);
            //return view('irohas.confirm')-> with(compact('datas')); //配列なので、view遷移後はdatas[name]で取得する
            //return redirect()->to('confirm');
        }
	}
    
	
    public function mailToMe($data) {
    	Mail::send('emails.studyentry', $data, function($message) use ($data) {
            $message -> from($data['info']->site_email, 'woman x auditor')
                     -> to('szk@woman-auditor.com', 'woman x auditor 管理者')
                     -> subject('勉強会の申し込みがありました - woman x auditor -');
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
//    public function index()
//    {
//        //
//    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
//    public function show($id)
//    {
//        //
//    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
