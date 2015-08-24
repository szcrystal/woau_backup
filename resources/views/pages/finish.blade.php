@extends('app')

@section('content')
	<ul class="breadcrumb">
        <li><a href="{{getUrl('/')}}"><span class="octicon octicon-home"></span>Home</a></li>
        <li>お問い合わせ（完了）</li>
    </ul>
    <main class="page-ct contact">
    	<div class="main-head">
        	<h1 class="panel-head">お問い合わせ</h1>
            <p></p>
        </div>
        
        
        @include('shared.move_3')
        
        <div class="send-end">
            <img src="/images/main/il-comp.png"><br>
            <span>送信完了</span><br>
            お問い合わせありがとうございました
        </div>

        <div>
            <a href="{{ getUrl('/') }}" class="edit-btn">HOMEへ</a>
        </div>
    </main>
@endsection