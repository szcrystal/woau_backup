@extends('app')

@section('content')
	<main class="wrap-reset">
    	<h1 class="main-title">パスワードをリセット</h1>

		<div class="panel orgPanel center-block clearfix">
				
            <div class="panel-heading">
                <h2></h2>
                {{-- <img src="/images/main/i-lock.png">パスワードをリセット --}}
            </div>
            
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>ご確認ください!</strong> <br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

			<div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="token" value="{{ $token }}">
                    
                    <p class="forget-pass">メールアドレスと新しいパスワードを入力して下さい。</p>

                    <div class="form-group">
                        <label class="control-label">メールアドレス</label>
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                    </div>

                    <div class="form-group">
                        <label class="control-label">新しいパスワード</label>
                        <input type="password" class="form-control" name="password">
                    </div>

                    <div class="form-group">
                        <label class="control-label">新しいパスワード<br>(確認用)</label>
                        <input type="password" class="form-control" name="password_confirmation">
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <button type="submit" class="conf-btn center-block">リセット</button>
                        </div>
                    </div>
                </form>
            </div>
                
        </div>
    </main>
	
@endsection
