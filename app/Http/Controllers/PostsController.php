<?php

namespace App\Http\Controllers;

use App\Post;

use Mail;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PostsController extends Controller
{
	protected $post;
    
    public function __construct(Post $post) {
    	$this -> post = $post;
    }
    
    public function getIndex()
    {
    	$all_posts = $this -> post -> orderBy('created_at','desc') ->paginate(5);
        return view('posts.index', compact('all_posts'));
    }




//	public function getContact() {
//    	return view('posts.contact');
//    }
//    
//    public function postContact(Request $request) { //ORG:postIndex
//    
//    	$rules = [
//            'name' => 'required',
//            'mail' => 'required',
//        ];
//        $this->validate($request, $rules);
//        
//		$datas = $request->all(); //requestから配列として$dataにする
//        
//        return view('posts.confirm')-> with(compact('datas')); //配列なので、view遷移後はdatas[name]で取得する
//        //return redirect()->to('confirm');
//	}
//    
//    
//    /* Mail function ********* */
//    public function postFinish(Request $request) {
//    	$data = $request->all();
//        //$this->reservation->fill($data); //モデルにセット
//        //$this->reservation->save(); //モデルからsave
//        $mailAdd = $data['mail'];
//		//mail action
//        Mail::send('emails.welcome', $data, function($message) use ($data) //引数について　http://readouble.com/laravel/5/1/ja/mail.html
//        {
//        	//$dataは連想配列としてメールテンプレviewに渡され、その配列のkey名を変数（$name $mailなど）としてview内で取得出来る
//            $message->to($data['mail'], $data['name'])->subject('予約が完了しました');
//            
//            //$message->attach($pathToFile);
//        });
//        
//        return view('posts.finish');
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
