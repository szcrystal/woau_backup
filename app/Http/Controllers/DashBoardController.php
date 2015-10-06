<?php

namespace App\Http\Controllers;

use App\Page;
use App\Topic;
use App\Iroha;
use App\Job;
use App\Blog;
use App\User;
use App\Cate;
use App\CateRelation;
use App\Siteinfo;
use App\Studyentry;
use App\Jobentry;
use Auth;
use DB;
use Storage;
use Mail;
use Schema;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DashBoardController extends Controller
{
	protected $post;
    
    public function __construct(Page $page, Topic $topic, Job $job, Iroha $iroha, Blog $blog, Cate $cate, CateRelation $cateRelation, Siteinfo $siteinfo) {
    	
        $this -> middleware('admin');
        
        $this -> page = $page;
        $this -> topic = $topic;
        $this -> job = $job;
        $this -> iroha = $iroha;
    	$this -> blog = $blog;
        $this -> cate = $cate;
        $this -> cateRelation = $cateRelation;
        $this -> siteinfo = $siteinfo;
        
        //$this -> val = ''; //検索ワードを入れる（whereのクロージャ用）->現在未使用
        $this -> pg = 20; //paginate num
    }
    
    
//    public function getLogin() {
//    	return view('auth.login');
//    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {    	
        if(Auth::user()->admin != 99) { //Admin以外はアクセス不可
            echo "アクセス出来ません<br />Not Admin<a href=\"/\">BACK</a>";
        }
        else {
        	$userObjs = User::where('admin', 10)->orderBy('created_at', 'desc') -> take(5) -> get();
            $jobObjs = Job::orderBy('created_at', 'desc') -> take(5) -> get();
            return view('dashboard.index', ['userObjs'=>$userObjs, 'jobObjs'=>$jobObjs ]);
            
        }
    }

    //検索関数
    public function returnSearchObj($table_name, $search) {
        
        //query取得
        if($table_name == 'irohas') 
            $query = DB::table($table_name) ->where('slug', 'irohas');
        
        else if($table_name == 'study') 
            $query = DB::table('irohas') ->where('slug', 'study');
        
        else if($table_name == 'users') 
            $query = DB::table($table_name)->whereNotIn('admin',[99]);

        else 
            $query = DB::table($table_name);
        
        //全角スペース時半角スペースに置き換える
        if( str_contains($search, '　')) {
            $search = str_replace('　', ' ', $search);
        }
        
        //検索queryをカラムごとに繰り返すメイン関数
        function queryWhere($array, $qry, $word) {
        	foreach($array as $column) {
            	if($column != 'created_at' && $column != 'updated_at' && $column != 'birth') { //日付の検索ができないので要調査
                    
                    if($column == 'job_number' || $column == 'user_number') 
                        $qry -> orWhere($column, $word);
                    else 
                        $qry -> orWhere($column, 'like', $word);
                }
            }
        }        
        
        //カラム名の全てを取得
        $arr = Schema::getColumnListing($table_name); //これでカラム取得が出来る
        
		//or
         //toArray：コレクションのヘルパー。クエリビルダーをコレクションにしてからtoArrayする
        //$arr = collect(DB::table($table_name)->first())->toArray(); 
        //$arr = array_keys($arr);
        
        /*
        //カラムの配列
        if($table_name == 'cates') {
        	$arr = collect(DB::table($table_name)->first());
        	//$arr =  $arr->toArray();
            $arr = array_keys($arr);
            //echo $arr['c_name'];
            print_r(DB::table($table_name)->first());
        	//$arr = ['c_name', 'slug'];
        }
        elseif($table_name == 'studyentries') {
        	$arr = ['user_name', 'user_mail', 'iroha_id', 'study_name', 'note'];
        }         
        */
        
        if(str_contains($search, ' ')) { //半角スペース AND検索
            $searchs = explode(' ', $search);
            
            foreach($searchs as $val) {
                //$this->val = "%".$val."%";
                $val = "%".$val."%";                
                $query ->where( function($query) use($arr, $val) { //絞り込み検索の時はwhereクロージャを使う
                    queryWhere($arr, $query, $val);
                });
                
                /*
                if($table_name == 'cates') {
                    $query ->where( function($query) use($arr, $value) { //絞り込み検索の時、where節をクロージャにする。where節をクロージャにした時に引数は1つまで。更にglobal変数が効かない ->use($arg)で行ける where(['slug'=>'aaa'], function(){...})も行ける
                        //$query ->where('c_name', 'like', $value)
                        //        ->orWhere('slug', 'like', $value);
                        
                        //$arr = ['c_name', 'slug'];
                        queryWhere($arr, $query, $value);
                        
                    });
                }
                elseif($table_name == 'studyentries') {
                	$query ->where(function($query) {
                        $query ->where('user_name', 'like', $this->val)
                                ->orWhere('user_mail', 'like', $this->val)
                                ->orWhere('iroha_id', 'like', $this->val)
                                ->orWhere('study_name', 'like', $this->val)
                                ->orWhere('note', 'like', $this->val);
                                //->orWhere('created_at', 'like', $this->val);
                    });
                }
                elseif($table_name == 'jobs') {
                	$query ->where(function($query) { 
                        $query ->where('id', $this->val)
                                ->orWhere('job_number', $this->val)
                                ->orWhere('company_name', 'like', $this->val)
                                ->orWhere('title', 'like', $this->val)
                                ->orWhere('sub_title', 'like', $this->val)
                                ->orWhere('main_content', 'like', $this->val)
                                ->orWhere('work_name', 'like', $this->val)
                                ->orWhere('work_site', 'like', $this->val)
                                ->orWhere('work_format', 'like', $this->val)
                                ->orWhere('work_day', 'like', $this->val)
                                ->orWhere('main_content', 'like', $this->val)
                                ->orWhere('work_name', 'like', $this->val)
                                ->orWhere('work_site', 'like', $this->val)
                                ->orWhere('work_format', 'like', $this->val)
                                ->orWhere('closed', 'like', $this->val);
                                //->orWhere('created_at', 'like', $this->val);
                    });
                }
                elseif($table_name == 'study') {
                    $query ->where(function($query) { 
                        $query ->where('title', 'like', $this->val)
                                ->orWhere('sub_title', 'like', $this->val)
                                ->orWhere('intro_content', 'like', $this->val)
                                ->orWhere('main_content', 'like', $this->val)
                                ->orWhere('closed', 'like', $this->val);
                    });
                }
                elseif($table_name == 'jobentries') {
                	$query ->where(function($query) {
                        $query ->where('id', $this->val)
                                ->orWhere('user_id', $this->val)
                                ->orWhere('user_name', 'like', $this->val)
                                ->orWhere('user_mail', 'like', $this->val)
                                ->orWhere('company_name', 'like', $this->val)
                                ->orWhere('note', 'like', $this->val);
                    });
                }
                else {
                    $query ->where(function($query) { 
                        $query ->where('title', 'like', $this->val)
                                ->orWhere('sub_title', 'like', $this->val)
                                ->orWhere('intro_content', 'like', $this->val)
                                ->orWhere('main_content', 'like', $this->val);
                                //->orWhere('sub_content', 'like', $this->val);
                    });
                }//else
                */
            }//foreach
        }
        else { //1word検索
            $val = "%".$search."%";
            queryWhere($arr, $query, $val);
            
            /*
            if($table_name == 'cates') {
                //$query ->where( function($query) { 
                $query ->where('c_name', 'like', $this->val)
                        ->orWhere('slug', 'like', $this->val);
                //});
            }
            elseif($table_name == 'studyentries') {
                $query ->where('user_name', 'like', $this->val)
                        ->orWhere('user_mail', 'like', $this->val)
                        ->orWhere('iroha_id', 'like', $this->val)
                        ->orWhere('study_name', 'like', $this->val)
                        ->orWhere('note', 'like', $this->val);
                        //->orWhere('created_at', 'like', $this->val);
            }
            elseif($table_name == 'jobs') {
                $query ->where('id', $this->val)
                        ->orWhere('job_number', $this->val)
                        ->orWhere('company_name', 'like', $this->val)
                        ->orWhere('title', 'like', $this->val)
                        ->orWhere('sub_title', 'like', $this->val)
                        ->orWhere('main_content', 'like', $this->val)
                        ->orWhere('work_name', 'like', $this->val)
                        ->orWhere('work_site', 'like', $this->val)
                        ->orWhere('work_format', $this->val)
                        ->orWhere('work_day', 'like', $this->val)
                        ->orWhere('main_content', 'like', $this->val)
                        ->orWhere('work_name', 'like', $this->val)
                        ->orWhere('work_site', 'like', $this->val)
                        ->orWhere('work_format', 'like', $this->val)
                        ->orWhere('closed', 'like', $this->val);
            }
            elseif($table_name == 'study') {
                $query ->where('title', 'like', $this->val)
                        ->orWhere('sub_title', 'like', $this->val)
                        ->orWhere('intro_content', 'like', $this->val)
                        ->orWhere('main_content', 'like', $this->val)
                        ->orWhere('closed', 'like', $this->val);
            }
            elseif($table_name == 'jobentries') {
                $query ->where('id', $this->val)
                        ->orWhere('user_id', $this->val)
                        ->orWhere('user_name', 'like', $this->val)
                        ->orWhere('user_mail', 'like', $this->val)
                        ->orWhere('company_name', 'like', $this->val)
                        ->orWhere('note', 'like', $this->val);
            }
            else {
                //$query -> where(function($query) {
                $query -> where('title', 'like', $this->val)
                       -> orWhere('sub_title', 'like', $this->val)
                       -> orWhere('intro_content', 'like', $this->val)
                       -> orWhere('main_content', 'like', $this->val);
                           //-> orWhere('closed', 'like', $this->val);
                           //-> orWhere('sub_content', 'like', $this->val);
                //});
            }//else
            */
            
        } //1word Else
        
        //$count = $query->count();
        $pages = $query->paginate($this->pg);
        $pages -> appends(['s' => $search]); //paginateのヘルパー：urlを付ける
        
        return [$pages, $search];
    }
    
    
    /* ******************************* */
    
    //Pages
    public function getPages(Request $request) {
    	if($request -> has('s')) {
        	$objs = $this -> returnSearchObj('pages', $request->input('s'));
            return view('dbd_pages.pages', [ 'objs'=>$objs[0], 'searchStr' => $objs[1] ]);
        }
        else {
        	$objs = $this -> page -> orderBy('created_at','desc') ->paginate($this->pg);
            return view('dbd_pages.pages', ['objs'=>$objs]);
        }
    }
    //pages add
    public function getPagesAdd() {
    	//$pages = $this -> page -> orderBy('created_at','desc') ->paginate(5);
        return view('dbd_pages.dataform')/*->with(compact('pages'))*/;
    }
    
    public function postPagesAdd(Request $request) {
    	$rules = [
            'title' => 'required',
            'sub_title' => 'required',
            'url_name' => 'required|unique:pages,url_name',
        ];
        $this->validate($request, $rules);
        
    	$data = $request->all(); //requestから配列として$dataにする
        $this->page->fill($data); //モデルにセット
        $this->page->save(); //モデルからsave
        
        $id = $this->page->id;
        
    	return redirect('dashboard/pages-edit/'."$id")->with('status', '固定ページが追加されました！');
    }
    
    //pages Edit
    public function getPagesEdit($id) {
    	$article = $this->page->find($id);
        
        //$bytes = random_bytes(5);
		//$bytes = bin2hex(mt_rand());
        $bytes = md5(uniqid(rand(), TRUE));
        session(['del_key' => $bytes]);
        
        return view('dbd_pages.dataform', compact('article'));
    }

    public function postPagesEdit(Request $request, $id) {
    	
        $rules = [
            'title' => 'required',
            'sub_title' => 'required',
            'url_name' => $id != $this->siteinfo->first()->top_id ? 'required|unique:pages,url_name,'.$id : '',
        ];
        $this->validate($request, $rules);
        
        $article = $this->page->find($id);
        $data = $request->all(); //$data:配列
        if(!isset($data['closed'])) {
        	$data['closed'] = '公開中';
        }
        $article->fill($data);
        $article->save();
        
        //print_r($data);
        return redirect('dashboard/pages-edit/'.$id)->with('status', '固定ページが更新されました！');
        
    }
    
    //Page Delete
    public function getDelete(Request $request, $id) {
    	
        if($request -> input('t') !== null) {
        	$p_type = $request -> input('t'); //GET[t]値
            
            if($p_type == 'pages')
                $article = $this->page->find($id);
            elseif($p_type== 'topics')
                $article = $this->topic->find($id);
            elseif($p_type == 'jobs')
                $article = $this->job->find($id);
            elseif($p_type == 'irohas' || $p_type == 'study')
                $article = $this->iroha->find($id);
            elseif($p_type == 'blog')
                $article = $this->blog->find($id);
            
            return view('dashboard.delete',['article'=>$article, 'p_type'=>$p_type]);
        }
        else { //GET[t]値が無い
        	//$text = "Invalid Access: 1100<br />削除出来ません。<br /><a href='/dashboard'>Dashboard Topへ戻る</a>";
            //return response()->view('errors.500', ['text'=>$text])->header('status', 500);
        	abort(500, "Invalid Access: 1100<br />削除出来ません。<br /><a href='/dashboard'>Dashboard Topへ戻る</a>");
        }
    }
    
    public function postDelete(Request $request, $id) {
    	if($request -> input('t') !== null) {
        	$p_type = $request -> input('t'); //POST[t]値
            
            if($p_type == 'pages')
                $delObj = $this->page->find($id);
            elseif($p_type== 'topics')
                $delObj = $this->topic->find($id);
            elseif($p_type == 'jobs')
                $delObj = $this->job->find($id);
            elseif($p_type == 'irohas' || $p_type == 'study')
                $delObj = $this->iroha->find($id);
            elseif($p_type == 'blog')
                $delObj = $this->blog->find($id);
            
        	$data = $request->all();
            
            if($p_type == 'jobs')
    			$title = $delObj -> company_name;        
            else
	            $title = $delObj -> title;
        
            if($data['del_key'] == session('del_key')) {
                $delObj->delete();
                session() -> forget('del_key');
                
                return redirect('/dashboard/'.$p_type) -> with('status', '『' .$title.'』が削除されました。');
            }
            else { //session 不一致
                abort(500, "Invalid Access: 1102<br />削除出来ません。<br /><a href='/dashboard'>Dashboard Topへ戻る</a>");
            }
        }
        else { //POST[t]値が無い
        	abort(500, "Invalid Access: 1101<br />削除出来ません。<br /><a href='/dashboard'>Dashboard Topへ戻る</a>");
        }
    }
    
    
    /* Jobs ***** */
    //index
    public function getJobs(Request $request) {
    	if($request -> has('s')) {
        	$objs = $this -> returnSearchObj('jobs', $request->input('s'));
            return view('dbd_jobs.jobs', ['objs'=>$objs[0], 'searchStr' => $objs[1]]);
        }
    	else {
    		$objs = $this -> job -> orderBy('created_at','desc') ->paginate($this->pg);
        	return view('dbd_jobs.jobs')->with(compact('objs'));
        }
    }
    //Jobs add
    public function getJobsAdd() {
    	$slug = 'jobs';
        return view('dbd_jobs.jobform', ['slug'=>$slug]);
    }
    
    public function postJobsAdd(Request $request) {
    	$rules = [
            'company_name' => 'required',
            'sub_title' => 'required',
        ];
        $this->validate($request, $rules);
        

    	$data = $request->all(); //requestから配列として$dataにする
        $data['job_number'] = mt_rand(600000, 999999);
        $this->job->fill($data); //モデルにセット
        $this->job->save(); //モデルからsave
        
        $id = $this->job->id;
        
    	return redirect('dashboard/jobs-edit/'."$id")->with('status', '案件が追加されました！');
    }
    
    //Jobs Edit
    public function getJobsEdit($id) {
    	$article = $this->job->find($id);
        
        //$bytes = random_bytes(5);
		//$bytes = bin2hex(mt_rand());
        $bytes = md5(uniqid(rand(), TRUE));
        session(['del_key' => $bytes]);
        
        return view('dbd_jobs.jobform', compact('article'));
    }

    public function postJobsEdit(Request $request, $id) {
        $rules = [
            'company_name' => 'required',
            'sub_title' => 'required',
        ];
        $this->validate($request, $rules);
    
    	$article = $this->job->find($id);
        $data = $request->all(); //$data:配列
        if(!isset($data['closed'])) {
        	$data['closed'] = '公開中';
        }
        $article->fill($data);
        $article->save();
        
        //print_r($data);
        return redirect('dashboard/jobs-edit/'.$id)->with('status', '案件情報が更新されました！');
    }
    
    //応募者一覧
    public function getJobsEntry(Request $request, $job_id = null) {
    	if($request -> has('s')) {
        	$objs = $this -> returnSearchObj('jobentries', $request->input('s'));
            return view('dbd_jobs.jobEntry', ['objs'=>$objs[0], 'searchStr' => $objs[1]]);
        }
    	else {
            if(isset($job_id)) {
            	$job = $this->job->find($job_id);
                $job_name = $job->company_name;
                
                $objs = $job -> jobentry()->paginate($this->pg);
                
                return view('dbd_jobs.jobEntry', ['objs'=>$objs, 'job_name'=>$job_name]);
            }
            else {
                $objs = Jobentry::paginate($this->pg);
                return view('dbd_jobs.jobEntry', ['objs'=>$objs]);
            }
        }
    }
    
    
    /* Topics ***** */
    //index
    //aaa 
    //
    //
    public function getTopics(Request $request) {
    	if($request -> has('s')) {
        	$objs = $this -> returnSearchObj('topics', $request->input('s'));
            return view('dbd_pages.pages', ['objs'=>$objs[0], 'searchStr' => $objs[1]]);
        }
    	else {
    		$objs = $this -> topic -> orderBy('created_at','desc') ->paginate($this->pg);
        	return view('dbd_pages.pages')->with(compact('objs'));
        }
    }
    //topics add
    public function getTopicsAdd() {
    	$slug = 'topics';
        return view('dbd_topics.topicform', ['slug'=>$slug]);
    }
    
    public function postTopicsAdd(Request $request) {
    	$rules = [
            'title' => 'required',
            'sub_title' => 'required',
        ];
        $this->validate($request, $rules);
        

    	$data = $request->all(); //requestから配列として$dataにする
        $this->topic->fill($data); //モデルにセット
        $this->topic->save(); //モデルからsave
        
        $id = $this->topic->id;
        
    	return redirect('dashboard/topics-edit/'."$id")->with('status', 'トピックスが追加されました！');
    }
    
    //Topics Edit
    public function getTopicsEdit($id) {
    	$article = $this->topic->find($id);
        
        //$bytes = random_bytes(5);
		//$bytes = bin2hex(mt_rand());
        $bytes = md5(uniqid(rand(), TRUE));
        session(['del_key' => $bytes]);
        
        return view('dbd_topics.topicform', compact('article'));
    }

    public function postTopicsEdit(Request $request, $id) {
    	$rules = [
            'title' => 'required',
            'sub_title' => 'required',
        ];
        $this->validate($request, $rules);
    
    	$article = $this->topic->find($id);
        $data = $request->all(); //$data:配列
        if(!isset($data['closed'])) {
        	$data['closed'] = '公開中';
        }
        $article->fill($data);
        $article->save();
        
        //print_r($data);
        return redirect('dashboard/topics-edit/'.$id)->with('status', 'トピックスが更新されました！');
    }
    
    
    /* Iroha *************** */
    //index
    public function getIrohas(Request $request) {
    	if($request -> has('s')) {
        	$objs = $this -> returnSearchObj('irohas', $request->input('s'));
            return view('dbd_pages.pages', ['objs'=>$objs[0], 'searchStr' => $objs[1]]);
        }
    	else {
    		$objs = $this -> iroha -> where('slug', 'irohas') -> orderBy('created_at','desc') ->paginate($this->pg);
        	return view('dbd_pages.pages')->with(compact('objs'));
        }
    }
    //topics add
    public function getIrohasAdd() {
    	$slug = 'irohas';
        return view('dbd_irohas.irohaform', ['slug'=>$slug]);
    }
    
    public function postIrohasAdd(Request $request) {
    	$rules = [
            'title' => 'required',
            'sub_title' => 'required',
            //'url_name' => 'required|not_in:top|unique:irohas',
        ];
        $this->validate($request, $rules);
        

    	$data = $request->all(); //requestから配列として$dataにする
        $this->iroha->fill($data); //モデルにセット
        $this->iroha->save(); //モデルからsave
        
        $id = $this->iroha->id;
        
    	return redirect('dashboard/irohas-edit/'."$id")->with('status', 'いろはが追加されました！');
    }
    
    //Irohas Edit
    public function getIrohasEdit($id) {
    	$article = $this->iroha->find($id);
        
        //$bytes = random_bytes(5);
		//$bytes = bin2hex(mt_rand());
        $bytes = md5(uniqid(rand(), TRUE));
        session(['del_key' => $bytes]);
        
        return view('dbd_irohas.irohaform', compact('article'));
    }

    public function postIrohasEdit(Request $request, $id) {
        $rules = [
            'title' => 'required',
            'sub_title' => 'required',
            //'url_name' => $article->url_name!='top' ? 'required|not_in:top|unique:irohas': 'in:top',
        ];
        $this->validate($request, $rules);
        
        $article = $this->iroha->find($id);
        $data = $request->all(); //$data:配列
        if(!isset($data['closed'])) {
        	$data['closed'] = '公開中';
        }
        $article->fill($data);
        $article->save();
        
        //print_r($data);
        return redirect('dashboard/irohas-edit/'.$id)->with('status', 'いろはが更新されました！');
    }
    
    /* Iroha Study ******************* */
    //index
    public function getStudy(Request $request) {
    	if($request -> has('s')) {
        	$objs = $this -> returnSearchObj('study', $request->input('s'));
            return view('dbd_irohas.irohas', ['objs'=>$objs[0], 'searchStr' => $objs[1]]);
        }
    	else {
    		$objs = $this -> iroha -> where('slug', 'study') -> orderBy('created_at','desc') ->paginate($this->pg);
        	return view('dbd_irohas.irohas')->with(compact('objs'));
        }
    }
    //study add
    public function getStudyAdd() {
    	$slug = 'study';
        return view('dbd_irohas.irohaform', ['slug'=>$slug]);
    }
    
    public function postStudyAdd(Request $request) {
    	$rules = [
            'title' => 'required',
            'sub_title' => 'required',
        ];
        $this->validate($request, $rules);
        

    	$data = $request->all(); //requestから配列として$dataにする
        $this->iroha->fill($data); //モデルにセット
        $this->iroha->save(); //モデルからsave
        
        $id = $this->iroha->id;
        
    	return redirect('dashboard/study-edit/'."$id")->with('status', '勉強会が追加されました！');
    }
    
    //Study Edit
    public function getStudyEdit($id) {
    	$article = $this->iroha->find($id);
        
        //$bytes = random_bytes(5);
		//$bytes = bin2hex(mt_rand());
        $bytes = md5(uniqid(rand(), TRUE));
        session(['del_key' => $bytes]);
        
        return view('dbd_irohas.irohaform', compact('article'));
    }

    public function postStudyEdit(Request $request, $id) {
    	$rules = [
            'title' => 'required',
            'sub_title' => 'required',
        ];
        $this->validate($request, $rules);
    
    	$article = $this->iroha->find($id);
        $data = $request->all(); //$data:配列
        if(!isset($data['closed'])) {
        	$data['closed'] = '公開中';
        }
        $article->fill($data);
        $article->save();
        
        //print_r($data);
        return redirect('dashboard/study-edit/'.$id)->with('status', '勉強会が更新されました！');
    }
    
    //study user
    public function getStudyEntry(Request $request, $iroha_id = null) {
    	if($request -> has('s')) {
        	$objs = $this -> returnSearchObj('studyentries', $request->input('s'));
            return view('dbd_irohas.studyEntry', ['objs'=>$objs[0], 'searchStr' => $objs[1]]);
        }
    	else {
            if(isset($iroha_id)) {
                $study_name = $this->iroha->find($iroha_id)->title;
                
                $objs = Studyentry::where('iroha_id',$iroha_id)->paginate($this->pg);
                
                return view('dbd_irohas.studyEntry', ['objs'=>$objs, 'study_name'=>$study_name]);
            }
            else {
                $objs = Studyentry::paginate($this->pg);
                return view('dbd_irohas.studyEntry', ['objs'=>$objs]);
            }
        }
    }
    
    
    
    /* Blogs ************************************* */
    //index
    public function getBlog(Request $request) {
    	if($request -> has('s')) {
        	$objs = $this -> returnSearchObj('blogs', $request->input('s'));
            return view('dbd_pages.pages', ['objs'=>$objs[0], 'searchStr' => $objs[1]]);
        }
        else {
    		$objs = $this -> blog -> orderBy('created_at','desc') ->paginate($this->pg);
        	return view('dbd_pages.pages') -> with(compact('objs'));
        }
    }
    //blogs add
    public function getBlogAdd() {
    	$slug = 'blog';
        $cateObj = $this -> cate-> orderBy('created_at','desc')->get();
        
        return view('dbd_blogs.blogform', ['slug'=>$slug, 'cateObj'=>$cateObj]);
    }
    
    public function postBlogAdd(Request $request) {
    	$rules = [
            'title' => 'required',
            'sub_title' => 'required',
        ];
        $this->validate($request, $rules);
        

    	$data = $request->all(); //requestから配列として$dataにする
        if(isset($data['category'])) {
            $cateAry = $data['category'];
            $data = array_except($data, ['category']);
            //$data['category'] = implode(';', $data['category']); //配列のままfill()するとエラーになるので連結する
            
            //cate_relation DBへの追加
            foreach($cateAry as $val) {
                $this -> cateRelation -> insert(['blog_id'=>$id, 'cate_id'=>$val]);
            }
        }
        
        $this->blog->fill($data); //モデルにセット
        $this->blog->save(); //モデルからsave
        
        $id = $this->blog->id;
        
        
        
    	return redirect('dashboard/blog-edit/'."$id")->with('status', 'ブログが追加されました！');
    }
    
    //Blogs Edit
    public function getBlogEdit($id) {
    	$article = $this->blog->find($id);
        $cateObj = $this -> cate-> orderBy('created_at','desc')->get();
        
        $bytes = md5(uniqid(rand(), TRUE));
        session(['del_key' => $bytes]);
        
        //リレーションのオブジェクトを取得
        $rels = Blog::find($id)->cateRelation; //Blogモデル内でhasManyメソッドを指定すると取得可能となる
//        foreach($rels as $rel) {
//        	echo $rel->cate_id;
//        }

        return view('dbd_blogs.blogform', ['article'=>$article, 'cateObj'=>$cateObj, 'rels'=>$rels]);
    }

    public function postBlogEdit(Request $request, $id) {
    	$rules = [
            'title' => 'required',
            'sub_title' => 'required',
        ];
        $this->validate($request, $rules);
    
    	$article = $this->blog->find($id);
        $data = $request->all(); //$data:配列
        if(isset($data['category'])) {
            $cateAry = $data['category'];
            $data = array_except($data, ['category']); //配列のままfill()するとエラーになるので削除
            
            //一旦データを削除
            CateRelation::where('blog_id', $id) -> delete(); //cate_relation table内で重複するので一回データを全て消す
            
            //cate_relation tableへの追加
            foreach($cateAry as $val) {
                $this -> cateRelation -> insert([
                							'blog_id'=>$id,
                                            'cate_id'=>$val,
                                            'created_at' => date('Y-m-d H:i:s'),
                                            'updated_at' => date('Y-m-d H:i:s'),
                                            ]);
            }
        }
        else { //カテゴリーのチェック選択がない場合
        	CateRelation::where('blog_id', $id) -> delete();
        }
        
        if(!isset($data['closed'])) {
        	$data['closed'] = '公開中';
        }
        
        $article->fill($data);
        $article->save();
        
        return redirect('dashboard/blog-edit/'.$id)->with('status', 'ブログが更新されました！');
    }
    
    
    /* Category ************************************* */
    //index
