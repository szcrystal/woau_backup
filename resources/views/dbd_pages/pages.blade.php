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
              <th class="col-md-3">タイトル</th>
              <th class="col-md-2">作成日</th>
              {{-- <th>サブタイトル</th> --}}
              <th class="col-md-5">コンテンツ</th>
              {{-- <th class="col-md-2">リンク名</th> --}}
              <th></th>
              
            </tr>
          </thead>
          
          <tbody>
        
            @foreach($objs as $page)
                <tr>
                    <td>
                        {{ $page->id }}
                    </td>
                    <td>
                        <strong>{{$page->title}}</strong>
                    </td>
                                        
                    <td>
                        {{getStrdate($page->updated_at)}}
                    </td>
                    {{--
                    <td>
                        {{$page->sub_title}}
                    </td>
                    --}}
                    <td>
                    	@if(strlen(trim(strip_tags($page->main_content))) > 170)
                        {{ str_limit(trim(strip_tags($page->main_content)), 170) }}
                        @else
                        {{ trim(strip_tags($page->main_content)) }}
                        @endif
                    </td>
                    {{--
                    <td>
                        {{$page->url_name}}
                    </td>
                    --}}
                    <td>
                        <a href="{{getUrl('dashboard/'.$page->slug.'-edit/'. $page->id)}}" class="btn btn-primary btn-sm center-block">編集</a>
                    </td>
                </tr>
            @endforeach
        
        	</tbody>
        </table>
    </div>
    
    <?php echo $objs->render(); ?>
    

    
    @endsection

