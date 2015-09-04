@extends('appDashBoard')

@section('content')
	<h2 class="page-header"><span class="mega-octicon octicon-file-directory"></span>{{ isset($article) ? '案件情報 編集':'案件情報 新規追加'}}</h2>
    
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
                    <a href="{{ getUrl('/dashboard/jobs') }}" class="btn btn-success btn-sm"><span class="octicon octicon-triangle-left"></span>一覧へ戻る</a>
                </div>
                @if(isset($article))
                <div class="pull-left">
                    <a href="{{ getUrl('recruit/job/'.$article->job_number) }}" style="margin-left: 1em;" class="btn btn-warning btn-sm" target="_blank"><span class="octicon octicon-arrow-right"></span>サイトを確認</a>
                </div>
                @endif
				<div class="pull-right col-md-2">{{-- col-md-offset-10 --}}
                    <button type="submit" class="btn btn-primary btn-block"><span class="octicon octicon-sync"></span>更 新</button>
                </div>
            </div>
        
        <div class="form-group">
              <label>企業名</label>
              {!! Form::input('text', 'company_name', isset($article) ? $article->company_name : null, ['class' => 'form-control']) !!}
          </div>
        
          <div class="form-group">
              <label>タイトルフレーズ</label>
              {!! Form::input('text', 'title', isset($article) ? $article->title : null, ['class' => 'form-control']) !!}
          </div>
          <div class="form-group">
              <label>サブタイトル（リンク名などに使用されます。ページ内には表示されません。）</label>
              {!! Form::input('text', 'sub_title', isset($article) ? $article->sub_title : null, ['class' => 'form-control']) !!}
          </div>
          
          @include('dbd_shared.mainContent')
          
          <label style="margin: 2em 0;">*以下の項目はテーブル内に表示されます ----------------------</label>
          <div class="form-group">
              <label>企業名（上記の企業名と同様であれば未記入）</label>
              {!! Form::input('text', 'work_name', isset($article) ? $article->work_name : null, ['class' => 'form-control']) !!}
          </div>
          
          
          <div class="form-group">
              <label>ホームページ</label>
              {!! Form::input('text', 'work_site', isset($article) ? $article->work_site : null, ['class' => 'form-control', 'placeholder'=>'http://〜から入力して下さい']) !!}
          </div>

			<div class="form-group">
                  <label>形態</label>
                  {!! Form::input('text', 'work_format', isset($article) ? $article->work_format : null, ['class' => 'form-control']) !!}
              </div>
              
        	<div class="form-group">
              <label>勤務日数</label>
              {!! Form::input('text', 'work_day', isset($article) ? $article->work_day : null, ['class' => 'form-control']) !!}
          </div>
          
          <div class="form-group">
              <label>応募条件</label>
              {!! Form::textarea('work_require', isset($article) ? $article->work_require : null, ['class' => 'form-control', 'rows'=> 20]) !!}
          </div>
          
          <div class="form-group">
              <label>その他</label>
              {!! Form::textarea('work_other', isset($article) ? $article->work_other : null, ['class' => 'form-control', 'rows'=> 20]) !!}
          </div>
          {{--
          <div class="form-group">
              <label>その他（予備）</label>
              {!! Form::textarea('work_other_second', isset($article) ? $article->work_other_second : null, ['class' => 'form-control', 'rows'=> 10]) !!}
          </div>
			--}}
            
            @include('dbd_shared.imageJob')

            @include('dbd_shared.image')

          
          {!! Form::hidden('slug', isset($article) ? $article->slug : $slug) !!}
          
          <button type="submit" class="btn btn-primary btn-lg center-block w-btn"><span class="octicon octicon-sync"></span>更　新</button>
      {!! Form::close() !!}
      
      
		</div>
    </div>
    
    
    {{--
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
    --}}
    
    
    @if(isset($article))
        <div class="well clearfix">
            <div class="pull-left">
                <a href="{{ getUrl('/dashboard/jobs') }}" class="btn btn-success btn-sm"><span class="octicon octicon-triangle-left"></span>一覧へ戻る</a>
            </div>
            <div class="pull-right">{{-- pull-right --}}
                <a href="{{ getUrl('/dashboard/delete/'. $article->id . '?t=jobs') }}" class="btn btn-danger btn-sm"><span class="octicon octicon-trashcan"></span>この記事を削除する</a>
            </div>
        </div>
    @endif


@endsection
