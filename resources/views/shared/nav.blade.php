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
            <p>こんにちは<br>{{ Auth::user()->name}} さん</p>
            <a href="{{ getUrl('auth/logout') }}" class="logout">ログアウト</a>
        </li>
    @else
        <li>
            <p>登録がお済みの方は<br>コチラから！</p>
            <a href="{{ getUrl('auth/login') }}">ログイン</a>
        </li>
        <li>
            <p>登録すると<br>企業情報が閲覧可能！</p>
            <a href="{{ getUrl('auth/register') }}">新規登録</a>
        </li>
    </ul>
    @endif
</nav>


@if(Auth::user() && ! Request::is('/'))
<div id="user-belt">
	<ul>
    	<li><a href="{{getUrl('recruit')}}">求人一覧</a></li>
    	<li><a href="{{getUrl('iroha')}}">監査役いろは</a></li>
    	<li><a href="{{getUrl('blog')}}">ブログ</a></li>
        <li><a href="{{getUrl('profile/'.Auth::user()->user_number)}}">ユーザー情報</a></li>
    </ul>
</div>
@endif


