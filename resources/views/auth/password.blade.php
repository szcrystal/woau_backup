@extends('app')

@section('content')
<div class="panel center-block clearfix">
				
        <div class="panel-heading">
            <img src="/images/main/i-lock.png">パスワードをリセット
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
                <p style="margin-bottom:2em;">メールアドレスを入力して下さい。<br />パスワードリセット用のリンクを記載したメールを送信します。</p>
                
                <div class="form-group">
                    <label class="col-md-3 control-label">メールアドレス</label>
                    <div class="col-md-9">
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        <button type="submit" class="send-btn center-block">
                            送 信
                        </button>
                    </div>
                </div>
            </form>
				
	</div>
</div>
@endsection
