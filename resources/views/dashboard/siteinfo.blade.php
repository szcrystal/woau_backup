@extends('appDashBoard')

@section('content')
	<h2 class="page-header"><span class="mega-octicon octicon-device-desktop"></span>サイト情報の編集</h2>
    
    	@if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Error!!</strong> 投稿できません。<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @elseif (count($errors)==0)
        {{--
        	<div class="alert">
        		<p style="color:orange;"><strong>Save is done</strong></p>
                <a href="/dashboard">一覧ページへ »</a>
            </div>
        --}}
        @endif
        
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        
              
    <div class="well">{{-- col-lg-8  col-sm-11 col-sm-offset-0　--}}
    	<div class="bs-component">
      
      {!! Form::open(['class'=>'form-horizontal site-info',]) !!}
      		<div class="clearfix">
            	
                <div class="pull-right col-md-2">{{-- col-md-offset-10 --}}
                    <button type="submit" class="btn btn-primary btn-block"><span class="octicon octicon-sync"></span>更 新</button>
                </div>
            </div>
        	<hr />
        	<h4 class="text-center"><span class="octicon octicon-color-mode"></span>サイトのメイン情報</h4>
          <br />
          <div class="form-group">
              <label class="col-sm-3 control-label">サイト名</label>
              <div class="col-sm-6">
              {!! Form::input('text', 'site_name', isset($article) ? $article->site_name : null, ['class' => 'form-control']) !!}
              </div>
          </div>
          <div class="form-group">
              <label class="col-sm-3 control-label">サイトの簡単な説明<br />（キャッチフレーズ）</label>
              <div class="col-sm-9">
              {!! Form::input('text', 'site_description', isset($article) ? $article->site_description : null, ['class' => 'form-control']) !!}
              </div>
          </div>
          <div class="form-group">
              <label class="col-sm-3 control-label">メールアドレス</label>
              <div class="col-sm-6">
              {!! Form::input('text', 'site_email', isset($article) ? $article->site_email : null, ['class' => 'form-control']) !!}
              </div>
          </div>
          
          
          <div class="form-group">
              <label class="col-sm-3 control-label">TOPページ ID</label>
              <div class="col-sm-2">
              {!! Form::input('text', 'top_id', isset($article) ? $article->top_id : null, ['class' => 'form-control']) !!}
              </div>
          </div>
          
          <div class="form-group">
              <label class="col-sm-3 control-label">1ページに表示する投稿数</label>
              <div class="col-sm-2">
              {!! Form::input('text', 'show_count', isset($article) ? $article->show_count : null, ['class' => 'form-control']) !!}
              </div>
          </div>
          
          
          <div class="form-group">
              <label class="col-sm-3 control-label">検索エンジンの<br />インデックスをON</label>
              	<div class="col-sm-2">
                {!! Form::checkbox('seo_sw', 1, (isset($article) && $article->seo_sw) ? true : false, ['style'=>'margin-top:1em;']) !!}
                </div>
                
          </div>
          
          <br />
          <hr />
          <br />
          
          <h4 class="text-center"><span class="octicon octicon-color-mode"></span>ユーザーに送信されるメールの本文</h4>
          <br />
          <div class="form-group">
              <label>お問い合わせ</label>
              {!! Form::textarea('mail_contact', isset($article) ? $article->mail_contact : null, ['class' => 'form-control']) !!}
          </div>
          
          <div class="form-group">
              <label>ユーザー登録</label>
              {!! Form::textarea('mail_register', isset($article) ? $article->mail_register : null, ['class' => 'form-control']) !!}
          </div>
          
          <div class="form-group">
              <label>案件応募</label>
              {!! Form::textarea('mail_jobentry', isset($article) ? $article->mail_jobentry : null, ['class' => 'form-control']) !!}
          </div>
          
          <div class="form-group">
              <label>勉強会参加</label>
              {!! Form::textarea('mail_studyentry', isset($article) ? $article->mail_studyentry : null, ['class' => 'form-control']) !!}
          </div>
          
          <div class="form-group">
              <label>メールフッター</label>
              {!! Form::textarea('mail_footer', isset($article) ? $article->mail_footer : null, ['class' => 'form-control']) !!}
          </div>

          {!! Form::hidden('id', isset($article) ? $article->id : 1) !!}
          <button type="submit" class="btn btn-primary btn-lg center-block w-btn"><span class="octicon octicon-sync"></span>更　新</button>
      {!! Form::close() !!}
      
		</div>
    </div>
    
    {{--
    @if(isset($article))
        <div class="well clearfix">
            <div class="pull-left">
                <a href="{{ getUrl('/dashboard/pages') }}" class="btn btn-success btn-sm"><span class="octicon octicon-triangle-left"></span>一覧へ戻る</a>
            </div>

        </div>
    @endif
	--}}

@endsection
