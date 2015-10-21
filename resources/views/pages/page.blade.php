@extends('app')
{{-- Main top page (roop data) --}}

@section('content')
    
    <ul class="breadcrumb">
    	<li><a href="{{getUrl('/')}}"><span class="octicon octicon-home"></span>Home</a></li>
        <li>{{$pageObj->sub_title}}</li>
    </ul>
        
    <article class="page-ct{{" ".$pageObj->url_name}}">
        <header>
        @if(Request::is('about'))
        <h1 class="main-title">
        @else
        <h1>
        @endif
        {{$pageObj->title}}</h1>
        </header>
        
        @if($pageObj->intro_content != '')
        <section class="intro-ct">
            <p>{!! nb($pageObj->intro_content) !!}</p>
        </section>
        @endif
        
        <section class="main-ct">	
            {!! $pageObj->main_content !!}
        </section>
        
        @if($pageObj->sub_content != '')
        <footer class="sub-ct">
            {!! $pageObj->sub_content !!}
        </footer>
        @endif
        
    </article>
    
    <?php //echo $pages->render(); ?>
    
@endsection

