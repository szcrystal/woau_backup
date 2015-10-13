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
            
			@include('dbd_shared.introContent')
          
			@include('dbd_shared.mainContent')

          <br>
          <div class="form-group">
              <label>カテゴリー</label>
            	<div>

                <?php 
                	//未使用の関数
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

				<?php $sw = 0; ?>
                
                @foreach($cateObj as $cate)
                	<?php //指定されているカテゴリーにchecked属性を付ける 編集（$articleセット時）orエラー時（old()セット時）
                        if(count(old()) > 0) { // エラー時の判別、if (count($errors) > 0)でも可
                            $oldCates = old('category');
                            
                            if(count($oldCates) > 0) {
                                foreach($oldCates as $oldCate) :
                                    if($oldCate == $cate->id) :
                                        $sw = 1; break; 
                                    else :
                                        $sw = 0;
                                    endif;
                                endforeach;
                            }
                        }
                        elseif(isset($rels)) {
                            
                            foreach($rels as $rel) :
                                if($rel->cate_id == $cate->id) :
                                    $sw = 1; break;
                                else :
                                    $sw = 0;
                                endif;
                            endforeach;
                            
                        }
                    ?>
                
                	<label class="checkbox-inline">
                    	<input type="checkbox" name="category[]" value="{{$cate->id}}"{{$sw == 1 ? ' checked="checked"':''}}>{{$cate->c_name}}
                        
                        {{--
                        	<input type="checkbox" name="category[]" value="{{$cate->id}}"{{isset($rels) ? relfunc($rels,$cate->id) : ''}}>{{$cate->name}}
                        --}}
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
