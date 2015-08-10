@extends('app')

@section('content')
<div class="contact">
    <h2 class="panel-head"><img src="/images/main/i-mail.png">お問い合わせ</h2>
    
    @include('shared.move_3')
    
    <div class="send-end">
        <img src="/images/main/il-comp.png"><br>
        <span>送信完了</span><br>
        お問い合わせありがとうございました
    </div>

    <div class="wrap-b">
        <a href="{{ getUrl('/') }}" class="send-btn center-block">HOMEへ</a>
    </div>
</div>
@endsection