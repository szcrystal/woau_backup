@extends('appDashBoard')

@section('content')
	<h2 class="page-header"><span class="octicon octicon-book"></span>{{ isset($article) ? '固定ページ 編集':'固定ページ 新規追加'}}</h2>
    
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
      
      {!! Form::open() !!}
      		<div class="well clearfix">
            	<div class="pull-left">
                    <a href="{{ getUrl('/dashboard/pages') }}" class="btn btn-success btn-sm"><span class="octicon octicon-triangle-left"></span>一覧へ戻る</a>
                </div>
                @if(isset($article))
                <div class="pull-left">
                    <a href="{{ getUrl($article->url_name) }}" style="margin-left: 1em;" class="btn btn-warning btn-sm" target="_blank"><span class="octicon octicon-arrow-right"></span>サイトを確認</a>
                </div>
                @endif
				<div class="pull-right col-md-2">{{-- col-md-offset-10 --}}
                    <button type="submit" class="btn btn-primary btn-block"><span class="octicon octicon-sync"></span>更 新</button>
                </div>
            </div>
            
            <div class="checkbox">
            	@if(isset($article) && DB::table('siteinfos')->first()->top_id == $article->id)
            		<small>　※このページはTOPページです。公開状態の変更は出来ません</small>
                @else
                <label>
                    {!! Form::checkbox('closed', '非公開', (isset($article) && $article->closed == '非公開') ? true : false, []) !!}
                    このページを非公開にする
                </label><br>
                <small>変更後は更新ボタンを押して下さい</small>
                @endif
            </div>
        
        	@if(isset($article) && $article->closed == '非公開')
        	<p><span class="octicon octicon-issue-opened"></span>このページは非公開です。</p>
        	@endif
        
        <div class="form-group">
              <label>日付<em>（必須）</em></label>
              <?php 
              	$past = isset($article) ? strtotime($article->created_at) : time(); 
                //$past = getdate($past); 
            	?>
              {!! Form::input('text', 'date_y', date('Y', $past), ['required', 'class' => 'date form-control']) !!}年
              
              {!! Form::input('text', 'date_m', date('n', $past), ['required', 'class' => 'date form-control']) !!}月
              
              {!! Form::input('text', 'date_d', date('j', $past), ['required', 'class' => 'date form-control']) !!}日
          </div>
        
          <div class="form-group">
              <label>タイトル<em>（必須）</em></label>
              {!! Form::input('text', 'title', isset($article) ? $article->title : null, ['required', 'class' => 'form-control']) !!}
          </div>
          <div class="form-group">
              <label>サブタイトル<em>（必須：リンク名の表示に使用されます。コンテンツ内には表示されません。）</em></label>
              {!! Form::input('text', 'sub_title', isset($article) ? $article->sub_title : null, ['class' => 'form-control']) !!}
          </div>
          
          <div class="form-group">
              <label class="form-control-static">リンク名　{{ url('/') . '/' }}</label>
              @if(isset($article) && DB::table('siteinfos')->first()->top_id == $article->id)
            	<small>　※このページはTOPページです。リンク名は変更出来ません</small>
              @else
              {!! Form::input('text', 'url_name', isset($article) ? $article->url_name : null, ['required', 'class' => 'i-radi']) !!}
              <label><em>（必須）</em></label>
              @endif
          </div>
          
          <div class="form-group">
              <label>ヘッダーコンテンツ</label>
              {!! Form::textarea('intro_content', isset($article) ? $article->intro_content : null, ['class' => 'form-control', 'rows'=>10]) !!}
          </div>
          
          @include('dbd_shared.mainContent')
          
          {{--
          <div class="form-group">
              <label>サブコンテンツ</label>
              {!! Form::textarea('sub_content', isset($article) ? $article->sub_content : null, ['class' => 'form-control']) !!}
          </div>
          --}}

        	@include('dbd_shared.image')

          
          {!! Form::hidden('slug', 'pages') !!}
          <button type="submit" class="btn btn-primary btn-lg center-block w-btn"><span class="octicon octicon-sync"></span>更　新</button>
      {!! Form::close() !!}
      
      
      
		</div>
    </div>
    
    
    <div>
      <form id="insertLink" class="well">
      	<div class="form-group">
            <label>URL</label>
      		<input type="text" name="linkUrl" class="linkUrl form-control col-md-9" value="" />
        </div>
        <div class="form-group">
            <label>リンク文字列</label>
      		<input type="text" name="linkStr" class="linkStr form-control col-md-9" value="" />
        </div>
        
        <div style="margin-top: 1em;" class="pull-right">
        <input type="submit" value="insert" class="btn btn-primary btn-sm pull-left" />
        <input type="button" name="cancel" value="cancel" class="btn btn-default btn-sm center-block pull-left" />
        </div>
      </form>
      </div>
    
    
    
    @if(isset($article))
        <div class="well clearfix">
            <div class="pull-left">
                <a href="{{ getUrl('/dashboard/pages') }}" class="btn btn-success btn-sm"><span class="octicon octicon-triangle-left"></span>一覧へ戻る</a>
            </div>
            <div class="pull-right">
            	@if(isset($article) && DB::table('siteinfos')->first()->top_id == $article->id)
                <small>TOPページは削除出来ません</small>
                @else
                <a href="{{ getUrl('/dashboard/delete/'. $article->id . '?t=pages') }}" class="btn btn-danger btn-sm"><span class="octicon octicon-trashcan"></span>この記事を削除する</a>
                @endif
            </div>
        </div>
    @endif


@endsection
