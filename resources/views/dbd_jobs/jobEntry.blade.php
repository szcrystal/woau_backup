@extends('appDashBoard')

@section('content')

		
        <h1 class="page-header"><span class="mega-octicon octicon-file-directory"></span> 案件応募者一覧</h1>
    	
        @include('dbd_shared.search')

        
        <div class="table-responsive">
        @if(! $objs->isEmpty())
            
            @if(isset($job_name))
            	<div>
                    <a href="{{ getUrl('/dashboard/jobs-entry') }}" class="btn btn-success btn-sm"><span class="octicon octicon-triangle-left"></span>一覧へ戻る</a>
                </div>
                <br />
            	<div class="alert alert-warning">
                	案件：{{ $job_name }} の応募者
                </div>
            @endif
            
                <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                        	<th>勉強会ID</th>
                              <th class="col-md-2">企業名</th>
                              <th class="col-md-2">応募者名</th>
                              <th>メールアドレス</th>
                              <th>コメント</th>
                              <th>応募日</th>
                              @if(!isset($job_name))
                              <th></th>
                              @endif
                        </tr>
                      </thead>
                      
                      <tbody>
                        @foreach($objs as $obj)
                            <tr>
                            	<td>
                                    {{$obj->job_id}}
                                </td>
                                <td>
                                    {{$obj->company_name}}
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
                               
                                @if(!isset($job_name))
                                <td>
                                    <a href="{{getUrl('dashboard/jobs-entry/'. $obj->job_id)}}" class="btn btn-primary btn-sm center-block">この案件の応募者</a>
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
        
        
        @if(isset($job_name))
        <div>
            <a href="{{ getUrl('/dashboard/jobs-entry') }}" class="btn btn-success btn-sm"><span class="octicon octicon-triangle-left"></span>一覧へ戻る</a>
        </div>
        @endif
        
@endsection
