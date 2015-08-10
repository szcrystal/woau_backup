@extends('appDashBoard')

@section('content')
	
	<h2 class="page-header"><span class="mega-octicon octicon-file-text"></span> {{ isset($article) ? 'カテゴリー編集':'カテゴリー新規追加'}}</h2>
    
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
        
        {{--
        @if(isset($article))
            <div class="well clearfix">
            	<div class="pull-left">
                    <a href="{{ getUrl('/dashboard/category') }}" class="btn btn-success btn-sm">« 一覧へ戻る</a>
                </div>
				<div class="pull-right">
                    <a href="{{ getUrl('/dashboard/delete/'. $article->id . '?t=topics') }}" class="btn btn-danger btn-sm">この記事を削除する</a>
                </div>
            </div>
        @endif 
        --}}
       
    <div class="well">{{-- col-lg-8 --}}
    	<div class="bs-component">
      
      	{!! Form::open() !!}
        
        	<div class="well clearfix">
            	<div class="pull-left">
                    <a href="{{ getUrl('/dashboard/category') }}" class="btn btn-success btn-sm">« 一覧へ戻る</a>
                </div>
				<div class="pull-right">{{-- col-md-offset-10 --}}
                    <button type="submit" class="btn btn-primary btn-md btn-block"><span class="octicon octicon-sync"></span>更 新</button>
                </div>
            </div>
        
          <div class="form-group">
              <label>カテゴリー名</label>
              {!! Form::input('text', 'name', isset($article) ? $article->name : null, ['required', 'class' => 'form-control']) !!}
          </div>
          <div class="form-group">
              <label>スラッグ</label><small> （半角英数字、及びハイフンのみで入力して下さい）</small>
              {!! Form::input('text', 'slug', isset($article) ? $article->slug : null, ['class' => 'form-control']) !!}
          </div>
          
          <button type="submit" style="width: 30%;" class="btn btn-primary btn-lg center-block"><span class="octicon octicon-sync"></span>更 新</button>
      {!! Form::close() !!}
      
		</div>
    </div>
    
    

@endsection
