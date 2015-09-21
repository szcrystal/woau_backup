@extends('app')

@section('content')
	<main class="wrap-pw">
    	<h1 class="main-title">パスワードをリセット</h1>

		<div class="panel orgPanel center-block clearfix">
				
            <div class="panel-heading">
                <h2></h2>
                {{-- <img src="/images/main/i-lock.png">パスワードをリセット --}}
            </div>
            
            @if (session('status'))
                <div class="alert alert-success">
                    {!! session('status') !!}
                </div>
                
            @endif

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>ご確認下さい!</strong><br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <p class="forget-pass">メールアドレスを入力して下さい。<br />パスワードリセット用のリンクを記載したメールを送信します。</p>
                    
                    <div class="form-group">
                        <label class="control-label">メールアドレス</label>
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                        
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <button type="submit" class="conf-btn center-block">送 信</button>
                        </div>
                    </div>
                </form>
            </div>
    	</div>
    </main>
@endsection
