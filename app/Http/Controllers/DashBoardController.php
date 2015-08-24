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
use Auth;
use DB;
use Storage;
use Mail;

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
        
        $this -> val = ''; //検索ワードを入れる（whereのクロージャ用）
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
    	//$switch = false;
    	
        if(Auth::user()->admin != 99) { //Admin以外はアクセス不可
            echo "アクセス出来ません<br />Not Admin<a href=\"/\">BACK</a>";
        }
        else {
        	$userObjs = User::where('admin', 10)->orderBy('created_at', 'desc') -> take(5) -> get();
            $jobObjs = Job::orderBy('created_at', 'desc') -> take(5) -> get();
            return view('dashboard.index', ['userObjs'=>$userObjs, 'jobObjs'=>$jobObjs ]);
        }
    }
    
    public function returnSearchObj($table_name, $search) {
            
            if($table_name == 'irohas') 
            	$query = DB::table($table_name) ->where('slug', 'irohas');
            
            else if($table_name == 'study') 
            	$query = DB::table('irohas') ->where('slug', 'study');
            
            else 
            	$query = DB::table($table_name);
            
            //全角スペース時半角スペースに置き換える
            if( str_contains($search, '　')) {
            	$search = str_replace('　', ' ', $search);
            }
        	
            if(str_contains($search, ' ')) { //半角スペース AND検索
        		$searchs = explode(' ', $search);
                
                foreach($searchs as $val) {
                	$this->val = "%".$val."%";
                    
                    if($table_name == 'cates') {
                    	$query ->where( function($query) { //where節をクロージャにした時に引数は1つまで。更にglobal変数が効かない
                            $query ->where('c_name', 'like', $this->val)
                                	->orWhere('slug', 'like', $this->val);
                        });
                    }
                    elseif($table_name == 'studyentries') {
                    	$query ->where('user_name', 'like', $this->val)
                                ->orWhere('user_mail', 'like', $this->val)
                                ->orWhere('iroha_id', 'like', $this->val)
                                ->orWhere('study_name', 'like', $this->val)
                                ->orWhere('note', 'like', $this->val);
                                //->orWhere('created_at', 'like', $this->val);
                    }
                    else {
                        $query ->where(function($query) { 
                            $query ->where('title', 'like', $this->val)
                                    ->orWhere('sub_title', 'like', $this->val)
                                    ->orWhere('intro_content', 'like', $this->val)
                                    ->orWhere('main_content', 'like', $this->val)
                                    ->orWhere('sub_content', 'like', $this->val);
                        });
                    }//else
                }
            }
            else { //1word検索
            	$this->val = "%".$search."%";
                
                if($table_name == 'cates') {
                    $query ->where( function($query) { 
                        $query ->where('c_name', 'like', $this->val)
                                ->orWhere('slug', 'like', $this->val);
                    });
                }
                elseif($table_name == 'studyentries') {
                    $query ->where('user_name', 'like', $this->val)
                            ->orWhere('user_mail', 'like', $this->val)
                            ->orWhere('iroha_id', 'like', $this->val)
                            ->orWhere('study_name', 'like', $this->val)
                            ->orWhere('note', 'like', $this->val);
                            //->orWhere('created_at', 'like', $this->val);
                }
                else {
            		$query -> where(function($query) {
                        $query -> where('title', 'like', $this->val)
                               -> orWhere('sub_title', 'like', $this->val)
                               -> orWhere('intro_content', 'like', $this->val)
                               -> orWhere('main_content', 'like', $this->val)
                               -> orWhere('sub_content', 'like', $this->val);
                    });
                }//else
            }
            
            //$count = $query->count();
            $pages = $query->paginate($this->pg);
            $pages -> appends(['s' => $search]);
            
            return [$pages, $search];
    }
    
    
    
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
            'title' => 'required|min:3',
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
    	$article = $this->page->find($id);
        $data = $request->all(); //$data:配列
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
        	echo "Invalid Access: 1100<br />削除出来ません。<br /><a href='/dashboard'>Dashboard Topへ戻る</a>";
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
            $title = $delObj -> title;
        
            if($data['del_key'] == session('del_key')) {
                $delObj->delete();
                session() -> forget('del_key');
                
                return redirect('/dashboard/'.$p_type) -> with('status', '『' .$title.'』が削除されました。');
            }
            else { //session 不一致
                echo "Invalid Access: 1102<br />削除出来ません。<br /><a href='/dashboard'>Dashboard Topへ戻る</a>";
            }
        }
        else { //POST[t]値が無い
        	echo "Invalid Access: 1101<br />削除出来ません。<br /><a href='/dashboard'>Dashboard Topへ戻る</a>";
        }
    }
    
    
    
    /* Topics ***** */
    //index
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
            'title' => 'required|min:3',
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
    	$article = $this->topic->find($id);
        $data = $request->all(); //$data:配列
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
            'title' => 'required|min:3',
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
    	$article = $this->iroha->find($id);
        $data = $request->all(); //$data:配列
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
            return view('dbd_pages.pages', ['objs'=>$objs[0], 'searchStr' => $objs[1]]);
        }
    	else {
    		$objs = $this -> iroha -> where('slug', 'study') -> orderBy('created_at','desc') ->paginate($this->pg);
        	return view('dbd_pages.pages')->with(compact('objs'));
        }
    }
    //study add
    public function getStudyAdd() {
    	$slug = 'study';
        return view('dbd_irohas.irohaform', ['slug'=>$slug]);
    }
    
    public function postStudyAdd(Request $request) {
    	$rules = [
            'title' => 'required|min:3',
        ];
        $this->validate($request, $rules);
        

    	$data = $request->all(); //requestから配列として$dataにする
        $this->iroha->fill($data); //モデルにセット
        $this->iroha->save(); //モデルからsave
        
        $id = $this->iroha->id;
        
    	return redirect('dashboard/irohas-edit/'."$id")->with('status', '勉強会が追加されました！');
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
    	$article = $this->iroha->find($id);
        $data = $request->all(); //$data:配列
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
            'title' => 'required|min:3',
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
            'slug' => 'required|min:3|max:255|unique:cates',
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
            'slug' => 'required|min:3|max:255|unique:cates,slug,'.$id,
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
            'title' => 'required|min:3',
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
            'password' => 'required|confirmed|min:5',
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
    
    
    //User Search
    protected function returnSearchUser($table_name, $input_s) {

        	$search = $input_s;
            
            $query = DB::table($table_name)->whereNotIn('admin',[99]);
        	
            if(str_contains($search, ' ')) {
        		$searchs = explode(' ', $search);
                
                foreach($searchs as $val) {
                	
                	$this->val = "%".$val."%";
                	$query ->where(function($query){
                				$query ->where('name', 'like', $this->val)
                                        ->orWhere('email', 'like', $this->val)
                                        ->orWhere('user_number', 'like', $this->val)
                                        //->orWhere('birth', 'like', $this->val)
                                        ->orWhere('address', 'like', $this->val)
                                        ->orWhere('work_history', 'like', $this->val)
                                        ->orWhere('office_posi', 'like', $this->val)
                                        ->orWhere('is_trip', 'like', $this->val)
                                        ->orWhere('eng_ability', 'like', $this->val)
                                        ->orWhere('get_year', 'like', $this->val)
                                        ->orWhere('exp_type', 'like', $this->val)
                                        ->orWhere('audit_posi', 'like', $this->val);
                            });

                }
                //$pages = $this->page->whereIn('title', $search) ->paginate(20);
            }
            else {
            	$this->val = "%".$search."%";
                
            	$query ->where(function($query){
                            $query->where('name', 'like', $this->val)
                                ->orWhere('email', 'like', $this->val)
                                ->orWhere('user_number', 'like', $this->val)
                                //->orWhere('birth', 'like', $this->val)
                                ->orWhere('address', 'like', $this->val)
                                ->orWhere('work_history', 'like', $this->val)
                                ->orWhere('office_posi', 'like', $this->val)
                                ->orWhere('is_trip', 'like', $this->val)
                                ->orWhere('eng_ability', 'like', $this->val)
                                ->orWhere('get_year', 'like', $this->val)
                                ->orWhere('exp_type', 'like', $this->val)
                                ->orWhere('audit_posi', 'like', $this->val);
                        });
            }
            
            
            $pages = $query ->paginate($this->pg);
            $pages -> appends(['s' => $search]);
            
            return [$pages, $search];
            //return $s_pages;
    	
    }
    
    
    //User情報
    public function getUserinfo(Request $request) {
    	if($request -> has('s')) {
        	$users = $this -> returnSearchUser('users', $request->input('s'));
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
        function str2ascii($str, $delim = ' ') {
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
