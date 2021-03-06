@extends('appDashBoard')

@section('content')
	
	<h2 class="page-header"><span class="mega-octicon octicon-repo"></span> {{ 
    	isset($article) ? 
            	($article->slug == 'irohas' ? '監査役いろは編集' : '勉強会編集'):
                ($slug == 'irohas' ? '監査役いろは新規追加' : '勉強会新規追加')
      }}</h2>
    
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
                	
                    <?php $link = isset($article) ? $article->slug : $slug; ?>
                    
                    <a href="{{ getUrl('/dashboard/'. $link) }}" class="btn btn-success btn-sm"><span class="octicon octicon-triangle-left"></span>一覧へ戻る</a>
                </div>
                
                @if(isset($article))
                <div class="pull-left">
                	@if($article->slug == 'irohas')
                    <a href="{{ getUrl('/iroha/'.$article->id) }}" style="margin-left: 1em;" class="btn btn-warning btn-sm" target="_blank">サイトを確認</a>
                    @else
                    <a href="{{ getUrl('/iroha/study/'.$article->id) }}" style="margin-left: 1em;" class="btn btn-warning btn-sm" target="_blank">サイトを確認</a>
                    @endif
                </div>
                @endif
                
				<div class="pull-right col-md-2">{{-- col-md-offset-10 --}}
                    <button type="submit" class="btn btn-primary btn-block"><span class="octicon octicon-sync"></span>更 新</button>
                </div>
            </div>
        
            @include('dbd_shared.introContent')
                      
            @include('dbd_shared.mainContent')

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
                <a href="{{ getUrl('/dashboard/delete/'. $article->id . '?t=' . $article->slug) }}" class="btn btn-danger btn-sm"><span class="octicon octicon-trashcan"></span>この記事を削除する</a>
            </div>
        </div>
    @endif

@endsection
