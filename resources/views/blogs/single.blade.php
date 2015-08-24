@extends('app')
{{-- Main top page (roop data) --}}

	@section('content')
    	<ul class="breadcrumb">
            <li><a href="{{getUrl('/')}}"><span class="octicon octicon-home"></span>Home</a></li>
            <li><a href="{{getUrl('blog')}}">ブログ</a></li>
            <li>@if($blogObj->sub_title != ''){{$blogObj->sub_title}}
            @else{{$blogObj->title}}@endif</li>
        </ul>
        
    	<div class="page-ct clearfix">
    		<div id="primary">
				
        	<?php 
//            	$link = $page->img_link; 
//            	$linkArr = explode(';', $link);
//            	echo $linkArr[0];
            ?>
        
    		<article class="blog-sgl">
            	
            	<header>
                	<small>{!! getStrDate($blogObj->created_at, 'slash') !!}</small>
        			<h2>{{$blogObj->title}}</h2>
                    
                </header>
                
                <div>
                {{--
                @if(isset($linkArr[0]))
                	<img src="{{getUrl('/images/'$linkArr[0]}}" width="230" height="150" />
                @endif
                --}}
                
                @if($blogObj -> intro_content != '')
                    <p>
                	{!! nb($blogObj->intro_content) !!}
                	</P>
                @endif
                
                <p>
                	{!! $blogObj->main_content !!} {{-- HTMLentity()のエスケープをさせない --}}
                </p>
                
                @if($blogObj -> sub_content != '')
                <p>
                	{!! nb($blogObj->sub_content) !!}
                </p>
                @endif
                
                </div>
                
                <footer class="clearfix">
                	{{-- @if( ! App\Blog::find($blogObj->id)->cateRelation ->isEmpty()) --}}
                                        	
                    @if( ! $blogObj ->cateRelation ->isEmpty())
                        <ul class="clearfix">
                            <li>カテゴリー<li>
                        <?php 
                        	$cates = $blogObj->cateRelation;
                            $format = "<li class=\"pull-left\"><a href=\"%s\">%s</a>%s</li>\n";
                            foreach($cates as $cate) {
                                $cateObj = App\Cate::find($cate->cate_id);
                                printf($format, getUrl('blog/category/'.$cateObj->slug), $cateObj->c_name, ($cates->last() == $cate) ? "": ",&nbsp&nbsp;" );
                            }
                        ?>

                        </ul>
                    @endif
                    
                    {!! pager('blogs', $blogObj->id) !!}

                    
                </footer>
        	
            </article>
            
            <a href="{{getUrl($blogObj->slug)}}" class="center-block back-tx">ブログ一覧へ戻る</a>
            
    
    	</div>
        
        
        @include('shared.sidebar')
        
    </div>
    
    
    @endsection

