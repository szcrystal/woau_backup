@extends('app')

	@section('content')
    
    	@foreach($topics as $topic)
    	
        	<article>
            <?php 
                if(isset($topic->img_link)) {
                    $link = $topic->img_link; 
                    $linkArr = explode(';', $link);
                }
                //echo $linkArr[0];
            ?>
                <header>
                    <h1><a href="{{getUrl('topics/'.$topic->id)}}">{{ $topic->title}}</a></h1>

                    <small>{{getStrDate($topic->created_at)}}</small>
                </header>
                
                {!! nb($topic -> intro_content) !!}

                {!! nb($topic -> main_content) !!}
                
                <footer>
                {!! nb($topic -> sub_content) !!}
                </footer>
            </article>
        
        @endforeach
        
        <?php echo $topics->render(); ?>
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

