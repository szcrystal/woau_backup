@extends('app')

@section('content')
	<div class="register">
        <h2 class="panel-head"><img src="/images/main/i-register.png">新規ユーザー登録</h2>
        
        @include('shared.move_3')
        
        <div class="send-end">
    		<img src="/images/main/il-comp.png"><br>
	        <span>登録完了</span><br>
    	    ご登録ありがとうございました
	    </div>

        <div>
            <a href="/" class="center-block send-btn">HOMEへ</a>
        </div>
            {{--
            こんにちは、{{$data['name']}}さん<br />
            {{$data['name']}}さんの登録が完了しました。<br />
            会員ID：{{$data['email']}}
            --}}
      </div>      
@endsection
