<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Topic;
use App\Siteinfo;
use Auth;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    
    protected $topic;
    
    public function __construct(Topic $topic, Siteinfo $siteinfo)
    {
        $this-> topic = $topic;
        $this -> pg = $siteinfo->first()->value('show_count');
    }
    
    
    public function getIndex() {
    	$topics = $this -> topic ->where('closed', '公開中') -> orderBy('created_at','desc') ->paginate($this->pg);
        $headTitle = 'トピックス一覧';
        return view('topics.index', ['topics'=>$topics, 'headTitle'=>$headTitle]);
    }
    
    public function show($id) {
    	if($topicObj = $this->topic -> find($id)) {
            if($topicObj->closed == '非公開' && (! Auth::user() || Auth::user()->admin != 99))
                abort(404);
            else
                return view('topics.single', compact('topicObj'));
        }
        else {
        	abort(404);
        }
            
    }
     
     
//    public function index()
//    {
//        
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
