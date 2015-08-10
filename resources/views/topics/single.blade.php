@extends('app')
{{-- Main top page (roop data) --}}

	@section('content')
    
		<a href="{{getUrl('/topics')}}">トピックス一覧へ戻る</a>

        	<?php 
//            	$link = $page->img_link; 
//            	$linkArr = explode(';', $link);
//            	echo $linkArr[0];
            ?>
        
    		<article>
            	<header>
        			<h1>{{$topicObj->title}}</a></h1>
                    <small>{{getStrDate($topicObj->created_at)}}</small>
                </header>
                
                {{--
                @if(isset($linkArr[0]))
                	<img src="{{getUrl('/images/'$linkArr[0]}}" width="230" height="150" />
                @endif
                --}}
                
                <div>
                	{!! nb($topicObj->intro_content) !!}
                </div>
                <div>
                	{!! nb($topicObj->main_content) !!} {{-- HTMLentity()のエスケープをさせない --}}
                </div>
                <div>
                	{!! nb($topicObj->sub_content) !!}
                </div>
                
                <footer>
                </footer>
        	
            </article>
    
    
    @endsection

