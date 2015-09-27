@extends('app')

	@section('content')
    	<ul class="breadcrumb">
            <li><a href="{{getUrl('/')}}"><span class="octicon octicon-home"></span>Home</a></li>
            <li><a href="{{getUrl('iroha')}}">監査役いろは</a></li>
            <li>@if($obj->sub_title != ''){{$obj->sub_title}}
            @else{{$obj->title}}@endif</li>
        </ul>

        <article class="page-ct{{" ".$obj->url_name}}">
            <header>
                <h1 class="main-title">{{ $obj->title}}</a></h1>
            </header>
            @if($obj->intro_content != '')
                <section class="intro-ct">
                	<p>{!! nb($obj->intro_content) !!}</p>
                    
                </section>
            @endif
            
            <section class="main-ct iroha-child">
            	
                {!! $obj->main_content !!}
            </section>
            
            @if($obj->sub_content != '')
                <footer class="sub-ct">
                	{!! $obj->sub_content !!}
                </footer>
            @endif
        </article>
    
    	{{--
        <ul>
        @if(isset($links))
        @foreach($links as $link)
            <li><a href="{{getUrl('iroha/'.$link)}}">{{$link}}</a></li>
        @endforeach
        @endif
        
            <li><a href="{{getUrl('iroha/study')}}">監査役勉強会一覧</a></li>
        </ul>
        --}}
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

