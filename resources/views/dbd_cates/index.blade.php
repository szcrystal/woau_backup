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
        
       
    <div class="well">{{-- col-lg-8 --}}
    	<div style="width:70%;" class="bs-component">
      
      	@if(!isset($article))
      	{!! Form::open(['action'=>  'DashBoardController@postCategoryAdd']) !!}
        @else
        {!! Form::open() !!}
        @endif
        	
            {{--
        	<div class="well clearfix">
            	<div class="pull-left">
                    <a href="{{ getUrl('/dashboard/category') }}" class="btn btn-success btn-sm">« 一覧へ戻る</a>
                </div>
				<div class="pull-right">
                    <button type="submit" class="btn btn-primary btn-md btn-block">更 新</button>
                </div>
            </div>
        	--}}
          <div class="form-group">
              <label>カテゴリー名</label>
              {!! Form::input('text', 'c_name', isset($article) ? $article->c_name : null, ['class' => 'form-control']) !!}
          </div>
          <div class="form-group">
              <label>スラッグ</label><small> （半角英数字、及びハイフンのみで入力して下さい）</small>
              {!! Form::input('text', 'slug', isset($article) ? $article->slug : null, ['class' => 'form-control']) !!}
          </div>
          
          <button type="submit" style="width: 20%;" class="btn btn-primary btn-md center-block">更 新</button>
      {!! Form::close() !!}
      
		</div>
    </div>
    
    
    
    @if( isset($article) )
    <a href="{{ getUrl('/dashboard/category') }}" class="btn btn-success btn-sm"><span class="octicon octicon-triangle-left"></span>一覧へ戻る</a>
    
    @else
    	@include('dbd_shared.search')
    
        @if(session('del_status'))
            <div class="alert alert-warning">
                {{ session('del_status') }}
            </div>
        @endif
    
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>ID</th>
                  <th class="col-md-4">カテゴリー名</th>
                  <th class="col-md-4">スラッグ</th>
                  <th class="col-md-2">使用数</th>
                  <th></th>
                  
                </tr>
              </thead>
              <tbody>
            
            @foreach($objs as $obj)
                <tr>
                    <td>
                        {{$obj->id}}
                    </td>
                    <td>
                        <strong>{{$obj->c_name}}</strong>
                    </td>
                                        
                    <td>
                        {{$obj->slug}}
                    </td>
                    <td>
                    	{{ DB::table('cate_relations')->where('cate_id',$obj->id)->count() }}
                        {{-- $obj->cateRelation->count() --}}
                    </td>
                    <td>
                        <a href="{{url('dashboard/category-edit/'. $obj->id)}}" style="margin-bottom:0.5em;" class="btn btn-primary btn-sm center-block">編集</a>
                        {!! Form::open(['action'=>'DashBoardController@postCategoryDel']) !!}
                        {!! Form::hidden('cate_id', $obj->id) !!}
                        {!! Form::hidden('del_key', session('del_key')) !!}
                        
                        <button type="submit" style="width:100%;" class="btn btn-danger btn-sm center-block"><span class="octicon octicon-trashcan"></span>削除</button>
                        {!! Form::close() !!}
                        
                        {{-- <a href="{{url('dashboard/category-del/'. $obj->id)}}" class="btn btn-danger btn-sm center-block">削除</a> --}}
                    </td>
                </tr>
            @endforeach
            
            </tbody>
            </table>
        </div>
        
        <?php echo $objs->render(); ?>
    
    @endif

@endsection
