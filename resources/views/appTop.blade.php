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
        
        <div class="container-fluid user">

                    <section class="profile clearfix">
                    	
                    	<div class="clearfix">
                            <h2><span class="octicon octicon-person"></span>ユーザー： {{ Auth::user()->name }} さん</h2>
                            
                            <div class="clearfix"> 
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
                                <p><a href="{{getUrl('profile/'.Auth::user()->user_number.'#entry-study')}}" class="u-link"><span class="octicon octicon-pin"></span>申込み勉強会<span class="octicon octicon-chevron-right"></span></a>
                                    <span>@if($studyCount == 0)
                                    申込みをした勉強会はありません
                                    @else
                                    {{$studyCount}}件
                                    @endif</span></p>
                            </div>
                            <div>
                                <p>ユーザー情報の登録項目に誤りや空欄はありませんか？ 詳しく記載することで案件の応募がスムーズになります。</p>
                                <a href="{{ getUrl('profile/edit/'.Auth::user()->user_number)}}" class="u-link"><span class="octicon octicon-pencil"></span>ユーザー情報を編集する<span class="octicon octicon-chevron-right"></span></a>
                            </div>
                        </div>
                    </section>
                    
               <div class="blog-main">     
                    @include('shared.linkbox')
                   
                   <div>
                    <section class="jobs clearfix">
                        <h2>NEW</h2>
						<div>
                        @foreach($jobs as $job)
                            <article>
                                <a href="{{getUrl('recruit/job/'.$job->job_number)}}">
                                <small>{{ getStrDate($job->created_at) }}</small>
                                <h3>{{ $job->company_name }}<br><span>{{ $job ->title }}</span></h3>
                                </a>
                            </article>
                        @endforeach
                    
                        <a href="{{getUrl('recruit')}}" class="user-link">案件情報一覧</a>
                        </div>
                    </section>
                
                	<section class="topics clearfix">
                        <h2>TOPICS</h2>
                        <div>
                        @foreach($topTopics as $topic)
                        <article>
                            <a href="{{ getUrl('topics/'.$topic->id) }}">
                                <small>{{ getStrDate($topic->created_at) }}</small>
                                <h3>{{ $topic -> title}}</h3>
                            </a>
                        </article>
                        @endforeach
                        
                        <a href="{{getUrl('topics')}}" class="topic-link">トピックス一覧</a>
                        </div>
                    </section>
                	</div>
                </div>{{-- blogmain --}}
        
        @else
        {{-- <div class="guest-belt"></div> --}}

        <div class="container-fluid">
        	<div class="blog-main">
        
				<div class="guest">
                	@yield('content')
                </div>
            </div>

    	@endif
        </div><!-- container -->
    @include('shared.footer')
    
    </div><!-- page -->
</body>
</html>
