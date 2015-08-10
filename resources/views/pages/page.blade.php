@extends('app')
{{-- Main top page (roop data) --}}

	@section('content')
    

        	<?php 
//            	$link = $page->img_link; 
//            	$linkArr = explode(';', $link);
//            	echo $linkArr[0];
            ?>
        
    		<article>
        		<h1>{{$pageObj->title}}</a></h1>
                
                {{--
                @if(isset($linkArr[0]))
                	<img src="http://localhost:5010/{{$linkArr[0]}}" width="230" height="150" />
                @endif
                --}}
                <div>	
                	{!! nb($pageObj->intro_content) !!} {{-- HTMLentity()のエスケープをさせない --}}
                </div>
                <div>	
                	{!! $pageObj->main_content !!} {{-- HTMLentity()のエスケープをさせない --}}
                </div>
                <div>
                	{{$pageObj->sub_content}}
                </div>
        	</article>
    
    	<?php //echo $pages->render(); ?>
    
    @endsection

