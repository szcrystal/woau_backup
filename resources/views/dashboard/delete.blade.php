@extends('appDashBoard')

@section('content')
	
    <p style="font-size: 1.2em;">
    @if($p_type== 'pages')
    	<span class="octicon octicon-book"></span>固定ページ
    @elseif($p_type== 'jobs')
    	<span class="octicon octicon-file-directory"></span>求人情報
    @elseif($p_type== 'topics')
    	<span class="octicon octicon-megaphone"></span>トピックス
    @elseif($p_type == 'irohas')
    	<span class="octicon octicon-repo"></span>監査役いろは
    @elseif($p_type== 'study')
    	<span class="octicon octicon-repo"></span>勉強会
    @elseif($p_type== 'blog')
    	<span class="octicon octicon-file-text"></span>ブログ
    @endif
    </p>
	<h2 class="sub-header">{{$article->title}}</h2>
    
    <p>{!! nb(str_limit(trim(strip_tags($article->main_content)), 170)) !!}</p>
    
	<div style="margin: 3em 0;">
    	
        <p>この記事を削除してもよろしいですか？</p>
    
    
    {!! Form::open() !!}
            
        {!! Form::hidden('del_key', session('del_key')) !!}
        {!! Form::hidden('t', $p_type) !!}
        
        <button type="submit" class="btn btn-danger">削　除</button>
        <a href="{{ getUrl('/dashboard/'.$p_type .'-edit/'. $article->id) }}" class="btn btn-default">キャンセル</a>
    
    
    {!! Form::close() !!}
    
    </div>


@endsection
