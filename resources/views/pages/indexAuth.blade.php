@extends('appTop')
{{-- Main top page (roop data) --}}

	@section('content')
    
    	<?php 
        	if(isset($obj->img_link)) {
            	$link = $obj->img_link; 
            	$linkArr = explode(';', $link);
            }
            //echo $linkArr[0];
        ?>
        
        <section class="topics">
        	<h2>TOPICS</h2>
            
            @foreach($topicObj as $topic)
            <article>
                <h3><span>{{ getStrDate($topic->created_at) }}</span>{{ $topic -> title}}</h3>
            </article>
            @endforeach
        	
            {{-- <a href="{{getUrl('topics')}}" class="topic-info">過去のTOPICS一覧 ＞＞</a> --}}
    	</section>
        
        <section class="contents clearfix">
        	<h2>CONTENTS</h2>

			{!! $obj -> main_content !!}
        
        </section>
        
        
          
    @endsection

