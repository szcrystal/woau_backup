@extends('app')

	@section('content')
    	<ul class="breadcrumb">
            <li><a href="{{getUrl('/')}}"><span class="octicon octicon-home"></span>Home</a></li>
            <li>監査役いろは</li>
        </ul>

        <article class="page-ct{{" ".$obj->url_name}}">
        <?php 
            if(isset($obj->img_link)) {
                $link = $obj->img_link; 
                $linkArr = explode(';', $link);
            }
            //echo $linkArr[0];
        ?>
            <header>
                <h1>{{ $obj->title}}</a></h1>

                {{-- <small>{{getStrDate($obj->created_at)}}</small> --}}
            </header>
            
            {!! nb($obj -> intro_content) !!}

            {!! nb($obj -> main_content) !!}
            
            <footer>
            {!! nb($obj -> sub_content) !!}
            </footer>
        </article>
    
        <ul>
        @if(isset($links))
        @foreach($links as $link)
            <li><a href="{{getUrl('iroha/'.$link)}}">{{$link}}</a></li>
        @endforeach
        @endif
        
            <li><a href="{{getUrl('iroha/study')}}">監査役勉強会一覧</a></li>
        </ul>
        
<?php
 /*  

		@if(isset($linkArr[0]))
        	<img src="{{ url($linkArr[1]) }}" />
        @endif
        

    	@foreach($pages as $page)
        	

        	<?php 
//            	$link = $page->img_link; 
//            	$linkArr = explode(';', $link);
//            	echo $linkArr[0];
            ?>
        
    		<article>
        		<h1><a href="{{url($page->url_name)}}">{{$page->title}}</a></h1>
                
                {{--
                @if(isset($linkArr[0]))
                	<img src="http://localhost:5010/{{$linkArr[0]}}" width="230" height="150" />
                @endif
                --}}
                
                <div>
                	{!! nb($page->content); !!} {{-- HTMLentity()のエスケープをさせない --}}
                </div>
                <div>
                	{!! nb($page->sub_content) !!}
                </div>
        	</article>
        
        @endforeach
    
    	<?php //echo $pages->render(); ?>
 */  
 ?>  
    @endsection

