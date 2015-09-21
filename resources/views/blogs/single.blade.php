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
        
    		<article class="blog-sgl">
            	
            	<header>
                	<small>{!! getStrDate($blogObj->created_at, 'slash') !!}</small>
                    <span class="octicon octicon-quote"></span>
        			<h2>{{$blogObj->title}}</h2>
                    
                    @include('shared.cate_list')
                </header>
                
                <div>
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
                    
                    @include('shared.cate_list')
                    
                    {!! pager('blogs', $blogObj->id) !!}

                    
                </footer>
        	
            </article>
            
            <a href="{{getUrl($blogObj->slug)}}" class="center-block back-tx">ブログ一覧へ戻る</a>
            
    
    	</div>
        
        
        @include('shared.sidebar')
        
    </div>
    
    
    @endsection

