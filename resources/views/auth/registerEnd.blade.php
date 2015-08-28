@extends('app')

@section('content')
	<ul class="breadcrumb">
        <li><a href="{{getUrl('/')}}"><span class="octicon octicon-home"></span>Home</a></li>
        <li>{{$headTitle}}（完了）</li>
    </ul>
    
	<main class="page-ct register">
    	<div class="main-head">
        	<h1 class="panel-head">{{$headTitle}}</h1>
        </div>
        
        @include('shared.move_3')
        
        <div class="send-end">
    		<img src="/images/main/il-comp.png"><br>
	        <span>登録完了</span><br>
    	    こんにちは、{{$data['name']}}さん<br />
            {{$data['name']}}さんのユーザー登録が完了しました。<br />
            ユーザーID（メールアドレス）：{{$data['email']}}
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
