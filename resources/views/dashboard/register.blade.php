@extends('appDashBoard')

@section('content')
<div class="container-fluid">
	<div class="row">
    
    	<h2 class="page-header"><span class="mega-octicon octicon-key"></span> 管理者 登録／一覧</h2>
        
        @if (isset($status))
            <div class="alert alert-success">
                {{ $status }}
            </div>
        @endif
        
		<div style="" class="well clearfix">
			<div style="width:85%;" class="pull-left">
				<div class="panel-heading"></div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>ご確認ください !</strong><br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
                    
                    
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/dashboard/register') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label class="col-md-4 control-label">名前</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">メールアドレス</label>
                            <div class="col-md-7">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">パスワード</label>
                            <div class="col-md-7">
                                <input type="password" class="form-control" name="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">パスワード（確認用）</label>
                            <div class="col-md-7">
                                <input type="password" class="form-control" name="password_confirmation">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-4 control-label">登録する管理者にパスワードを<br />メールで知らせる</label>
                            <div class="col-md-7">
                                <input type="checkbox" style="margin-top:1em;" name="notice_pass" value="1">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-7 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">登　録</button>
                            </div>
                        </div>
                    </form>
                    
                    
				</div>
			</div>
		</div>
        
        </div>
        </div>
       
       
       <div class="container-fluid">
		<div class="row">
        
        @if (session('ad_stat'))
            <div class="alert alert-warning">
                {{ session('ad_stat') }}
            </div>
        @endif
        
        @if($users)
            <div style="margin-top: 1.5em;" class="table-responsive">
                <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th class="col-md-3">名前</th>
                          <th class="col-md-4">メールアドレス</th>
                          <th class="col-md-3">作成日</th>
                          <th>ACTION</th>
                          
                        </tr>
                      </thead>
                      
                      <tbody>
                      	<?php $i = 0; ?>
                        @foreach($users as $user)
                            <tr>
                                <td>
                                    {{$user->id}}
                                </td>
                                <td>
                                    <strong>{{$user->name}}</strong>
                                </td>
                                <td>
                                    {{$user->email}}
                                </td>
                                <td>
                                    {{$user->updated_at}}
                                </td>
                                <td>
                                	@if($i > 0)
                                    {!! Form::open(['action'=>'DashBoardController@postAdminDel']) !!}
                                    {!! Form::hidden('ad_id', $user->id) !!}
                                    {!! Form::hidden('ad_del', session('ad_del')) !!}
                                      <button type="submit" class="btn btn-danger btn-sm btn-block"><span class="octicon octicon-trashcan"></span>削除</button>
                                    {!! Form::close() !!}
                                    @else
                                    	<span class="octicon octicon-dash"></span>
                                    @endif
                                </td>
                            </tr>
                            <?php $i++; ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
   
	</div>{{-- row --}}
</div>
@endsection
