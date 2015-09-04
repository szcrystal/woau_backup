@extends('appDashBoard')

	@section('content')
    
    
        <h1 class="page-header">
            <span class="mega-octicon octicon-file-directory"></span>案件情報一覧
        </h1>
        
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
              <th>企業番号</th>
              <th class="col-md-3">企業名</th>
              
              <th class="col-md-2">作成日</th>
              {{-- <th>サブタイトル</th> --}}
              <th class="col-md-4">コンテンツ</th>
              {{-- <th class="col-md-2">リンク名</th> --}}
              <th></th>
              
            </tr>
          </thead>
          
          <tbody>
        
            @foreach($objs as $obj)
                <tr>
                    <td>
                        {{ $obj->id }}
                    </td>
                    <td>
                        {{ $obj->job_number }}
                    </td>
                    <td>
                        <strong>{{$obj->company_name}}</strong>
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
                        <a href="{{getUrl('dashboard/'.$obj->slug.'-edit/'. $obj->id)}}" class="btn btn-primary btn-sm center-block">編集</a>
                    </td>
                </tr>
            @endforeach
        
        	</tbody>
        </table>
    </div>
    
    <?php echo $objs->render(); ?>
    

    
    @endsection

