<header id="head">
    <h1><a href="{{ getUrl('/')}}"><img src="{{url('/images/main/logo-top.png')}}" alt="woman x auditor"></a></h1>
</header>

<nav id="navmenu" class="clearfix">
    <ul class="main-m">
        <li><a href="{{getUrl('/')}}">ホーム<span>Home</span></a></li>
        <li><a href="{{getUrl('about')}}">woman x auditorとは<span>About</span></a></li>
        <li><a href="{{getUrl('topics')}}">トピックス<span>Topics</span></a></li>
        <li><a href="{{getUrl('contact')}}">お問い合わせ<span>Contact</span></a></li>
    </ul>
    
    
    <ul class="login-m">
    @if(Auth::user())
        <li>
            <p>こんにちは<br><span>{{ Auth::user()->name}}</span> さん</p>
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


@if(Auth::user() && ! Request::is('/'))
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
            	<?php
                	$irohas = App\Iroha::where('slug', 'irohas') ->get();
                    //$irohaObjs = $this -> iroha -> where('slug', 'irohas') -> orderBy('created_at', 'desc') -> get();
                ?>
                @foreach($irohas as $iroha)
                <li><a href="{{getUrl('iroha/'.$iroha->url_name)}}">{{ $iroha->sub_title }}</a></li>
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


