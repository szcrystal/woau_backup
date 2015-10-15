@extends('app')

@section('content')
	<ul class="breadcrumb">
        <li><a href="{{getUrl('/')}}"><span class="octicon octicon-home"></span>Home</a></li>
        <li>送信エラー</li>
    </ul>
    <main>
    	<div class="main-head">
        	<h1>送信エラー</h1>
            <p></p>
        </div>
        
        @if(! Request::is('password/email'))
        	@include('shared.move_3')
        @endif
        
        <div class="send-end">
            <img src="/images/main/il-comp.png"><br>
            <span><span class="octicon octicon-alert"></span> 正常に送信されませんでした</span><br><br>
            お手数をお掛け致します。<br>
            時間を置いて再度お試し頂くか、それでも送信できない場合は<br><a href="mailto:info@woman-auditor.com">info@woman-auditor.com</a> まで直接ご連絡下さい。
        </div>

        <div>
            <a href="{{ getUrl('/') }}" class="edit-btn"><span class="octicon octicon-mail-reply"></span>HOMEへ</a>
        </div>
    </main>
@endsection