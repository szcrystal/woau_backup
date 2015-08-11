<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
//use Symfony\Component\HttpFoundation\File\UploadedFil;

use App\Job;
use App\Siteinfo;
use App\Jobentry;
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
    	$jobs = $this -> job -> orderBy('created_at','desc') ->paginate($this->pg);
        return view('jobs.index', compact('jobs'));
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
        	$singleObj = Job::where('job_number', $job_number) -> first();
        	//$singleObj = $this -> job -> find($jobObj->id);
        
        	return view('jobs.single') -> with(compact('singleObj'));
//        }
//        else {
//        	//$jc = new JobController;
//        	$this -> getIndex(); //$thisで自クラスのインスタンス取得可能のはず
//        }
    }
    
    
    public function getEntry(Request $request, $job_number) {
    
    	$singleObj = Job::where('job_number', $job_number) -> first();
        return view('jobs.entry', ['singleObj'=>$singleObj]);
    }
    
    public function postEntry(Request $request) { //ORG:postIndex
    
    	//お問い合わせ最終ページの表示：Finish Page
    	if($request->input('end') == TRUE) { //finishページ
        	if($request->input('_return') !== null ) { //戻るボタンを押した時
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
                    $message->to($data['mail'], $data['name'])->subject('【woman x auditor】応募が完了しました');
                    //$message->attach($data['realPath'], ['as'=>$data['orgName']]); //,['as'=>'eee', 'mime'=>'image/png']
                });
                
                //for admin
                $data['is_user'] = 0;
                Mail::send('emails.jobentry', $data, function($message) use ($data, $request)
                {
                    //$dataは連想配列としてメールテンプレviewに渡され、その配列のkey名を変数（$name $mailなど）としてview内で取得出来る
                    $message->to($data['info']->site_email, 'woman x auditor 管理者')->subject('【woman x auditor】'.$data['name'] . 'さんより企業への応募がありました');
                    if (isset($data['realPath'])) {
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
                return view('jobs.finish');
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
                $file = Input::file('add_file') -> move('images/temps/'.$datas['user_number'], $name);
                $realPath = $file->getRealPath();
                //echo $name = Input::file('add_file')->getClientOriginalName();
                
                $datas['realPath'] = $realPath;
                $datas['orgName'] = $name;
            }
            
            foreach($datas as $key => $val) {
            	if($key != 'add_file')
		            session([$key=>$val]);
            }
            return view('jobs.confirm')-> with(compact('datas')); //配列なので、view遷移後はdatas[name]で取得する
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