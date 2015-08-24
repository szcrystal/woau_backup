@extends('app')

@section('content')
	<ul class="breadcrumb">
        <li><a href="{{getUrl('/')}}"><span class="octicon octicon-home"></span>Home</a></li>
        <li>ユーザー登録（完了）</li>
    </ul>
    
	<main class="page-ct contact">
    	<div class="main-head">
        	<h1 class="panel-head"><img src="/images/main/i-register.png">新規ユーザー登録</h1>
            <p></p>
        </div>
        
        @include('shared.move_3')
        
        <div class="send-end">
    		<img src="/images/main/il-comp.png"><br>
	        <span>登録完了</span><br>
    	    ご登録ありがとうございました
	    </div>

        <div>
            <a href="/" class="edit-btn">HOMEへ</a>
        </div>
            {{--
            こんにちは、{{$data['name']}}さん<br />
            {{$data['name']}}さんの登録が完了しました。<br />
            会員ID：{{$data['email']}}
            --}}
    </main>      
@endsection
