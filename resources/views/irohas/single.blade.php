@extends('app')
{{-- Main top page (roop data) --}}

	@section('content')
    	<ul class="breadcrumb">
            <li><a href="{{getUrl('/')}}"><span class="octicon octicon-home"></span>Home</a></li>
            <li><a href="{{getUrl('iroha')}}">監査役いろは</a></li>
            <li><a href="{{getUrl('iroha/study')}}">勉強会一覧</a></li>
            <li>@if($atcl->sub_title != ''){{$atcl->sub_title}}
            @else{{$atcl->title}}@endif</li>
        </ul>

        	<?php 
//            	$link = $page->img_link; 
//            	$linkArr = explode(';', $link);
//            	echo $linkArr[0];
            ?>
        
    		<article class="page-ct single study-sgl">
            	<header>
                	<small>{!! getStrDate($atcl->created_at, 'slash') !!}</small>
                    @if($atcl->closed == '非公開')
                        <p><span class="octicon octicon-issue-opened"></span>この勉強会は終了しています。</p>
                    @else
                        @if(isset($already))
                        <span class="done-btn">{{$already}}</span>
                        @else
                        <a href="{{ getUrl('iroha/entry/'.$atcl->id) }}" class="edit-btn">この勉強会に参加する</a>
                        @endif
                    @endif
                    
        			<h2>{{$atcl->title}}</h2>
                    
                </header>
                
                <section class="main-ct">
                    @if($atcl -> intro_content != '')
                    <p>
                        {!! nb($atcl->intro_content) !!}
                    </p>
                    @endif
                    
                    <p>
                    {!! $atcl->main_content !!} 
                    </p>
                    
                    @if($atcl -> sub_content != '')
                    <p>
                        {!! nb($atcl->sub_content) !!}
                    </p>
                    @endif
                </section>
                
                <footer class="clearfix">
                	@if($atcl->closed == '公開中')
                        @if(isset($already))
                        <span class="done-btn">{{$already}}</span>
                        @else
                        <a href="{{ getUrl('iroha/entry/'.$atcl->id) }}" class="edit-btn">この勉強会に参加する</a>
                        @endif
                    @endif
                    
                    {!! pager('irohas', $atcl->created_at) !!}
                    
                    <a href="{{ getUrl('iroha/study') }}" class="center-block back-tx">勉強会一覧へ戻る</a>
                </footer>
        	
            </article>
            
            {{--
            <div class="row clearfix">
                <a href="{{getUrl('iroha')}}" class="pull-left">監査役いろはへ戻る</a>
                <a href="{{getUrl('iroha/entry/'.$atcl->id)}}" class="btn btn-success pull-right">この勉強会へ参加する</a>
            </div>
			--}}
{{--
@if(isset($linkArr[0]))
<img src="{{getUrl('/images/'$linkArr[0]}}" width="230" height="150" />
@endif
--}}

    
    
    @endsection
    
    

