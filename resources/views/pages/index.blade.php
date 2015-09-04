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
            
            @foreach($topTopics as $topic)
            <article>
            	<a href="{{ getUrl('topics/'.$topic->id) }}">
            		<small>{{ getStrDate($topic->created_at) }}</small>
                	<h3>{{ $topic -> title}}</h3>
                </a>
            </article>
            @endforeach
        	
            <a href="{{getUrl('topics')}}" class="topic-link">トピックス一覧</a>
    	</section>
        
        <section class="contents clearfix">
        	<h2>CONTENTS</h2>
            
            <div class="link-box">
                <a href="{{getUrl('iroha')}}"><span>監査役いろは</span></a>
            </div>

            <div class="link-box">
                <a href="{{getUrl('iroha/study')}}"><span>勉強会一覧</span></a>
            </div>

            <div class="link-box">
                <a href="{{getUrl('blog')}}"><span>管理者ブログ</span></a>
            </div>
			
            <div class="link-box">
            	<a href="{{getUrl('contact')}}"><span>お問い合わせ</span></a>
            </div>

            <div class="link-box">
            	<a href="{{getUrl('privacy')}}"><span>個人情報の保護</span></a>
            </div>

			{{--
            <div class="link-box">
            	<a href="{{getUrl('company')}}"><span>運営会社</span></a>  
            </div>
            --}}
            
            
        </section>
      
@endsection

