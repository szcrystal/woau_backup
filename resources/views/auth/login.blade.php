@extends('app')

@section('content')
	<main class="wrap-login">
    	<h1 class="main-title">ログイン</h1>
		@include('shared.login')
                        
        <div class="new-regist">
            <a href="{{getUrl('auth/register')}}">
            <p>
            未登録の方は..
            <img src="{{asset('images/main/person.png')}}">
            
            <span>新規登録</span> へ
            </p>
            </a>
        </div>
    
    </main>

@endsection
