<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Cate;
use App\CateRelation;
use App\Siteinfo;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{

	protected $blog;
    
    public function __construct(Blog $blog, Cate $cate, CateRelation $cateRelation, Siteinfo $siteinfo)
    {
    	$this->middleware('auth');
        $this-> blog = $blog;
        $this-> cate = $cate;
        $this -> cateRelation = $cateRelation;
        $this -> pg = $siteinfo->first()->value('show_count');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {
    	$objs = $this -> blog -> orderBy('created_at','desc') -> paginate($this->pg);
        //$objs = $this -> blog -> orderBy('created_at','desc') -> simplePaginate(3);
        $headTitle = '管理者ブログ';
        return view('blogs.index', ['objs'=>$objs, 'headTitle'=>$headTitle]);
    }
    
    public function show($post_id)
    {
    	$blogObj = $this -> blog -> find($post_id);
        return view('blogs.single', compact('blogObj'));
    }
    
    public function getCategory($slug) {
    	$cateObj = $this->cate->where('slug', $slug)->first();
        
        $relObjs = $cateObj->cateRelation; //リレーションメソッド
        
        foreach($relObjs as $relObj) {
        	$blog_ids[] = $relObj->blog_id;
        }
        
        $objs = $this->blog->whereIn('id', $blog_ids)->orderBy('created_at','desc') ->paginate($this->pg);
        
        $title = 'カテゴリー：'. $cateObj->c_name;

        return view('blogs.index', ['objs'=>$objs, 'title'=>$title]);
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
