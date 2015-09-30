@extends('app')

	@section('content')
    	<ul class="breadcrumb">
            <li><a href="{{getUrl('/')}}"><span class="octicon octicon-home"></span>Home</a></li>
            <li>ブログ</li>
        </ul>
    
    	<main class="page-ct blog">
        	<div class="main-head">
                <h1>
                @if(isset($title))
                {{ $title }}
                @else
                管理者ブログ
                @endif
                </h1>
            	<p>woman x auditor管理者のブログ</p>
            </div>
            
            <div id="primary">
            	<div class="clearfix">
            	{!! $objs->render() !!}
                </div>
            
            @foreach($objs as $blogObj)
            	<?php $path = Request::path() .'/'. $blogObj->id; ?>
                
                <article class="archive">
                    <header>
                    	<small>{!! getStrDate($blogObj->created_at, 'slash') !!}</small>
                        <span class="octicon octicon-quote"></span>
                        <h2><span class="octicon octicon-file-text"></span><a href="{{getUrl($path)}}">{{ $blogObj->title }}</a></h2>
                    </header>
                    
                    <div>
                    	@if($blogObj -> intro_content != '')
                            {!! readMoreContents($blogObj->intro_content, $path) !!}
                        @else
                            {!! readMoreContents($blogObj->main_content, $path) !!}
                        @endif
                    
                    </div>
                    
                    <footer>
                    {{--
                    	@if( ! App\Blog::find($blogObj->id)->cateRelation ->isEmpty())
                    --}}
                    
                    @include('shared.cate_list')
                    
                    </footer>
                </article>
            
            @endforeach
            
            {!! $objs->render() !!}
            
        </div>
        
        @include('shared.sidebar')

        
    </main>
  
    @endsection

