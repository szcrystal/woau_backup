<footer id="colop">
	<div class="clearfix">
		<a href="{{getUrl('/')}}"><img src="{{ asset('images/main/logo-white-s.png') }}"></a>
        
        @if(Auth::user())
        	<ul>
                <li>
                    <ul>
                        <li><a href="{{ getUrl('/') }}" class="arrow-white">HOME</a></li>
                        <li><a href="{{ getUrl('about') }}" class="arrow-white">woman x auditorとは</a></li>
                        <li><a href="{{ getUrl('topics') }}" class="arrow-white">トピックス</a></li>
                    </ul>
                </li>
                <li>
                    <ul>
                    	<li><a href="{{ getUrl('privacy') }}" class="arrow-white">個人情報保護の取り扱いについて</a></li>
                        <li><a href="{{ getUrl('company') }}" class="arrow-white">運営会社の情報</a></li>
                        <li><a href="{{ getUrl('contact') }}" class="arrow-white">お問い合わせ</a></li>
                    </ul>
                </li>
                <li>
                    <ul>
                    	<li><a href="{{ getUrl('iroha') }}" class="arrow-white">監査役いろは</a></li>
                        <li><a href="{{ getUrl('iroha/about-audit') }}" class="arrow-white">監査役とは</a></li>
                        <li><a href="{{ getUrl('blog') }}" class="arrow-white">ブログ</a></li>
                    </ul>
                </li>
        	</ul>
        @else
            <ul>
                <li>
                    <ul>
                        <li><a href="{{ getUrl('/') }}" class="arrow-white">HOME</a></li>
                        <li><a href="{{ getUrl('about') }}" class="arrow-white">woman x auditorとは</a></li>
                        <li><a href="{{ getUrl('topics') }}" class="arrow-white">トピックス</a></li>
                    </ul>
                </li>
                <li>
                    <ul>
                        <li><a href="{{ getUrl('privacy') }}" class="arrow-white">個人情報保護の取り扱いについて</a></li>
                        <li><a href="{{ getUrl('company') }}" class="arrow-white">運営会社の情報</a></li>
                        <li><a href="{{ getUrl('contact') }}" class="arrow-white">お問い合わせ</a></li>
                    </ul>
                </li>
                <li>
                    <ul>
                    	@if(!isAgent('sp'))
                        <li><a href="{{ getUrl('auth/login') }}" class="arrow-white login">ログイン</a></li>
                        @endif
                        <li><a href="{{ getUrl('auth/register') }}" class="arrow-white">新規登録</a></li>
                    </ul>
                </li>
            </ul>
        @endif
        
    </div>
	<p><small>Copyright 2015 woman x auditor All rights reserved.</small></p>
    
    <span class="toTop octicon octicon-chevron-up"></span>
    
</footer>
<div id="prebox"></div>
{{--
@if(!Auth::check())
    	<div class="inBack">
    	@include('shared.login')
        </div>
    @endif
--}}
