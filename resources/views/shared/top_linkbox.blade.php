<section class="contents clearfix">
    <h2>CONTENTS</h2>
    
    <div class="link-box">
        <a href="{{getUrl('about')}}"><span>とは？？</span></a>
    </div>
    
    <div class="link-box">
        <a href="{{getUrl('iroha')}}"><span>監査役いろは</span></a>
    </div>

    <div class="link-box">
        <a href="{{getUrl('iroha/study')}}"><span>勉強会一覧</span></a>
    </div>

    <div class="link-box">
        <a href="{{getUrl('blog')}}"><span>管理者ブログ</span></a>
    </div>
    
    <div class="link-box">
        <a href="{{getUrl('contact')}}"><span>お問い合わせ</span></a>
    </div>

    <div class="link-box">
    	@if(Auth::user())
        <a href="{{getUrl('company')}}"><span>運営会社の情報</span></a>
        @else
        <a href="{{getUrl('corporation')}}"><span>法人企業様へ</span></a>
        @endif
    </div>
    
    <div class="star"></div>
    <div class="smile"></div>
    
</section>
