@extends('app')

    @section('content')
        <h2 class="page-header">ユーザー登録情報</h2>
        	
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
        
        	<div class="clearfix">
        		<a href="{{ url('profile/edit/'.$user->user_number) }}" class="btn btn-success pull-right">編集</a>
            </div>
            
			<div class="table-responsive">
                <table class="table table-bordered user-table">
                  <colgroup>
                    <col class="col-xs-2">
                    <col class="col-xs-7">
                  </colgroup>
                  {{--<thead>
                    <tr>
                      <th>Class</th>
                      <th>Description</th>
                    </tr>
                  </thead>
                  --}}
                  
                  <tbody>
                    <tr>
                      <th scope="row">登録番号</th>
                      <td>{{$user->user_number}}</td>
                    </tr>

                    <tr>
                      <th scope="row">
                        名前
                      </th>
                      <td>{{$user->name}}</td>
                    </tr>
                    <tr>
                      <th scope="row">
                        メールアドレス
                      </th>
                      <td>{{$user->email}}</td>
                    </tr>
                    <tr>
                      <th scope="row">
                        生年月日
                      </th>
                      
                      <?php 
                      	$birth = explode('-', $user->birth);
                        
                      ?>
                      <td>
                      	{{$birth[0]=='0000' ? '--' : $birth[0]}}年 
                      	{{$birth[1]=='00' ? '--' : $birth[1]}}月 
                        {{$birth[2]=='00' ? '--' : $birth[2]}}日 
                      </td>
                    </tr>
                    
                    <tr>
                      <th scope="row">
                        所在地
                      </th>
                      <td>{{$user->address}}</td>
                    </tr>
                    
                    <tr>
                      <th scope="row">
                        職歴
                      </th>
                      <td>{{$user->work_history}}</td>
                    </tr>
                    
                    <tr>
                      <th scope="row">
                        役職
                      </th>
                      <td>{{$user->office_posi}}</td>
                    </tr>
                    
                    <tr>
                      <th scope="row">
                        出張の可否
                      </th>
                      <td>{{$user->is_trip}}</td>
                    </tr>
                    
                    <tr>
                      <th scope="row">
                        英語能力
                      </th>
                      <td>{{$user->eng_ability}}</td>
                    </tr>
                    
                    <tr>
                      <th scope="row">
                        公認会計士資格取得年
                      </th>
                      <td>{{$user->get_year == 0 ? '--' : $user->get_year}}年</td>
                    </tr>
                    
                    <tr>
                      <th scope="row">
                        過去の経験監査業種
                      </th>
                      <td>{{$user->exp_type}}</td>
                    </tr>
                    
                    <tr>
                      <th scope="row">
                        監査時のポジション
                      </th>
                      <td>{{$user->audit_posi}}</td>
                    </tr>
                    
                    {{--
                    <tr>
                      <th scope="row">
                        登録日時
                      </th>
                      <td>{{$user->created_at}}</td>
                    </tr>
					--}}
                  </tbody>
                </table>
              </div>
              
         
        @if(! $jobObjs -> isEmpty())
        <h2 class="page-header">応募した企業</h2> 
			<div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>企業番号</th>
                      <th class="col-md-3">企業名</th>
                      <th class="col-md-5">応募時のコメント</th>
                      {{-- <th>添付ファイル名</th> --}}
                      <th>応募日</th>
                      <th>企業情報</th>
                      
                    </tr>
                  </thead>
                  
                  <tbody>
                    @foreach($jobObjs as $jobObj)
                        <tr>
                            <td><?php $num = DB::table('jobs')->find($jobObj->job_id) -> job_number; ?>
                                {{ $num }}
                            </td>
                            <td>
                                {{ $jobObj->company_name }}
                            </td>
                            
                            <td>
                                {{ $jobObj->note }}<br />
                                添付ファイル：{{ $jobObj->attach_name }}
                            </td>
                            {{--
                            <td>
                                {{ $jobObj->attach_name }}
                            </td>
                            --}}
                                                
                            <td>
                                {{ getStrDate($jobObj->created_at)}}
                            </td>

                            <td>
                            	
                                <a href="{{ getUrl('recruit/job/'. $num) }}" class="btn btn-primary btn-sm center-block">企業を確認</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif  
                

        @if(! $studyObjs->isEmpty())
        <h2 class="page-header">参加申し込み勉強会</h2> 
			<div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>企業番号</th>
                      <th class="col-md-3">勉強会</th>
                      <th class="col-md-5">応募時のコメント</th>
                      <th>応募日</th>
                      <th>勉強会情報</th>
                    </tr>
                  </thead>
                  
                  <tbody>
                
                    @foreach($studyObjs as $studyObj)
                        <tr>
                            <td>{{ $studyObj->iroha_id }}</td>
                            
                            <td>{{ $studyObj->study_name }}</td>
                            
                            <td>{{ $studyObj->note }}</td>
                                                
                            <td>{{ getStrDate($studyObj->created_at)}}</td>

                            <td><a href="{{ getUrl('iroha/study/'. $studyObj->iroha_id) }}" class="btn btn-primary btn-sm center-block">企業を確認</a></td>
                        </tr>
                    @endforeach
                
                    </tbody>
                </table>
            </div>
        
        @endif
        
        
        {{--
            @foreach($userObj as $key => $val)
                @if($key != '_token')   
                        <th scope="row">{{$key}}</th>
                        <td>{{$val}}</td>

                @endif
            @endforeach
          --}}  

            
            
            


{{--
        {!! Form::open(array( 'url' => 'reservation/finish', 'method' => 'post' )) !!}
              
              {!! Form::hidden('name', $datas['name']) !!}

              {!! Form::hidden('mail', $datas['mail']) !!}

              {!! Form::hidden('address', $datas['address']) !!}

              {!! Form::hidden('use_addr', $datas['use_addr']) !!}

              {!! Form::hidden('note', $datas['note']) !!}
          
          
          	{!! Form::submit('apply', array('class'=>'btn btn-primary', 'name' => '_apply')) !!}
			{!! Form::submit('return', array('class'=>'btn btn btn-warning', 'name' => '_return')) !!}
      
      	{!! Form::close() !!}
--}}

    @endsection
