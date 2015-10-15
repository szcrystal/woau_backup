@extends('app')

@section('content')
	<ul class="breadcrumb">
        <li><a href="{{getUrl('/')}}"><span class="octicon octicon-home"></span>Home</a></li>
        <li>新規ユーザー登録（完了）</li>
    </ul>
    
	<main class="page-ct register">
    	<div class="main-head">
        	<h1>新規ユーザー登録</h1>
        </div>
        
        @include('shared.move_3')
        
        <div class="send-end">
    		<img src="/images/main/person.png">
            <p>
	        <span>登録完了</span><br>
            <strong>ユーザーID（メールアドレス）：{{$data['email']}}</strong><br>
    	    こんにちは、{{$data['name']}}さん<br>
            {{$data['name']}}さんのユーザー登録が完了しました。<br>
            これより、案件情報や勉強会などのユーザー向けコンテンツがご覧になれます。
            </p>
	    </div>

        <div>
            <a href="{{ getUrl('/') }}" class="edit-btn"><span class="octicon octicon-mail-reply"></span>HOMEへ</a>
        </div>
    </main>      
@endsection
