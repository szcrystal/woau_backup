<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
//use Symfony\Component\HttpFoundation\File\UploadedFil;

use App\Job;
use App\Siteinfo;
use App\Jobentry;
use App\User;
use Auth;
use Mail;
use Input;
use File;

class JobController extends Controller
{

	protected $job;
    
    public function __construct(Job $job, Jobentry $jobentry) {
    	
        $this->middleware('auth');
    	$this -> job = $job;
        $this -> jobentry = $jobentry;
        
        $this -> pg = Siteinfo::first()->value('show_count');
    }
	
	public function getIndex() {
    	$jobs = $this -> job -> where('closed', '公開中') -> orderBy('created_at','desc') ->paginate($this->pg);
        $headTitle = '案件情報一覧';
        
        return view('jobs.index', ['jobs'=>$jobs, 'headTitle'=>$headTitle]);
    }

	public function getJobs() {
    	$jobs = $this -> job -> orderBy('created_at','desc') ->paginate($this->pg);
        return view('jobs.index', compact('jobs'));
    }
    
    public function getNewjobs() {
    	$jobs = $this -> job -> orderBy('created_at','desc') ->paginate($this->pg);
        return view('jobs.index', compact('jobs'));
    }
    
    public function getJob($job_number) { //一覧のjobsとダブルとエラーになるのでネーミングはgetJobにて
    	//if($job_number) {
            //$singleObj = $this->job->where('job_number', $job_number) -> first();
            //$singleObj = $this -> job -> find($jobObj->id) job_numberなので使用不可
        	if($singleObj = $this->job->where('job_number', $job_number) -> first()) {
            
                $arr['singleObj'] = $singleObj;
                $arr['headTitle'] = $singleObj -> company_name;
                
                if($user = Auth::user()) {
                    $entry = $user -> jobentries() -> where('job_id', $singleObj->id) -> first();
                    
                    /* 
                    $entry = $user -> jobentries; //リレーションJobEntriesのuser_idに対してgetするだけならプロパティ(メソッド()なし)として取得出来る
                    foreach($entry as $en) {
                        echo $en -> company_name;
                    }
                    */
                    
                    if(isset($entry)) { //first()で取得したものはオブジェクト、get()で取得したものはコレクション isEmpty()はコレクションに対してのみ使える
                        $arr['already'] = 'この案件は応募済みです';
                    }
                }
                
                return view('jobs.single', $arr);
            }
            else {
            	abort(404);
            }
//        }
//        else {
//        	//$jc = new JobController;
//        	$this -> getIndex(); //$thisで自クラスのインスタンス取得可能のはず
//        }
    }
    
    
    public function getEntry(Request $request, $job_number) {
    	$singleObj = Job::where('job_number', $job_number) -> first();
        $headTitle = '案件に応募する';
        return view('jobs.entry', ['singleObj'=>$singleObj, 'headTitle'=>$headTitle]);
        //echo $_SERVER['DOCUMENT_ROOT'];
    }
    
