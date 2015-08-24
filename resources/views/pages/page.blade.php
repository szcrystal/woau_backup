@extends('app')
{{-- Main top page (roop data) --}}

	@section('content')
    
    <ul class="breadcrumb">
    	<li><a href="{{getUrl('/')}}"><span class="octicon octicon-home"></span>Home</a></li>
        <li>{{$pageObj->title}}</li>
    </ul>

        	<?php 
//            	$link = $page->img_link; 
//            	$linkArr = explode(';', $link);
//            	echo $linkArr[0];
            ?>
        
    		<article class="page-ct{{" ".$pageObj->url_name}}">
            	@if(Request::is('about'))
                <h1 class="main-title">{{$pageObj->title}}</a></h1>
                @else
        		<h1>{{$pageObj->title}}</a></h1>
                @endif
                @if($pageObj->intro_content != '')
                <section class="intro-ct">
                	{!! $pageObj->intro_content !!} {{-- HTMLentity()のエスケープをさせない --}}
                </section>
                @endif
                
                <section class="main-ct">	
                	{!! $pageObj->main_content !!}
                </section>
                
                @if($pageObj->sub_content != '')
                <section class="sub-ct">
                	{!! $pageObj->sub_content !!}
                </section>
                @endif
                
        	</article>
    
    	<?php //echo $pages->render(); ?>


{{--
    @if(isset($linkArr[0]))
        <img src="http://localhost:5010/{{$linkArr[0]}}" width="230" height="150" />
    @endif
--}}
    
    @endsection

