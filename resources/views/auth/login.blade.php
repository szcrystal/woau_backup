@extends('app')

@section('content')
	<main class="wrap-login">
    	<h1 class="main-title">ログイン</h1>

        <div class="panel clearfix">
            <div class="panel-heading">
                {{-- <img src="/images/main/i-lock.png"> --}}
                <h2></h2>
                
                {{-- <p>ログイン（登録がお済みの方）</p> --}}
            </div>

            {{--
            <div class="form-group">
                <p>メールアドレスとパスワードを入力し「ログイン」ボタンを押して下さい。</p>   
            </div>
            --}}
            
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>ご確認ください!</strong><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
              
            <div class="panel-body">  
                <form class="form-horizontal" role="form" method="POST" action="{{getUrl('auth/login')}}">
                
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                        <label class="col-md-2 control-label">ユーザーID</label>
                        <div class="col-md-10">
                            <input type="email" class="form-control" name="user_id" value="{{ old('user_id') }}" placeholder="メールアドレスを入力して下さい" autofocus>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">パスワード</label>
                        <div class="col-md-10">
                            <input type="password" class="form-control" name="password" placeholder="6文字以上を入力して下さい">
                        </div>
                    </div>
                    
                    <div>
                        <a class="pull-right" href="{{ getUrl('/password/email') }}"><span class="octicon octicon-issue-opened"></span> パスワードをお忘れですか？</a><br />
                    </div>
                    
                    <div>
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember"> ログイン状態を保存する
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <button type="submit" class="conf-btn">ログイン</button>
                        </div>
                    </div>
                </form>
            </div>
            
            <div class="text-center">
                {{-- 初めてご利用される方はこちらから
                <a class="link-btn" href="{{ getUrl('/auth/register') }}">新規登録</a> --}}
            </div>
            
        </div>
        
        <div class="new-regist">
            <a href="{{getUrl('auth/register')}}">
            <p>未登録の方は..
            <img src="{{asset('images/main/person.png')}}">
            <span>新規登録</span> へ
            </p>
            </a>
        </div>
    
    </main>

@endsection
