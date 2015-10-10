@extends('appDashBoard')

@section('content')
	
	<h2 class="page-header"><span class="mega-octicon octicon-radio-tower"></span>{{ isset($article) ? 'トピックス編集':'トピックス新規追加'}}</h2>
    
    	@if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Error!!</strong> 追加できません<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        
       
    <div class="well">{{-- col-lg-8 --}}
    	<div class="bs-component">
      
      	{!! Form::open() !!}
        	<div class="well clearfix">
            	<div class="pull-left">
                    <a href="{{ getUrl('/dashboard/'.(isset($article) ? $article->slug : $slug)) }}" class="btn btn-success btn-sm"><span class="octicon octicon-triangle-left"></span>一覧へ戻る</a>
                </div>
                @if(isset($article))
                <div class="pull-left">
                    <a href="{{ getUrl('/topics/'.$article->id) }}" style="margin-left: 1em;" class="btn btn-warning btn-sm" target="_blank">サイトを確認</a>
                </div>
                @endif
				<div class="pull-right col-md-2">{{-- col-md-offset-10 --}}
                    <button type="submit" class="btn btn-primary btn-block"><span class="octicon octicon-sync"></span>更 新</button>
                </div>
            </div>
        
            <div class="checkbox">
                <label>
                    {!! Form::checkbox('closed', '非公開', (isset($article) && $article->closed == '非公開') ? true : false, []) !!}
                    このページを非公開にする
                </label><br>
                <small>変更後は更新ボタンを押して下さい</small>
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
          {{--
          <div class="form-group">
              <label>リンク名</label>
              {{ url('/') . '/' }}
              {!! Form::input('text', 'url_name', isset($article) ? $article->url_name : null, ['class' => '']) !!}
          </div>
          --}}
          <div class="form-group">
              <label>ヘッダーコンテンツ</label>
              {!! Form::textarea('intro_content', isset($article) ? $article->intro_content : null, ['class' => 'form-control']) !!}
          </div>
          
          @include('dbd_shared.mainContent')
          
          {{--
          <div class="form-group">
              <label>サブコンテンツ</label>
              {!! Form::textarea('sub_content', isset($article) ? $article->sub_content : null, ['class' => 'form-control']) !!}
          </div>
          --}}
          <br />

        	@include('dbd_shared.image')
          
          {!! Form::hidden('slug', isset($article) ? $article->slug : $slug) !!}
          <button type="submit" class="btn btn-primary btn-lg center-block w-btn"><span class="octicon octicon-sync"></span>更　新</button>
      {!! Form::close() !!}
      
		</div>
    </div>
    
    @if(isset($article))
            <div class="well clearfix">
            	<div class="pull-left">
                    <a href="{{ getUrl('/dashboard/topics') }}" class="btn btn-success btn-sm"><span class="octicon octicon-triangle-left"></span>一覧へ戻る</a>
                </div>
				<div class="pull-right">{{-- col-md-offset-10 --}}
                    <a href="{{ getUrl('/dashboard/delete/'. $article->id . '?t=topics') }}" class="btn btn-danger btn-sm"><span class="octicon octicon-trashcan"></span>この記事を削除する</a>
                </div>
            </div>
        @endif

@endsection
