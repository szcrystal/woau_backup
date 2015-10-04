@extends('appDashBoard')

	@section('content')
    
    		<?php if($siteInfo = DB::table('siteinfos')->first()) {
            		$info = $siteInfo->site_name;
                } else {
                	$info = 'sample';
                }
            ?> 
          <h1 class="page-header"><span class="mega-octicon octicon-home"></span> DashBoard&nbsp;&nbsp;&nbsp;[ {{ $info }} ]</h1>

          <div class="row placeholders">
            <div class="col-xs-6 col-sm-3 placeholder">
            	<a href="{{getUrl('dashboard/job-add')}}" class="text-muted">
              	{{-- <img data-src="holder.js/200x200/auto/sky" class="img-responsive" alt="Generic placeholder thumbnail"> --}}
              	<h4><span class="mega-octicon octicon-file-directory"></span> 案件</h4>
              	<p>新規案件を追加 <span class="octicon octicon-chevron-right"></span></p>
              </a>
            </div>
            <div class="col-xs-6 col-sm-3 placeholder">
              	<a href="{{getUrl('dashboard/topics-add')}}" class="text-muted">
	              	<h4><span class="mega-octicon octicon-radio-tower"></span> トピックス</h4>
              		<p>新規トピックスを追加 <span class="octicon octicon-chevron-right"></span></p>
                </a>
            </div>
            <div class="col-xs-6 col-sm-3 placeholder">
              	<a href="{{getUrl('dashboard/study-add')}}" class="text-muted">
	              	<h4><span class="mega-octicon octicon-repo"></span> 勉強会</h4>
              		<p>新規勉強会を追加 <span class="octicon octicon-chevron-right"></span></p>
                </a>
            </div>
            <div class="col-xs-6 col-sm-3 placeholder">
              	<a href="{{getUrl('dashboard/blog-add')}}" class="text-muted">
	              	<h4><span class="mega-octicon octicon-file-text"></span> ブログ</h4>
              		<p>新規ブログを追加 <span class="octicon octicon-chevron-right"></span></p>
                </a>
            </div>
          </div>
    
    <div class="row clearfix">
    
    <div class="pull-left col-md-4">
    <h4>管理者: {{ Auth::user()->name }} さんがログイン中</h4>
    <div style="width:auto; height:10em;">
    	<a href="{{getUrl('dashboard/register')}}" class="btn btn-d">新規管理者登録 »</a>
    </div>
    </div>
    
    <div class="pull-left col-md-4">
	    <h4>登録案件数: @if(isset($jobObjs)) {{ $jobObjs->count() }} @else 0 @endif 件</h4>
    	<div>
        	<a href="{{getUrl('dashboard/jobs')}}" class="btn btn-d">案件情報一覧 »</a><br />
            <h5>最近登録した案件</h5>
            @if(isset($jobObjs))
                @foreach($jobObjs as $jobObj)
                	<a href="{{getUrl('dashboard/jobs-edit/'.$jobObj->id)}}"><span class="octicon octicon-primitive-dot"></span> {{str_limit($jobObj->company_name, 30)}}</a><br />
                @endforeach
            @endif
        </div>
    </div>

	<div class="pull-left col-md-4">
	    <h4>登録ユーザー数: @if(isset($userObjs)){{ $userObjs->count() }}@else 0 @endif 名</h4>
    	<div>
        	<a href="{{getUrl('dashboard/userinfo')}}" class="btn btn-d">登録ユーザーを確認 »</a><br />
            <h5 style="margin-top: 1em;">最近の登録ユーザー</h5>
            @if(isset($userObjs))
                @foreach($userObjs as $userObj)
                    <a href="{{getUrl('dashboard/show-profile/'.$userObj->id)}}"><span class="octicon octicon-primitive-dot"></span> {{$userObj->name}}</a><br />
                @endforeach
            @endif
        </div>
    </div>

	</div>
    
    <br />
    
    <h4><span class="octicon octicon-primitive-dot"></span>更新する項目の内容</h4>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>タイトル</th>
              <th class="col-md-3">サブタイトル</th>
              <th>ヘッダーコンテンツ</th>
              <th>メインコンテンツ</th>
              <th></th>
              
            </tr>
          </thead>
          <tbody>
          
    	<?php //echo "SESSION: " . session('del_key'); ?>
        
        	<tr>
            	<td>
                	メインのタイトル
                </td>
    			<td>
	        		メニューなどに表示されるリンク名。コンテンツ内には表示されません
                </td>
                                    
                <td>
                	前置き説明など、前章に当たるコンテンツ
                </td>
                <td>
                	メインのコンテンツ
                </td>
                <td>
                	変更後は必ず更新ボタンを押して下さい
                </td>
        	</tr>
        
        </tbody>
        </table>
        </div>
    
    	<?php 
        if(env('SERVER_NAME') == 'localhost') //env()ヘルパー：環境変数（$_SERVER）の値を取得 .env内の値も$_SERVERに入る
			print_r($_SERVER); ?>
    
    @endsection

