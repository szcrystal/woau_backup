@extends('appDashBoard')

@section('content')
	
		<div class="col-md-8 col-md-offset-2">
        		
			<div class="panel panel-default">
            		
				<div class="panel-heading">
                	<img src="/images/main/logo-s.png">
                </div>
                	
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>ログイン出来ません</strong><br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
                    {{--
                    <script>
                    	$(function(){
                        	$('input:eq(1)').focus();
                        });
                    </script>
                    --}}                  
                    
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/dashboard/login') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label class="col-md-4 control-label">メールアドレス</label>
                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}" autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">パスワード</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> ログイン状態を保存する
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">

                                <button type="submit" class="btn btn-primary">ログイン</button>
                                {{-- <a class="btn btn-link" href="{{ url('/password/email') }}">Forgot Your Password?</a> --}}
                            </div>
                        </div>
                    </form>
                        
				 
                </div>
			</div>
		</div>

@endsection
