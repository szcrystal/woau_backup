<div class="clearfix">
	<?php 
//    	if(Request::is('*/pages'))
//    		$link = 'pages';
//		else if(Request::is('*/jobs'))
//        	$link = 'jobs';
//        else if(Request::is('*/jobs-entry'))
//        	$link = 'jobs-entry';
//        else if(Request::is('*/topics'))
//        	$link = 'topics';
//        else if(Request::is('*/irohas'))
//        	$link = 'irohas';
//        else if(Request::is('*/study'))
//        	$link = 'study';
//        else if(Request::is('*/blog'))
//        	$link = 'blog';
//        else if(Request::is('*/category'))
//        	$link = 'category';
//		else if(Request::is('*/userinfo'))
//        	$link = 'userinfo';
//        else if(Request::is('*/study-entry'))
//        	$link = 'study-entry';
//        else
//        	$link = '';
    
    $link = Request::path();
    //$link = str_replace('dashboard');
    ?>
	
    
    @if(isset($searchStr))
    <a href="{{ getUrl(Request::path()) }}" class="btn btn-success pull-left btn-sm"><span class="octicon octicon-triangle-left"></span>一覧へ戻る</a>
    
    @endif
    
    <div class="pull-right lead">
        <form method="get" class="form-inline">
            {{-- <span class="octicon octicon-search"></span> --}}
            <input type="search" name="s" class="form-control" placeholder="Search...">
            <button type="submit" class="btn btn-default text-center"><span style="color:#555; margin:0;" class="octicon octicon-search"></span></button>
        </form>
    </div>
</div>
    
    @if(isset($searchStr))
    <p style="color:#555; font-weight:bold; margin-left:0;" class="lead">
        @if($objs->total() == 0)
        [ {{$searchStr}} ] の検索結果：条件に合うデータがありません。
        @else
        [ {{$searchStr}} ] の検索結果：{{ $objs->total() }}件 {{-- paginateのヘルパー --}}
        @endif
    </p>
    @endif

