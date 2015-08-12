@extends('app')

@section('content')

    <div class="panel center-block clearfix">
        
        <div class="panel-heading">
            <img src="/images/main/i-lock.png">
            ログイン（登録がお済みの方）
        </div>

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>ご確認ください!</strong><br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            {{--
            <div class="form-group">
                <p>メールアドレスとパスワードを入力し「ログイン」ボタンを押して下さい。</p>   
            </div>
            --}}
          <div class="panel-body">  
            <form class="form-horizontal" role="form" method="POST">
            
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <label class="col-md-2 control-label">ユーザーID</label>
                    <div class="col-md-10">
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="メールアドレスを入力して下さい">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">パスワード</label>
                    <div class="col-md-10">
                        <input type="password" class="form-control" name="password" placeholder="6文字以上" autofocus>
                    </div>
                </div>
                
                <div class="">
                    <a class="btn btn-link pull-right" href="{{ getUrl('/password/email') }}">パスワードをお忘れですか？</a><br />
                </div>
                
                <div class="">
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
                        <button type="submit" class="send-btn center-block">ログイン</button>
                    </div>
                </div>
            </form>   
        
        </div>
        
        <div class="text-center">
            初めてご利用される方はこちらから
            <a class="link-btn" href="{{ getUrl('/auth/register') }}">新規登録</a>
        </div>
        
    </div>

@endsection
