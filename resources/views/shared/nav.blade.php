<header id="head">
    <h1><a href="{{ getUrl('/')}}"><img src="{{url('/images/main/logo-top.png')}}" alt="woman x auditor"></a></h1>
    @if(isAgent('sp'))
    <span class="mega-octicon octicon-three-bars sp-menu"></span>
    @endif
</header>

<nav id="navmenu" class="clearfix">
<?php
    $pageMenus = App\Page::where(['closed'=>'公開中']) -> whereNotIn('url_name', [
        '',
        'about',
        'privacy',
        'company',
        'corporation',
        'contact',
        'topics',
        'blog',
        'recruit'
    ]) ->orderBy('created_at', 'asc') ->get();
    
    $irohas = App\Iroha::where(['slug'=>'irohas', 'closed'=>'公開中']) -> orderBy('created_at', 'asc')->get();
?>
	@if(isAgent('sp'))
    	<ul class="spmain-m">
            <li><a href="{{getUrl('/')}}"><span class="octicon octicon-triangle-right"></span>ホーム</a></li>
            <li><a href="{{getUrl('about')}}"><span class="octicon octicon-triangle-right"></span>woman x auditorとは</a></li>
            <li><a href="{{getUrl('topics')}}"><span class="octicon octicon-triangle-right"></span>トピックス</a></li>
            @if(!$pageMenus->isEmpty())
            
            <li class="dropdown"><a href="{{getUrl('#')}}" class="dd-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="octicon octicon-triangle-down"></span>その他</a>
                <ul class="dropdown-menu" role="menu">
                    @foreach($pageMenus as $pageMenu)
                    <li><a href="{{getUrl($pageMenu->url_name)}}">{{ $pageMenu->sub_title }}</a></li>
                    @endforeach
                </ul>
            </li>
        	@endif

            <li><a href="{{getUrl('contact')}}"><span class="octicon octicon-triangle-right"></span>お問い合わせ</a></li>
            @if(Auth::user())
            <li><a href="{{getUrl('recruit')}}"><span class="octicon octicon-triangle-right"></span>案件一覧</a></li>
            <li class="dropdown"><a href="{{getUrl('iroha')}}" class="dd-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="octicon octicon-triangle-down"></span>監査役いろは</a>
                <ul class="dropdown-menu" role="menu">
                    @foreach($irohas as $iroha)
                    <li><a href="{{getUrl('iroha/'.$iroha->id)}}">{{ $iroha->sub_title }}</a></li>
                    @endforeach
                    <li><a href="{{getUrl('iroha/study')}}">勉強会一覧</a></li>
                </ul>
            </li>
            <li><a href="{{getUrl('iroha/study')}}"><span class="octicon octicon-triangle-right"></span>勉強会一覧</a></li>
            <li><a href="{{getUrl('blog')}}"><span class="octicon octicon-triangle-right"></span>ブログ</a></li>
        	<li><a href="{{getUrl('profile/'.Auth::user()->user_number)}}"><span class="octicon octicon-triangle-right"></span>ユーザー情報</a></li>
            @endif
            
        </ul>
    @else
    
        <ul class="main-m">
            <li><a href="{{getUrl('/')}}"><span class="octicon octicon-home"></span>ホーム<span>Home</span></a></li>
            <li><a href="{{getUrl('about')}}"><span class="octicon octicon-question"></span>woman x auditorとは<span>About</span></a></li>
            <li><a href="{{getUrl('topics')}}"><span class="octicon octicon-radio-tower"></span>トピックス<span>Topics</span></a></li>
            <li><a href="{{getUrl('contact')}}"><span class="octicon octicon-mail-read"></span>お問い合わせ<span>Contact</span></a></li>
        </ul>
    
    	@if(!$pageMenus->isEmpty())
        <div class="dropdown">
            <span class="mega-octicon octicon-three-bars dd-toggle" data-toggle="dropdown" role="button" aria-expanded="false"></span>
            <ul class="dropdown-menu" role="menu">
                @foreach($pageMenus as $pageMenu)
                <li><a href="{{getUrl($pageMenu->url_name)}}">{{ $pageMenu->sub_title }}</a></li>
                @endforeach
            </ul>
        </div>
        @endif
    @endif
    
    <ul class="login-m">
    @if(Auth::user())
    	
        <li class="wrap-logout">
            <p>
            <?php echo Auth::user()->admin == 99 ? "管理者" : "こんにちは"; ?><br><span>{{ Auth::user()->name}}</span>さん
            </p>
            <a href="{{ getUrl('auth/logout') }}" class="logout">ログアウト</a>
        </li>
        
    @else
        <li>
            <p>登録がお済みの方は<br>コチラから！</p>
            <a href="{{ getUrl('auth/login') }}" class="login">ログイン</a>
        </li>
        <li>
            <p>登録すると<br>案件情報が閲覧可能！</p>
            <a href="{{ getUrl('auth/register') }}">新規登録</a>
        </li>
    @endif
    </ul>
</nav>


{{-- @if(Auth::user() && ! Request::is('/') && !isAgent('sp')) --}}
@if(Auth::user() && !isAgent('sp'))
<div id="user-belt">
	<ul>
    	<li><a href="{{getUrl('recruit')}}">案件一覧</a></li>
    	{{--
        <li class="dropdown">
        	<a href="{{getUrl('recruit')}}" class="dd-toggle" data-toggle="dropdown" role="button" aria-expanded="false">案件情報<span class="octicon octicon-chevron-down"></span></a>
        	<ul class="dropdown-menu" role="menu">
                <li><a href="{{getUrl('recruit')}}">新着案件</a></li>
                <li><a href="{{getUrl('recruit')}}">案件一覧</a></li>
            </ul>
        </li>
        --}}
    	<li class="dropdown"><a href="{{getUrl('iroha')}}" class="dd-toggle" data-toggle="dropdown" role="button" aria-expanded="false">監査役いろは<span class="octicon octicon-chevron-down"></span></a>
        	<ul class="dropdown-menu" role="menu">
                @foreach($irohas as $iroha)
                <li><a href="{{getUrl('iroha/'.$iroha->id)}}">{{ $iroha->sub_title }}</a></li>
                @endforeach
                <li><a href="{{getUrl('iroha/study')}}">勉強会一覧</a></li>
            </ul>
        </li>
    	<li><a href="{{getUrl('blog')}}">ブログ</a></li>
        <li><a href="{{getUrl('profile/'.Auth::user()->user_number)}}">ユーザー情報</a></li>
    </ul>
</div>
@else
<div class="guest-belt"></div>
@endif


