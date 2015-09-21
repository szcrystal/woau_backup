@extends('app')

	@section('content')
    
    	<ul class="breadcrumb">
            <li><a href="{{getUrl('/')}}"><span class="octicon octicon-home"></span>Home</a></li>
            <li>トピックス一覧</li>
        </ul>
    
    	<main class="page-ct topics">
        	<div class="main-head clearfix">
        		<h1>トピックス一覧</h1>
    			<p>woman x auditorから最新のニュースをお伝えします。</p>
                {!! $topics->render() !!}
            </div>
            @foreach($topics as $obj)
            	<?php $path = Request::path() .'/'. $obj->id; ?>
                
                <article class="archive">
                    <header>
                    	<small>{!! getStrDate($obj->created_at, 'slash') !!}</small>
                        <h2><a href="{{getUrl($path)}}">{{ $obj->title }}</a></h2>
                    </header>
                    
                    <div>
                        @if($obj -> intro_content != '')
                            {!! readMoreContents($obj->intro_content, $path) !!}
                        @else
                            {!! readMoreContents($obj->main_content, $path) !!}
                        @endif
                        
                    </div>
                    
                    {{--
                    <footer>
                    {!! nb($obj -> sub_content) !!}
                    </footer>
                    --}}
                </article>
            
            @endforeach
            
            {!! $topics->render() !!}
        
        </main>
<?php
 /*  

		@if(isset($linkArr[0]))
        	<img src="{{ url($linkArr[1]) }}" />
        @endif
        

    	@foreach($pages as $page)
        	

        	<?php 
//            	$link = $page->img_link; 
//            	$linkArr = explode(';', $link);
//            	echo $linkArr[0];
            ?>
        
    		<article>
        		<h1><a href="{{url($page->url_name)}}">{{$page->title}}</a></h1>
                
                {{--
                @if(isset($linkArr[0]))
                	<img src="http://localhost:5010/{{$linkArr[0]}}" width="230" height="150" />
                @endif
                --}}
                
                <div>
                	{!! nb($page->content); !!} {{-- HTMLentity()のエスケープをさせない --}}
                </div>
                <div>
                	{!! nb($page->sub_content) !!}
                </div>
        	</article>
        
        @endforeach
    
    	<?php //echo $pages->render(); ?>
 */  
 ?>  
    @endsection

