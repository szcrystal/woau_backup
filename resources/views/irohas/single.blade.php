@extends('app')
{{-- Main top page (roop data) --}}

	@section('content')
    
    	<div class="row clearfix">
			<a href="{{getUrl('iroha')}}" class="pull-left">監査役いろはへ戻る</a>
            <a href="{{getUrl('iroha/entry/'.$atcl->id)}}" class="btn btn-success pull-right">この勉強会へ参加する</a>

		</div>

        	<?php 
//            	$link = $page->img_link; 
//            	$linkArr = explode(';', $link);
//            	echo $linkArr[0];
            ?>
        
    		<article>
            	<header>
        			<h1>{{$atcl->title}}</a></h1>
                    <small>{{getStrDate($atcl->created_at)}}</small>
                </header>
                
                {{--
                @if(isset($linkArr[0]))
                	<img src="{{getUrl('/images/'$linkArr[0]}}" width="230" height="150" />
                @endif
                --}}
                
                <div>
                	{!! nb($atcl->intro_content) !!}
                </div>
                <div>
                	{!! nb($atcl->main_content) !!} 
                </div>
                <div>
                	{!! nb($atcl->sub_content) !!}
                </div>
                
                <footer>
                </footer>
        	
            </article>
    
    
    @endsection

