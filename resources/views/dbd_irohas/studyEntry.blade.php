@extends('appDashBoard')

@section('content')

		
        <h1 class="page-header"><span class="mega-octicon octicon-repo"></span> 勉強会参加者一覧</h1>
    	@if(!isset($study_name))
        	@include('dbd_shared.search')
		@endif
        
        <div class="table-responsive">
        @if(! $objs->isEmpty())
            
            @if(isset($study_name))
            	<div style="margin-bottom: 3em;">
                    <a href="{{ getUrl('/dashboard/study-entry') }}" class="btn btn-success btn-sm"><span class="octicon octicon-triangle-left"></span>一覧へ戻る</a>
                </div>
            	<div>
                	<h3 class="page-header">勉強会：{{ $study_name }} の参加者</h3>
                </div>
            @endif
            
                <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                        	<th>勉強会ID</th>
                              <th class="col-md-2">勉強会名</th>
                              <th class="col-md-2">名前</th>
                              <th>メールアドレス</th>
                              <th>コメント</th>
                              <th>申込日</th>
                              @if(!isset($study_name))
                              <th></th>
                              @endif
                        </tr>
                      </thead>
                      
                      <tbody>
                        @foreach($objs as $obj)
                            <tr>
                            	<td>
                                    {{$obj->iroha_id}}
                                </td>
                                <td>
                                    {{$obj->study_name}}
                                </td>
                                <td>
                                    <a href="{{getUrl('dashboard/show-profile/'. $obj->user_id)}}">{{$obj->user_name}}</a>
                                </td>
                                <td>
                                    <a href="mailto:{{$obj->user_mail}}">{{$obj->user_mail}}</a>
                                </td>
                                <td>
                                    {{ $obj->note }}
                                </td>
                                <td>
                                    {{getStrDate($obj->created_at)}}
                                </td>
                               
                                @if(!isset($study_name))
                                <td>
                                    <a href="{{getUrl('dashboard/study-entry/'. $obj->iroha_id)}}" class="btn btn-primary btn-sm center-block">この勉強会の参加者</a>
                                </td>
                                @endif
                                
                                
                                
                                {{--
                                    <td>
                                        <a href="{{url('dashboard/admin-edit/'. $user->id)}}" class="btn btn-danger btn-sm center-block">削除</a>
                                    </td>
                                --}}
                                  
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <?php echo $objs->render(); ?>
            
        @endif
        
        @if(isset($study_name))
        <div>
            <a href="{{ getUrl('/dashboard/study-entry') }}" class="btn btn-success btn-sm"><span class="octicon octicon-triangle-left"></span>一覧へ戻る</a>
        </div>
        @endif
        
@endsection
