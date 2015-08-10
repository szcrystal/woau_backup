<?php

namespace App\Http\Controllers;

use App\Page;
use App\Topic;
use App\Siteinfo;

use Mail;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;


class PageController extends Controller
{
	protected $page;
    
    public function __construct(Page $page, Topic $topic, Siteinfo $siteinfo) {
    	$this -> page = $page;
        $this -> topic = $topic;
        //$this -> in = array('name','mail','note'); //contact input name=""のkey
        
        $this -> pg = $siteinfo->first()->value('show_count');
    }
    
    public function getIndex()
    {
    	//$pages = $this -> page -> orderBy('created_at','desc') ->paginate(5);
        $obj = Page::where('url_name', '') -> first();
        $topicObj = $this -> topic -> orderBy('created_at','desc') ->take(10) ->get();
        
        //$pages[]= compact('top');
        //$pages[] = compact('topixObj');
        
        return view('pages.index', ['obj'=>$obj, 'topicObj'=>$topicObj]); //['top'=>$top, 'topixObj'=>$topixObj]
        //return view('pages.index', compact('pages')); //配列を一つにして渡す場合 compact('pages')とする
    }

	
    // All Fix Page
    public function show(Request $request, $url_name) {
    	
    	if($url_name == 'contact') {
        	//$data = array('name','mail','note');
            /*
            foreach($this->in as $val) {
        		//$pageObjs[$key] = $val;
                $pageObjs[$val] = $request->session()->pull($val, '');
            }
            */
            //session()->forget(['name','mail','note']);
            return view('pages.contact')/* -> with(compact('pageObjs'))*/;
        }
        else {
        	$pageObj = Page::where('url_name', $url_name) -> first();
            return view('pages.page') -> with(compact('pageObj'));
        }

    }
    
    
    //Contact
//    public function getContact() {
//    	return view('pages.contact');
//    }
    
    public function postContact(Request $request) { //ORG:postIndex
    
    	//お問い合わせ最終ページの表示：Finish Page
    	if($request->input('end') == TRUE) { //ConfirmからのPOST送信時 送信or戻る
        	if( $request->input('_return') !== null ) { //戻るボタンを押した時
                return redirect('contact') -> withInput();
                //withInput: old()にデータを渡す（sessionで）>> http://laravel.com/docs/5.1/requests#old-input
            }
        	else { //最終ページ：Finish
                $data = $request->all();
                //$this->reservation->fill($data); //モデルにセット
                //$this->reservation->save(); //モデルからsave
                $data['info'] = Siteinfo::first();
                
                //mail action
                $data['is_user'] = 1;
                
                Mail::send('emails.contact', $data, function($message) use ($data) //引数について　http://readouble.com/laravel/5/1/ja/mail.html
                {
                    $message->from($data['info']->site_email, 'Woman x Auditor');
                    
                    //$dataは連想配列としてメールテンプレviewに渡され、その配列のkey名を変数（$name $mailなど）としてview内で取得出来る
                    $message->to($data['mail'], $data['name'])->subject('【woman x auditor】お問い合わせありがとうございます');
                    //$message->attach($pathToFile);
                });
                
                $data['is_user'] = 0;
                Mail::send('emails.contact', $data, function($message) use ($data)
                {
                    $message->from($data['info']->site_email, 'Woman x Auditor');
                    $message->to($data['info']->site_email, 'woman x auditor 管理者')->subject('【woman x auditor】お問い合わせがありました');
                });
                
                //session()->forget($this->in);
                return view('pages.finish');
            }
        }
    	else { //確認ページ：Confirm Page
            $rules = [
                'name' => 'required|max:255',
            	'mail' => 'required|email|max:255',
                'note' => 'max:500',
            ];
            $this->validate($request, $rules);
            
            $datas = $request->all(); //requestから配列として$dataにする
            
            foreach($datas as $key => $val) {
            	$arr[] = $key;
                //$request->session()->flash($key, $val);
                //$_SESSION[$key] = $val;
            }
            session($datas);
            //$request->session()->keep($arr);
            //'name', $datas['name']);
            return view('pages.confirm')-> with(compact('datas')); //配列なので、view遷移後はdatas[name]で取得する
            //return redirect()->to('confirm');
            
            
        }
	}
    
    public function getBack() {
    	return back();
    }
    
    
    /* Mail function ********* */
    public function postFinish(Request $request) {
    	$data = $request->all();
        //$this->reservation->fill($data); //モデルにセット
        //$this->reservation->save(); //モデルからsave
        $mailAdd = $data['mail'];
		//mail action
        Mail::send('emails.welcome', $data, function($message) use ($data) //引数について　http://readouble.com/laravel/5/1/ja/mail.html
        {
        	//$dataは連想配列としてメールテンプレviewに渡され、その配列のkey名を変数（$name $mailなど）としてview内で取得出来る
            $message->to($data['mail'], $data['name'])->subject('予約が完了しました');
            
            //$message->attach($pathToFile);
        });
        
        return view('pages.finish');
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
