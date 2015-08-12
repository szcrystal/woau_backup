@extends('app')
{{-- Main top page (roop data) --}}

	@section('content')
    

        	<?php 
//            	$link = $page->img_link; 
//            	$linkArr = explode(';', $link);
//            	echo $linkArr[0];
            ?>
        
    		<article class="content">
        		<h1>{{$pageObj->title}}</a></h1>
                
                {{--
                @if(isset($linkArr[0]))
                	<img src="http://localhost:5010/{{$linkArr[0]}}" width="230" height="150" />
                @endif
                --}}
                <section class="intro_content">
                	{!! nb($pageObj->intro_content) !!} {{-- HTMLentity()のエスケープをさせない --}}
                </section>
                <section class="main_content">	
                	{!! $pageObj->main_content !!} {{-- HTMLentity()のエスケープをさせない --}}
                </section>
                <section class="sub_content">
                	{{$pageObj->sub_content}}
                </section>
        	</article>
    
    	<?php //echo $pages->render(); ?>
    
    @endsection

