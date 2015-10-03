@extends('app')
{{-- Main top page (roop data) --}}

	@section('content')
    
		<ul class="breadcrumb">
            <li><a href="{{getUrl('/')}}"><span class="octicon octicon-home"></span>Home</a></li>
            <li><a href="{{getUrl('topics')}}">トピックス一覧</a></li>
            <li>@if($topicObj->sub_title != ''){{$topicObj->sub_title}}
            @else{{$topicObj->title}}@endif</li>
        </ul>
    
        <article class="single topic-sgl">
            <header>
            	<span class="mega-octicon octicon-radio-tower"></span>
                <span class="mega-octicon octicon-radio-tower"></span>
                <small>{!! getStrDate($topicObj->created_at, 'slash') !!}</small>
                <h2>{{$topicObj->title}}</h2>
            </header>
            
            <div>
                @if($topicObj -> intro_content != '')
                <p>
                    {!! nb($topicObj->intro_content) !!}
                </p>
                @endif
                
                <p>
                {!! $topicObj->main_content !!} 
                </p>
                
                @if($topicObj -> sub_content != '')
                <p>
                    {!! nb($topicObj->sub_content) !!}
                </p>
                @endif
            </div>
            
            <footer class="clearfix">
                {!! pager('topics', $topicObj->id) !!}
                <a href="{{ getUrl('topics') }}" class="center-block back-tx">トピックス一覧へ戻る</a>
            </footer>
        
        </article>
    
    @endsection

