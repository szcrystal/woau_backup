@extends('app')
{{-- Main top page (roop data) --}}

@section('content')
	<ul class="breadcrumb">
        <li><a href="{{getUrl('/')}}"><span class="octicon octicon-home"></span>Home</a></li>
        <li>求人情報一覧</li>
    </ul>
    
    <main class="page-ct topics">
        	<div class="main-head clearfix">
        		<h1>求人情報一覧</h1>
    			<p>監査役を応募している企業情報を掲載しています。</p>
                {!! $jobs->render() !!}
            </div>
    
    	@foreach($jobs as $job)
            <?php 
//            	$link = $page->imgLink; 
//            	$linkArr = explode(';', $link);
//            	echo $linkArr[0];
				
//                @if(isset($linkArr[0]))
//                	<img src="http://localhost:5005/{{$linkArr[0]}}" width="230" height="150" />
//                @endif
            ?>
        
    		<article class="archive">                
                <header>
                    <small>{!! getStrDate($job->created_at, 'slash') !!}</small>
                    <h2><a href="{{url('/recruit/job/'. $job->job_number)}}">{{$job->company_name}}</a></h2>
                </header>
                    
                <div>
                	<p>{{$job->sub_title}}</p>
                	{{$job->first_comment}}
                        @if($job -> intro_content != '')
                            {!! $job -> intro_content !!}
                        @else
                            {!! mb_substr(strip_tags($job -> main_content), 0, 100) !!}
                        @endif
                        <a href="{{ getUrl('recruit/job/'.$job->job_number) }}" class="dots">・・・</a><br>
                        <a href="{{ getUrl('recruit/job/'.$job->job_number) }}" class="more">Read More »</a>
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

