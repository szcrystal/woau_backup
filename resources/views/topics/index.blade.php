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
            
                <article class="archive">
                    <?php 
                        if(isset($obj->img_link)) {
                            $link = $obj->img_link; 
                            $linkArr = explode(';', $link);
                        }
                        //echo $linkArr[0];
                    ?>
                    <header>
                    	<small>{!! getStrDate($obj->created_at, 'slash') !!}</small>
                        <h2><a href="{{getUrl('topics/'.$obj->id)}}">{{ $obj->title }}</a></h2>
                    </header>
                    
                    <div>
                        @if($obj -> intro_content != '')
                            {!! $obj -> intro_content !!}
                        @else
                            {!! mb_substr(strip_tags($obj -> main_content), 0, 100) !!}
                        @endif
                        <a href="{{ getUrl('topics/'.$obj->id) }}" class="dots">・・・</a><br>
                        <a href="{{ getUrl('topics/'.$obj->id) }}" class="more">Read More »</a>
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

