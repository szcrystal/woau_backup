<!DOCTYPE html>
<html lang="ja">
@include('shared.head')

{{-- @if (Request::is('/'))  --}}
<body class="home">
	<div id="o-belt"></div>
{{--
@if(getenv('LARAVEL_ENV') != 'heroku')
@include('shared.nav_1')
@endif
--}}
{{-- @if(str_contains(Request::path(), 'auth')) if ($request->is('auth/*')) --}}

    <div id="page">
        
        @include('shared.nav')
        
        <div id="cal">
        	<div>
            	<p>{!! nb($obj -> intro_content) !!}</p>
                <hr>
            	<p>{!! nb($obj -> main_content) !!}</p>
                
                <div class="person"></div>
        	</div>
        </div>
        <div class="guest-belt"></div>
        @if(Auth::user())
        {{--
        <div id="user-belt">
        	<div>
            	ユーザー：{{ Auth::user()->name }} さん
                <a href="{{ getUrl('/auth/logout')}}" class="arrow-white">ログアウト</a>
            </div>
        </div>
		--}}
        
        <div class="container-fluid">
        	<div class="blog-main">
            	
                <div class="user clearfix">
                    <section class="jobs">
                    	<h2>NEW</h2>
                        {{--<h2><span class="octicon octicon-primitive-square"></span>新着案件</h2>--}}
                    	{{-- <div class="clearfix"> --}}
                        @foreach($jobs as $job)
                            <article>
                            	<a href="{{getUrl('recruit/job/'.$job->job_number)}}">
                                <small>{{ getStrDate($job->created_at) }}</small>
                                <h3>{{ $job->company_name }}<br><span>{{ $job ->title }}</span></h3>
                                </a>
                            </article>
                        @endforeach
                    
                        <a href="{{getUrl('recruit')}}" class="user-link">案件情報一覧</a>
                        {{-- </div> --}}
                    </section>
                    
                    <section class="contents clearfix">
                    	<div id="user-belt">
                            ユーザー： {{ Auth::user()->name }} さん
                            {{-- <a href="{{ getUrl('/auth/logout')}}" class="arrow-white">ログアウト</a> --}}
                        </div>
                    
                    	<div class="profile">
                        	
                        	<p><a href="{{ getUrl('profile/'.Auth::user()->user_number)}}" class="u-link"><span class="octicon octicon-pin"></span>ユーザー情報<span class="octicon octicon-chevron-right"></span></a></p>
                            <p><a href="{{getUrl('profile/'.Auth::user()->user_number.'#entry-company')}}" class="u-link"><span class="octicon octicon-pin"></span>応募した案件<span class="octicon octicon-chevron-right"></span></a>
                            	<?php $jobCount = 0; $studyCount=0;?>
                            	<span>
                                @if($jobCount == 0)
                                応募した案件はありません
                                @else
                                {{$jobCount}}件
                                @endif
                                </span></p>
                            <p><a href="{{getUrl('profile/'.Auth::user()->user_number.'#entry-study')}}" class="u-link clearfix"><span class="octicon octicon-pin"></span>申込み勉強会<span class="octicon octicon-chevron-right"></span></a>
                            	<span>@if($studyCount == 0)
                                申込みをした勉強会はありません
                                @else
                                {{$studyCount}}件
                            	@endif</span></p>
                    	</div>
                        <div class="clearfix">
                        	<p>ユーザー情報の登録項目に誤りや空欄はありませんか？ 詳しく記載することで案件の応募がスムーズになります。</p>
                            <a href="{{ getUrl('profile/edit/'.Auth::user()->user_number)}}" class="u-link pull-right"><span class="octicon octicon-pencil"></span>ユーザー情報を編集する<span class="octicon octicon-chevron-right"></span></a>
                        </div>
                        
                    
                    	{{--
                		<div class="clearfix">
                        	<h2><span class="octicon octicon-primitive-square"></span>ユーザー向けコンテンツ</h2>
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
                        --}}
                        
                    </section>
                </div>
        
        @else
        {{-- <div class="guest-belt"></div> --}}

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