//    public function getCategory() {
//    	$objs = $this -> cate -> orderBy('created_at','desc') ->paginate(20);
//        return view('dbd_cates.index') -> with(compact('objs'));
//    }
    //blogs add
    public function getCategory(Request $request) {
    	$bytes = md5(uniqid(rand(), TRUE));
        session(['del_key' => $bytes]);
    
    	if($request -> has('s')) {
        	$objs = $this -> returnSearchObj('cates', $request->input('s'));
            return view('dbd_cates.index', [ 'objs'=>$objs[0], 'searchStr' => $objs[1] ]);
        }
        else {
    		$objs = $this -> cate -> orderBy('created_at','desc') ->paginate($this->pg);
        	return view('dbd_cates.index', ['objs'=>$objs]);
        }
    }
    
    public function postCategoryAdd(Request $request) {
    	$rules = [
            'c_name' => 'required|max:255',
            'slug' => 'required|max:255|unique:cates',
        ];
        $this->validate($request, $rules);
        
    	$data = $request->all(); //requestから配列として$dataにする
        $this->cate->fill($data); //モデルにセット
        $this->cate->save(); //モデルからsave
        
        $name = $this->cate->c_name;
        
    	return redirect('dashboard/category')->with('status', 'カテゴリー「'.$name.'」が追加されました！');
    }
    
    //Blogs Edit
    public function getCategoryEdit($id) {
    	$article = $this->cate->find($id);
        
        //$bytes = random_bytes(5);
		//$bytes = bin2hex(mt_rand());
        $bytes = md5(uniqid(rand(), TRUE));
        session(['del_key' => $bytes]);
        
        return view('dbd_cates.index', compact('article'));
    }

    public function postCategoryEdit(Request $request, $id) {
    	$rules = [
        	'c_name' => 'required|max:255',
            'slug' => 'required|max:255|unique:cates,slug,'.$id,
        ];
        $this->validate($request, $rules);
        
    	$article = $this->cate->find($id);
        $data = $request->all(); //$data:配列
        $article->fill($data);
        $article->save();
        
        $name = $article->c_name;
        
        //print_r($data);
        return redirect('dashboard/category')->with('status', 'カテゴリー「'.$name.'」が編集されました！');
        //return redirect('dashboard/category-edit/'.$id)->with('status', 'カテゴリーが更新されました！');
    }
    
    public function postCategoryDel(Request $request) {
        $id = $request -> input('cate_id');
        $delObj = $this->cate->find($id);
        
        $del_key = $request->input('del_key');
        
        if($del_key == session('del_key')) {
        	$name = $delObj->c_name;
            $delObj->delete();
            session() -> forget('del_key');
            
            return redirect('/dashboard/category')->with('del_status', 'カテゴリー「'.$name.'」が削除されました！');
        }
        else { //session 不一致
            echo "Invalid Access: 1103<br />カテゴリーの削除出来ません。<br /><a href='/dashboard'>Dashboard Topへ戻る</a>";
        }
        
//        $data = $request->all(); //$data:配列
//        $article->fill($data);
//        $article->save();
        
        //print_r($data);
        //return redirect('dashboard/category')->with('status', 'カテゴリーが削除されました！');
        //return redirect('dashboard/category-edit/'.$id)->with('status', 'カテゴリーが更新されました！');
    }

    
    
    
    
    
    //Images Edit
    public function getImages() {
    	$pages = $this -> page -> orderBy('created_at','desc') ->paginate(5);
        return view('dashboard.image')->with(compact('pages'));
    }
    //Images add
    public function getImagesAdd() {
    	$pages = $this -> page -> orderBy('created_at','desc') ->paginate(30);
        return view('dashboard.dataform')->with(compact('pages'));
    }
    
    public function postImagesAdd(Request $request) {
    	$rules = [
            'title' => 'required',
        ];
        $this->validate($request, $rules);
        

    	$data = $request->all(); //requestから配列として$dataにする
        $this->page->fill($data); //モデルにセット
        $this->page->save(); //モデルからsave
        
        $id = $this->page->id;
        
    	return redirect()->to('dashboard/pages-edit/'."$id");
    }
    
    
    
    //Admin新規登録
    public function getRegister() {
    	$users = User::where('admin',99) -> get();
        
        $bytes = md5(uniqid(rand(), TRUE));
        session(['ad_del' => $bytes]);
        
    	return view('dashboard.register', ['users'=>$users]);
    }
    
    public function postRegister(Request $request) {
    	$rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ];
        $this->validate($request, $rules);

    	$data = $request->all(); //requestから配列として$dataにする
        
        //Save&手動ログイン：以下でも可 :Eroquent ORM database/seeds/UserTableSeeder内にもあるので注意
		$user = User::create([ 
            'name' => $data['name'],
			'email' => $data['email'],
			'password' => bcrypt($data['password']),
            'is_trip' => '出張可能',
            'user_number' => 59999,
            'admin' => 99,
		]);
        
        if(isset($data['notice_pass'])) {
            Mail::send('emails.adminRegister', $data, function($message) use ($data) {
                //$message->from($data['info']->site_email, 'Woman x Auditor');
                $message->to($data['email'], $data['name'])->subject('【woman x auditor】管理者として登録されました。');
            });
        }
        //$this->admin->login($user); < 効かない
        //Auth::login($user); 管理者権限がある上で追加するので自動ログインはさせない
        $users = User::where('admin',99) -> get();
        return view('dashboard.register', ['users'=>$users, 'status'=>'管理者:'.$data['name'].'さんが追加されました。']);
    	//return redirect('/dashboard/register', compact('users'));
    
    }
    
    //Admin Delete
    public function postAdminDel(Request $request) {
        $id = $request -> input('ad_id');
        
        $delObj = User::find($id);
        $admin = $delObj->name;
        
        $del_key = $request->input('ad_del');
        
        if($del_key == session('ad_del')) {
            $delObj->delete();
            session() -> forget('ad_del');
            
            return redirect('dashboard/register')->with('ad_stat', '管理者:'.$admin.'さんが削除されました！');
        }
        else { //session 不一致
            echo "Invalid Access: 1103<br />カテゴリーの削除が出来ません。<br /><a href='/dashboard'>Dashboard Topへ戻る</a>";
        }
    }
    
    
    
    
    
    //User情報
    public function getUserinfo(Request $request) {
    	if($request -> has('s')) {
        	$users = $this -> returnSearchObj('users', $request->input('s'));
            return view('dashboard.userinfo', [ 'objs'=>$users[0], 'searchStr' => $users[1] ]);
        }
        else {
    		$objs = User::whereNotIn('admin', [99]) -> paginate($this->pg);
    		return view('dashboard.userinfo', compact('objs'));
        }
    }
    
    // User Profile
    public function getShowProfile($id) {
    	$user = User::find($id);
        
        $jobObjs = $user -> jobentries;
        $studyObjs = $user -> studyentries;
        
        //response()->download($jobObjs->find(1)->attach_path);
        function str2ascii($str, $delim = ' ') { //確か、全角文字を半角に変える関数だったか。File DownLoad用
            $result = '';
            $len = strlen($str);
            $i = 0;
            while (($char = substr($str, $i++, 1)) !== false) {
                if ($i > 1) {
                    $result .= $delim;
                }
                $result .= sprintf('%X', ord($char));
            }
            return $result;
        }
        
        
        //return response()->download('images/temps/11804/'. mb_convert_kana($jobObjs->find(1)->attach_name) );
        
//        return response('')
//        	->header('Content-Type', 'application/force-download')
//            ->header('Content-Length', filesize($jobObjs->find(1)->attach_path))
//            //->header('Content-Transfer-Encoding', 'binary')
//			->header('Content-disposition', 'attachment; filename="'. $jobObjs->find(1)->attach_name .'"');
//
//			readfile($jobObjs->find(1)->attach_path);
        
        return response()->view('dashboard.usersingle', ['user'=>$user, 'jobObjs'=>$jobObjs, 'studyObjs'=>$studyObjs]);
    }
    
    
    //SiteInfo
    public function getSiteinfo() {
    	$article = Siteinfo::first();
        return view('dashboard.siteinfo', compact('article'));
    }
    
    public function postSiteinfo(Request $request) {
    	$rules = [
            //'title' => 'required|min:3',
        ];
        $this->validate($request, $rules);
        

    	$data = $request->all(); //requestから配列として$dataにする
        
        if(!isset($data['seo_sw'])) {
        	$data['seo_sw'] = 0;
        }
        
        if($info = Siteinfo::find($request->input('id')) ) {
        	$info -> update($data);
        }
        else {
        	$this -> siteinfo ->fill($data); //モデルにセット
        	$this -> siteinfo ->save(); //モデルからsave
        }
        
        
        //$id = $this->page->id;
        
    	return redirect('dashboard/siteinfo') -> with('status', 'サイト情報が更新されました');
    }
    
    
    //Logout
    public function getLogout() {
    	Auth::logout();
        return redirect('/dashboard/login');
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
