@extends('app')
{{-- Main top page (roop data) --}}

	@section('content')
    
    	@foreach($jobs as $job)
            <?php 
//            	$link = $page->imgLink; 
//            	$linkArr = explode(';', $link);
//            	echo $linkArr[0];
				
//                @if(isset($linkArr[0]))
//                	<img src="http://localhost:5005/{{$linkArr[0]}}" width="230" height="150" />
//                @endif


            ?>
        
    		<article>
        		<h1><a href="{{url('/recruit/job/'. $job->job_number)}}">{{$job->company_name}}</a></h1>
                
                
                
                <div>
                	{{$job->sub_title}}
                </div>
                <div>
                	{{$job->first_comment}}
                </div>
        	</article>
        	
        @endforeach
    
    	<?php echo $jobs->render(); ?>
    
    @endsection

