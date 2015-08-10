@extends('appDashBoard')

	@section('content')
    
    
        <h1 class="page-header"><span class="mega-octicon octicon-megaphone"></span> トピックス一覧</h1>
        
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
              
            
            @foreach($objs as $topic)
                <tr>
                    <td>
                        {{$topic->id}}
                    </td>
                    <td>
                        <strong>{{$topic->title}}</strong>
                    </td>
                                        
                    <td>
                        {{ getStrDate($topic->updated_at) }}
                    </td>
                    <td>
                        @if(strlen(trim(strip_tags($topic->main_content))) > 170)
                        	{{ str_limit(trim(strip_tags($topic->main_content)), 170) }}
                        @else
                        	{{ trim(strip_tags($topic->main_content)) }}
                        @endif
                    </td>
                    <td>
                        <a href="{{url('dashboard/topics-edit/'. $topic->id)}}" class="btn btn-primary btn-sm center-block">編集</a>
                    </td>
                </tr>
            @endforeach
            
            </tbody>
            </table>
        </div>
    
    <?php echo $objs->render(); ?>
    

    
    @endsection

