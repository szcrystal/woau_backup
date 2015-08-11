@extends('appDashBoard')

@section('content')

		
        <h1 class="page-header"><span class="mega-octicon octicon-person"></span> 登録ユーザー一覧</h1>
    	
        @include('dbd_shared.search')
        
        <div style="overflow:scroll;" class="container-fluid">
        @if(! $objs->isEmpty())
            
                <table class="row table-striped table-bordered user-info">
                      <thead>
                        <tr>
                        	<th style="min-width:5em;"></th>
                          <th style="min-width:5em;">ID</th>
                          <th style="min-width:5em;">登録番号</th>
                          <th style="min-width:15em;">名前</th>
                          <th style="min-width:15em;">メールアドレス</th>
                          <th style="min-width:9em;">生年月日</th>
                          <th style="min-width:6em;">所在地</th>
                          <th style="min-width:6em;">職歴</th>
                          <th style="min-width:6em;">役職</th>
                          <th style="min-width:6em;">出張の可否</th>
                          <th style="min-width:8em;">英語能力</th>
                          <th style="min-width:8em;">資格取得年</th>
                          <th style="min-width:15em;">過去の経験監査業種</th>
                          <th style="min-width:15em;">監査時のポジション</th>
                          <th style="min-width:9em;">登録日時</th>
                          <th></th>
                        </tr>
                      </thead>
                      
                      <tbody>
                        @foreach($objs as $user)
                            <tr>
                            	<td>
                                    <a href="{{url('dashboard/show-profile/'. $user->id)}}" class="btn btn-primary btn-sm center-block">詳細</a>
                                </td>
                            	<td>
                                    {{$user->id}}
                                </td>
                                <td>
                                    {{$user->user_number}}
                                </td>
                                <td>
                                    {{$user->name}}
                                </td>
                                <td>
                                    <a href="mailto:{{$user->email}}">{{$user->email}}</a>
                                </td>
                                <td>
                                    {{getStrDate($user->birth)}}
                                </td>
                                <td>
                                    {{$user->address}}
                                </td>
                                <td>
                                    {{$user->work_history}}
                                </td>
                                <td>
                                    {{$user->office_posi}}
                                </td>
                                <td>
                                    {{$user->is_trip}}
                                </td>
                                <td>
                                    {{$user->eng_ability}}
                                </td>
                                <td>
                                    {{$user->get_year}}
                                </td>
                                <td>
                                    {{$user->exp_type}}
                                </td>
                                <td>
                                    {{$user->audit_posi}}
                                </td>
                                <td>
                                    {{ getStrDate($user->created_at) }}
                                </td>
                                <td>
                                    <a href="{{url('dashboard/show-profile/'. $user->id)}}" class="btn btn-primary btn-sm center-block">詳細</a>
                                </td>
                                
                                
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
        
@endsection