@extends('appDashBoard')

@section('content')
	
	<h2 class="page-header"><span class="mega-octicon octicon-file-text"></span> {{ isset($article) ? 'ブログ編集':'ブログ新規投稿'}}</h2>
    
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
                    <a href="{{ getUrl('/dashboard/blog') }}" class="btn btn-success btn-sm"><span class="octicon octicon-triangle-left"></span>一覧へ戻る</a>
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
                    <a href="{{ getUrl('/dashboard/blog') }}" class="btn btn-success btn-sm"><span class="octicon octicon-triangle-left"></span>一覧へ戻る</a>
                </div>
                @if(isset($article))
                <div class="pull-left">
                    <a href="{{ getUrl('/blog/'.$article->id) }}" style="margin-left: 1em;" class="btn btn-warning btn-sm" target="_blank">サイトを確認</a>
                </div>
                @endif
				<div class="pull-right col-md-2">{{-- col-md-offset-10 --}}
                    <button type="submit" class="btn btn-primary btn-block"><span class="octicon octicon-sync"></span>更 新</button>
                </div>
            </div>
        
          <div class="form-group">
              <label>タイトル</label>
              {!! Form::input('text', 'title', isset($article) ? $article->title : null, ['required', 'class' => 'form-control']) !!}
          </div>
          <div class="form-group">
              <label>サブタイトル</label>
              {!! Form::input('text', 'sub_title', isset($article) ? $article->sub_title : null, ['class' => 'form-control']) !!}
          </div>
          {{--
          <div class="form-group">
              <label>リンク名</label>
              {{ url('/') . '/' }}
              {!! Form::input('text', 'url_name', isset($article) ? $article->url_name : null, ['required', 'class' => '']) !!}
          </div>
          --}}
          <div class="form-group">
              <label>ヘッダーコンテンツ</label>
              {!! Form::textarea('intro_content', isset($article) ? $article->intro_content : null, ['class' => 'form-control']) !!}
          </div>
          
          @include('dbd_shared.mainContent')
          
          <div class="form-group">
              <label>フッターコンテンツ</label>
              {!! Form::textarea('sub_content', isset($article) ? $article->sub_content : null, ['class' => 'form-control']) !!}
          </div>
          
          <div class="form-group">
              <label>カテゴリー</label>
            	<div>

                <?php $sw = 0; ?>
                
                <?php 
                    function relfunc($relArg, $cid) {
                        foreach($relArg as $rel) {
                            if($rel->cate_id == $cid) {
                                $a = ' checked="checked"';
                                break;
                            } 
                            else {
                                $a = '';
                            }
                        }
                        return $a;
                    }
                ?>

                @foreach($cateObj as $cate)
                	
                	@if(isset($rels))
                        @foreach($rels as $rel)
                            @if($rel->cate_id == $cate->id)
                            <?php $sw = 1; break; ?>
                            @else
                            <?php $sw = 0; ?>
                            @endif
                        @endforeach
                    @endif
                
                	<label class="checkbox-inline">
                    	<input type="checkbox" name="category[]" value="{{$cate->id}}"{{$sw == 1 ? ' checked="checked"':''}}>{{$cate->c_name}}
                        {{--<input type="checkbox" name="category[]" value="{{$cate->id}}"{{isset($rels) ? relfunc($rels,$cate->id) : ''}}>{{$cate->name}}--}}
            		</label>
                @endforeach
                </div>
                
          </div>
        	
            @include('dbd_shared.image')
 			
          {!! Form::hidden('slug', isset($article) ? $article->slug : $slug) !!}
          <button type="submit" class="btn btn-primary btn-lg center-block w-btn"><span class="octicon octicon-sync"></span>更　新</button>
      {!! Form::close() !!}
      
		</div>
    </div>
    
    
    @if(isset($article))
        <div class="well clearfix">
            <div class="pull-left">
                <a href="{{ getUrl('/dashboard/blog') }}" class="btn btn-success btn-sm"><span class="octicon octicon-triangle-left"></span>一覧へ戻る</a>
            </div>
            <div class="pull-right">{{-- col-md-offset-10 --}}
                <a href="{{ getUrl('/dashboard/delete/'. $article->id . '?t=blog') }}" class="btn btn-danger btn-sm"><span class="octicon octicon-trashcan"></span>この記事を削除する</a>
            </div>
        </div>
    @endif

@endsection
