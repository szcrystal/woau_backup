<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Topic;
use App\Siteinfo;

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
    	$topics = $this -> topic -> orderBy('created_at','desc') ->paginate($this->pg);
        return view('topics.index', ['topics'=>$topics]);
    }
    
    public function show($id) {
    	$topicObj = $this->topic -> find($id);
        return view('topics.single', compact('topicObj'));
        
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
