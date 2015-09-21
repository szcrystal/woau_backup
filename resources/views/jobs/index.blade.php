@extends('app')
{{-- Main top page (roop data) --}}

@section('content')
	<ul class="breadcrumb">
        <li><a href="{{getUrl('/')}}"><span class="octicon octicon-home"></span>Home</a></li>
        <li>案件情報一覧</li>
    </ul>
    
    <main class="page-ct job">
        	<div class="main-head clearfix">
        		<h1>{{$headTitle}}</h1>
    			<p>監査役を応募している案件情報を掲載しています。</p>
                {!! $jobs->render() !!}
            </div>
    
    	@foreach($jobs as $job)
			<?php $path = Request::path(). '/job/' . $job->job_number; ?>
        
    		<article class="archive">                
                <header>
                    <small>{!! getStrDate($job->created_at, 'slash') !!}</small>
                    <h2><a href="{{getUrl($path)}}">{{$job->company_name}}</a></h2>
                    <h3>{{$job->title}}</h3>
                </header>
                    
                <div>
                    {!! readMoreContents($job->main_content, $path) !!}
                
                </div>
                    
                {{--
                <footer>
                {!! nb($job -> sub_content) !!}
                </footer>
                --}}
            </article>
                
        	
        @endforeach
        
        </main>
        
    
    	{!! $jobs->render() !!}
    
    @endsection

