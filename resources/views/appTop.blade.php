<!DOCTYPE html>
<html lang="ja">
@include('shared.head')

{{-- @if (Request::is('/'))  --}}
<body class="home">

@if(getenv('LARAVEL_ENV') != 'heroku')
@include('shared.nav_1')
@endif

{{-- @if(str_contains(Request::path(), 'auth')) if ($request->is('auth/*')) --}}

    <div id="page">
    	<header id="head">
        	<h1><a href="{{ getUrl('/')}}"><img src="{{url('/images/main/logo-top.png')}}" /></a></h1>
        </header>
        
        @include('shared.nav')
        
        <div id="cal">
        	<div>
            	<p>{!! nb($obj -> intro_content) !!}</p>
                <div></div>
            	<p>{!! nb($obj -> main_content) !!}</p>
        	</div>
        </div>
        
        @if(Auth::user())
        <div id="user-belt">
        	<div>
            	{{ Auth::user()->name }} さん
                <span>ユーザー情報変更</span>
                <a href="{{ getUrl('/auth/logout')}}" class="arrow-white">ログアウト</a>
            </div>
        </div>
		
        <div class="container-fluid">
        	<div class="blog-main">
            	
                <div class="user clearfix">
                    <section class="jobs">
                        <h2><span class="octicon octicon-primitive-square"></span>新着求人</h2>
                    	<div class="clearfix">
                        @foreach($topicObj as $topic)
                            <article>
                                <h3><a href="">{{ getStrDate($topic->title) }}</a></h3>
                                {!! $topic -> intro_content !!}
                            </article>
                        @endforeach
                        
                        <article>
                            <h3><a href="">1970年1月1日</a></h3>
                            ジョブタイトル
                        </article>
                        <article>
                            <h3><a href="">1970年1月1日</a></h3>
                            ジョブタイトル
                        </article>
                        <article>
                            <h3><a href="">1970年1月1日</a></h3>
                            ジョブタイトル
                        </article>
                    
                        <a href="{{getUrl('recruit')}}" class="user-link">求人情報一覧</a>
                        </div>
                    </section>
                    
                    <section class="contents clearfix">
                    	<div class="profile">
                        	<p><a href="{{ getUrl('profile/'.Auth::user()->user_number)}}" class="user-link">ユーザー情報</a></p>
                            <p><a href="" class="user-link">応募企業数</a><span>件</span></p>
                            <p><a href="" class="user-link">参加勉強会数</a><span>件</span></p>
                    	</div>
                    
                		<div class="clearfix">
                        	<h2><span class="octicon octicon-primitive-square"></span>会員向けコンテンツ</h2>
	                        <div class="link-box">
                                <a href="{{getUrl('iroha')}}"><span>監査役いろは</span></a>
                            </div>

                            <div class="link-box">
                                <a href="{{getUrl('iroha/study')}}"><span>勉強会一覧</span></a>
                            </div>

                            <div class="link-box">
                                <a href="{{getUrl('blog')}}"><span>管理者ブログ</span></a>
                            </div>
                    	</div>
                    </section>
                </div>
        
        @else
        <div class="container-fluid">
        	<div class="blog-main">
        @endif
				<div class="guest">
                	@yield('content')
                </div>
            </div>

    </div><!-- container -->
    
    @include('shared.footer')
    
    </div><!-- page -->
</body>
</html>
