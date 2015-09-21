@extends('app')

	@section('content')
    	<ul class="breadcrumb">
            <li><a href="{{getUrl('/')}}"><span class="octicon octicon-home"></span>Home</a></li>
            <li>監査役いろは</li>
        </ul>

        <article class="page-ct{{" ".Request::path()}}">
            <header>
                <h1 class="main-title">{{ $obj->title}}</a></h1>
            </header>
            
            @if($obj->intro_content != '')
                <section class="intro-ct">
                	<p>{!! nb($obj->intro_content) !!}</p>
                </section>
            @endif
            
            <section class="main-ct">	
                {{-- $obj->main_content --}}
               
                <ul>
                	<li><a href="#"><span class="octicon octicon-chevron-right"></span>監査役とは</a>
                    <li><a href="#"><span class="octicon octicon-chevron-right"></span>監査役の責任</a>
                    <li><a href="#"><span class="octicon octicon-chevron-right"></span>監査役の働き方</a>
                    <li><a href="#"><span class="octicon octicon-chevron-right"></span>監査役に求められる役割</a>
                    <li><a href="#"><span class="octicon octicon-chevron-right"></span>監査等委員会設置会社及び指名委員会等設置会社</a>
                    <li><a href="#"><span class="octicon octicon-chevron-right"></span>世界の監査役事情</a>
                    <li><a href="#"><span class="octicon octicon-chevron-right"></span>管理者ブログからのピックアップ</a>
                </ul>
                
                <div>
                    <h2><span class="octicon octicon-repo"></span>監査役とは</h2>
                    <span><span class="octicon octicon-arrow-right"></span>監査役の定義や任期等、基本的な情報をお伝えします</span>
                    <p>・監査役とは<br>監査役とは××××
                    <br>・選任・解任・任期	
                    <br>××××</p>
                </div>
                
                <div>
                    <h2><span class="octicon octicon-repo"></span>監査役の責任</h2>
                    <span><span class="octicon octicon-arrow-right"></span>監査役にどんな責任が課せられているのか解説します</span>
                    <p>・監査役とは<br>監査役とは××××
                    <br>・選任・解任・任期	
                    <br>××××</p>
                </div>
                
                <div>
                    <h2><span class="octicon octicon-repo"></span>監査役の働き方</h2>
                    <span>監査役がどんな働き方をしているかを知って、自分に置き換えて想像してみましょう</span>
                    <p>・監査役とは<br>監査役とは××××
                    <br>・選任・解任・任期	
                    <br>××××</p>
                </div>
                
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

