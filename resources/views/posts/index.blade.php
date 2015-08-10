@extends('app')
{{-- Main top page (roop data) --}}

	@section('content')
    
    	@foreach($all_posts as $post)
        
        	<?php 
            	$link = $post->img_link; 
            	$linkArr = explode(';', $link);
            	echo $linkArr[0];
            ?>
        
    		<article>
        		<h1><a href="/article/show/{{$page->id}}">{{$post->title}}</a></h1>
                
                @if(isset($linkArr[0]))
                	<img src="http://localhost:5010/{{$linkArr[0]}}" width="230" height="150" />
                @endif
                
                <div>
                	{{$post->content}}
                </div>
                <div>
                	{{$post->sub_content}}
                </div>
        	</article>
        @endforeach
    
    	<?php echo $all_posts->render(); ?>
    
    @endsection

