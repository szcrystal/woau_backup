@extends('app')
{{-- Main top page (roop data) --}}

	@section('content')
    
		<a href="{{getUrl($obj->slug)}}">ブログ一覧へ戻る</a>

        	<?php 
//            	$link = $page->img_link; 
//            	$linkArr = explode(';', $link);
//            	echo $linkArr[0];
            ?>
        
    		<article>
            	<header>
        			<h1>{{$obj->title}}</a></h1>
                    <small>{{getStrDate($obj->created_at)}}</small>
                </header>
                
                {{--
                @if(isset($linkArr[0]))
                	<img src="{{getUrl('/images/'$linkArr[0]}}" width="230" height="150" />
                @endif
                --}}
                
                <div>
                	{!! nb($obj->intro_content) !!}
                </div>
                <div>
                	{!! nb($obj->main_content) !!} {{-- HTMLentity()のエスケープをさせない --}}
                </div>
                <div>
                	{!! nb($obj->sub_content) !!}
                </div>
                
                <footer>
                </footer>
        	
            </article>
    
    
    @endsection