    public function postEntry(Request $request, $job_number) { //ORG:postIndex
    
    	$obj = $this -> job ->where('job_number', $job_number) -> first();
        $headTitle = '案件に応募する';
    
    	//お問い合わせ最終ページの表示：Finish Page
    	if($request->input('end') == TRUE) { //finishページ
        	if($request->input('_return') !== null ) { //戻るボタンを押した時
            	
                //添付したファイルの削除動作 戻る時に削除する
                $name = $request->input('realPath');
                if(file_exists($name)) {
                    if(unlink($name)) 
                        echo "Done Delete"; //ここをLogに書き出したい
                    else 
                        echo "No Delete";
                }
                else {
                    echo "No Such File";
                }
                
                return back() -> withInput(); //withInput: old()にデータを渡す（sessionで）
            }
            else { //最終ページ：Finish
                $data = $request->all();
                //$this->reservation->fill($data); //モデルにセット
                //$this->reservation->save(); //モデルからsave
                
    //          $file = Input::file('add_file')->move('images/temps','uploads.png');
    //			echo $file->getRealPath();
                
                $data['info'] = Siteinfo::first();

                //mail action
                
                //for user
                $data['is_user'] = 1;
                Mail::send('emails.jobentry', $data, function($message) use ($data) //引数について　http://readouble.com/laravel/5/1/ja/mail.html
                {
                    $message->from($data['info']->site_email, 'woman x auditor');
                    $message->to($data['mail'], $data['name'])->subject('【woman x auditor】'.$data['comp_name'].'への応募が完了しました');
                    //$message->attach($data['realPath'], ['as'=>$data['orgName']]); //,['as'=>'eee', 'mime'=>'image/png']
                });
                
                
                //for admin
                $data['is_user'] = 0;
                Mail::send('emails.jobentry', $data, function($message) use ($data, $request)
                {
                	$message->from($data['info']->site_email, 'woman x auditor');
                    //$dataは連想配列としてメールテンプレviewに渡され、その配列のkey名を変数（$name $mailなど）としてview内で取得出来る
                    $message->to($data['info']->site_email, 'woman x auditor 管理者')->subject(/*.$data['name'] .*/'案件の応募がありました - woman x auditor -');
                    if(isset($data['realPath'])) {
                        //if(isset($data['realPath']) && isset())
                        $message->attach($data['realPath'], ['as'=>$data['orgName']]); //,['as'=>'eee', 'mime'=>'image/png']
                        //env('MAIL_USERNAME')
                    }
                });
                
                
                $this->jobentry->create([ //insertメソッドだと、timestampが自動セットされない createだとされる
                    'user_id' => $data['user_id'],
                    'user_name' => $data['name'],
                    'user_mail' => $data['mail'],
                    'job_id' => $data['job_id'],
                    'company_name' => $data['comp_name'],
                    'note' => $data['note'],
                    'attach_name' => isset($data['orgName']) ? $data['orgName'] : null,
                    'attach_path' => isset($data['realPath']) ? $data['realPath'] : null,
                    //'created_at' => new DateTime,
                    //'updated_at' => new DateTime,
                ]);            
                //['user_id', 'user_name', 'user_mail', 'job_id', 'company_name', 'note', 'attach_path'];

                //session()->forget($this->in);
                return view('jobs.finish', ['obj'=>$obj, 'headTitle'=>$headTitle]);
            }
        }
    	else { //確認ページ：Confirm Page
            $rules = [
                'name' => 'required|max:255',
            	'mail' => 'required|email|max:255',
                //'note' => 'max:1000',
            ];
            $this->validate($request, $rules);
            
            $datas = $request->all(); //requestから配列として$dataにする
            
            // 'add_file' => object(UploadedFile),
            if ($request->hasFile('add_file')) {
                $name = Input::file('add_file')->getClientOriginalName();
                if(getenv('LARAVEL_ENV') == 'heroku') {
                	$file = Input::file('add_file') -> move('../temps/'.$datas['user_number'], $name);
                }
                else {
	                $file = Input::file('add_file') -> move('../../temps/'.$datas['user_number'], $name); //woauの並びに作る woauから外せばgit addの対象からも外れるので
                }
                //$file = Input::file('add_file') -> move('images/temps/'.$datas['user_number'], $name);
                $realPath = $file->getRealPath();
                //echo $name = Input::file('add_file')->getClientOriginalName();
                
                $datas['realPath'] = $realPath;
                $datas['orgName'] = $name;
            }
            
//            foreach($datas as $key => $val) {
//            	if($key != 'add_file')
//		            session([$key=>$val]);
//            }

            return view('jobs.confirm', ['datas'=>$datas, 'obj'=>$obj, 'headTitle'=>$headTitle]); //配列なので、view遷移後はdatas[name]で取得する
            //return redirect()->to('confirm');
        }
	}

    
    

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

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
    public function show($id)
    {
        //
    }

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
