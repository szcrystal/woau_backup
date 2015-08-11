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
            
            <article>
                <h3><span>2015年7月29日</span>トピックス２</h3>
            </article>
            <article>
                <h3><span>2015年7月22日</span>トピックス１</h3>
            </article>
            <article>
                <h3><span>2015年7月29日</span>トピックス２</h3>
            </article>
            <article>
                <h3><span>2015年7月22日</span>トピックス１</h3>
            </article>
            <article>
                <h3><span>2015年7月29日</span>トピックス２</h3>
            </article>
            <article>
                <h3><span>2015年7月22日</span>トピックス１</h3>
            </article>

        	
            <a href="{{getUrl('topics')}}" class="topic-link">過去のTOPICS一覧</a>
    	</section>
        
        <section class="contents clearfix">
        	<h2>CONTENTS</h2>
			
            <div class="link-box">
            	<a href="{{getUrl('contact')}}"><span>お問い合わせ</span></a>
            </div>

            <div class="link-box">
            	<a href="{{getUrl('privacy')}}"><span>個人情報の保護</span></a>
            </div>

            <div class="link-box">
            	<a href="{{getUrl('company')}}"><span>運営会社</span></a>
                
            </div>
            

			{{--
			{!! $obj -> main_content !!}
        	--}}
            
        </section>
        
        
          
    @endsection

