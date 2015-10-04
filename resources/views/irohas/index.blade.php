@extends('app')

	@section('content')
    	<ul class="breadcrumb">
            <li><a href="{{getUrl('/')}}"><span class="octicon octicon-home"></span>Home</a></li>
            <li>監査役いろは</li>
        </ul>

        <article class="page-ct iroha">
            <header>
                <h1 class="main-title">{{ $obj->title}}</a></h1>
            </header>
            
            @if($obj->intro_content != '')
                <section class="intro-ct">
                	<p>{!! nb($obj->intro_content) !!}</p>
                </section>
            @endif
            
            <section class="main-ct">
               <p class="iroha-menu-tl">MENU</p>
                <ul class="iroha-menu">
                	<li><a href="#"><span class="octicon octicon-chevron-right"></span>監査役とは</a>
                    <li><a href="#"><span class="octicon octicon-chevron-right"></span>監査役の責任</a>
                    <li><a href="#"><span class="octicon octicon-chevron-right"></span>監査役の働き方</a>
                    <li><a href="#"><span class="octicon octicon-chevron-right"></span>監査役に求められる役割</a>
                    <li><a href="#"><span class="octicon octicon-chevron-right"></span>監査等委員会設置会社及び指名委員会等設置会社</a>
                    <li><a href="#"><span class="octicon octicon-chevron-right"></span>世界の監査役事情</a>
                    <li><a href="#"><span class="octicon octicon-chevron-right"></span>管理者ブログからのピックアップ</a>
                </ul>
                
                {!! $obj->main_content !!}
                
            </section>
            
            @if($obj->sub_content != '')
                <footer class="sub-ct">
                	{!! $obj->sub_content !!}
                </footer>
            @endif
        </article>
    
        
        {{--
        <ul>
        @if(isset($links))
        @foreach($links as $link)
            <li><a href="{{getUrl('iroha/'.$link)}}">{{$link}}</a></li>
        @endforeach
        @endif
        
            <li><a href="{{getUrl('iroha/study')}}">監査役勉強会一覧</a></li>
        </ul>
        --}}

@endsection

