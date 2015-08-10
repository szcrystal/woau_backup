@extends('app')

	@section('content')
    
    	@foreach($objs as $obj)
    	
        	<article>
            <?php 
                if(isset($obj->img_link)) {
                    $link = $obj->img_link; 
                    $linkArr = explode(';', $link);
                }
                //echo $linkArr[0];
            ?>
                <header>
                    <h1><a href="{{getUrl('/iroha/study/'.$obj->id)}}">{{ $obj->title}}</a></h1>

                    <small>{{getStrDate($obj->created_at)}}</small>
                </header>
                
                {!! nb($obj -> intro_content) !!}

                {!! nb($obj -> main_content) !!}
                
                <footer>
                {!! nb($obj -> sub_content) !!}
                </footer>
            </article>
        
        @endforeach
        
        <?php echo $objs->render(); ?>
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

