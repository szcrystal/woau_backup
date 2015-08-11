@extends('appDashBoard')

	@section('content')
    
    
        <h1 class="page-header"><span class="mega-octicon octicon-info"></span> 監査役いろは一覧</h1>
        
        @if (session('status'))
            <div class="alert alert-warning">
                {{ session('status') }}
            </div>
        @endif
    	
        @include('dbd_shared.search')
        
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>ID</th>
              <th class="col-md-3">タイトル</th>
              <th class="col-md-2">作成日</th>
              <th class="col-md-5">コンテンツ</th>
              <th></th>
              
            </tr>
          </thead>
          <tbody>
          
    	<?php //echo "SESSION: " . session('del_key'); ?>
        
    	@foreach($objs as $obj)
        	<tr>
            	<td>
                	{{$obj->id}}
                </td>
    			<td>
	        		<strong>{{$obj->title}}</strong>
                </td>
                                    
                <td>
                	{{ getStrDate($obj->updated_at) }}
                </td>
                <td>
                	@if(strlen(trim(strip_tags($obj->main_content))) > 170)
                        	{{ str_limit(trim(strip_tags($obj->main_content)), 170) }}
                        @else
                        	{{ trim(strip_tags($obj->main_content)) }}
                        @endif
                </td>
                <td>
                	@if($obj->slug == 'irohas')
                	<a style="margin:auto;" href="{{url('dashboard/irohas-edit/'. $obj->id)}}" class="btn btn-primary btn-sm center-block">編集</a>
                    @else
                    <a style="margin:auto;" href="{{url('dashboard/study-edit/'. $obj->id)}}" class="btn btn-primary btn-sm center-block">編集</a>
                    @endif
                </td>
        	</tr>
        @endforeach
        
        </tbody>
        </table>
        </div>
    
    <?php echo $objs->render(); ?>
    

    
    @endsection
