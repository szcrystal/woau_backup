@extends('app')
{{-- Main top page (roop data) --}}

	@section('content')
    
    <ul class="breadcrumb">
    	<li><a href="{{getUrl('/')}}"><span class="octicon octicon-home"></span>Home</a></li>
        <li>{{$pageObj->title}}</li>
    </ul>
        
    		<article class="page-ct{{" ".$pageObj->url_name}}">
            	@if(! Request::is('privacy') && ! Request::is('company'))
                <h1 class="main-title">
                @else
        		<h1>
                @endif
                {{$pageObj->title}}</h1>
                
                @if($pageObj->intro_content != '')
                <section class="intro-ct">
                	<p>{!! nb($pageObj->intro_content) !!}</p>
                </section>
                @endif
                
                <section class="main-ct">	
                	{!! $pageObj->main_content !!}
                </section>
                
                @if($pageObj->sub_content != '')
                <footer class="sub-ct">
                	{!! $pageObj->sub_content !!}
                </footer>
                @endif
                
        	</article>
    
    	<?php //echo $pages->render(); ?>


{{--
    @if(isset($linkArr[0]))
        <img src="http://localhost:5010/{{$linkArr[0]}}" width="230" height="150" />
    @endif
--}}
    
    @endsection

