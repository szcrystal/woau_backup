@extends('appDashBoard')

	@section('content')
    
        @include('dbd_shared.title')    	
        
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
                  <th>状態</th>
                  <th class="col-md-3">タイトル</th>
                  <th>日付</th>
                  <th class="col-md-5">コンテンツ</th>
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
                        @if($obj->closed == '非公開')
                        <span style="color:#ff5000;">{{$obj->closed}}</span>
                        @else
                        {{$obj->closed}}
                        @endif
                    </td>
                    <td>
                        <strong>{{$obj->title}}</strong>
                    </td>
                                        
                    <td>
                        {{getStrdate($obj->created_at)}}
                    </td>
                    <td>
                        @if(strlen(trim(strip_tags($obj->main_content))) > 170)
                        {{ str_limit(trim(strip_tags($obj->main_content)), 170) }}
                        @else
                        {{ trim(strip_tags($obj->main_content)) }}
                        @endif
                    </td>
                    <td>
                        <a href="{{url('dashboard/blog-edit/'. $obj->id)}}" class="btn btn-primary btn-sm center-block">編集</a>
                    </td>
                </tr>
            @endforeach
            
            </tbody>
            </table>
        </div>
    
    <?php echo $objs->render(); ?>
    

    
    @endsection

