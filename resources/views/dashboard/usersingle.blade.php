@extends('appDashBoard')

@section('content')

<?php //echo $_SERVER['HTTP_USER_AGENT']; ?>
		
        <h1 class="page-header"><span class="mega-octicon octicon-person"></span>{{$user->name}} さんの登録情報</h1>
        
        <div class="clearfix">
        <a href="{{ getUrl('/dashboard/userinfo') }}" class="btn btn-success btn-sm"><span class="octicon octicon-triangle-left"></span>一覧へ戻る</a>
        </div>
        
        	<h2 style="margin-top:1em;" class="page-header"><span class="octicon octicon-primitive-dot"></span>ユーザー情報</h2>
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
                      <th>ID</th>
                      <td>{{$user->id}}</td>
                    </tr>
                    <tr>
                      <th>登録番号</th>
                      <td>{{$user->user_number}}</td>
                    </tr>
                    <tr>
                      <th>
                        名前
                      </th>
                      <td>{{$user->name}}</td>
                    </tr>
                    <tr>
                      <th>
                        メールアドレス
                      </th>
                      <td><a href="mailto:{{$user->email}}">{{$user->email}}</a></td>
                    </tr>
                    <tr>
                      <th>
                        生年月日
                      </th>
                      <td>
                      	{{ getStrDate($user->birth) }}
                      </td>
                    </tr>
                    
                    <tr>
                      <th>
                        所在地
                      </th>
                      <td>{{$user->address}}</td>
                    </tr>
                    
                    <tr>
                      <th>
                        職歴
                      </th>
                      <td>{!! nb($user->work_history) !!}</td>
                    </tr>
                    
                    <tr>
                      <th>
                        役職
                      </th>
                      <td>{!! nb($user->office_posi) !!}</td>
                    </tr>
                    
                    <tr>
                      <th>出張の可否</th>
                      <td>{{$user->is_trip}}</td>
                    </tr>
                    
                    <tr>
                      <th>英語能力</th>
                      <td>{{$user->eng_ability}}</td>
                    </tr>
                    
                    <tr>
                      <th>資格取得年</th>
                      <td>{{$user->get_year == 0 ? '' : $user->get_year.'年'}}</td>
                    </tr>
                    
                    <tr>
                      <th>過去の経験監査業種</th>
                      <td>{!! nb($user->exp_type) !!}</td>
                    </tr>
                    
                    <tr>
                      <th>監査時のポジション</th>
                      <td>{!! nb($user->audit_posi) !!}</td>
                    </tr>
                    
                    <tr>
                      <th>
                        登録日時
                      </th>
                      <td>{{ $user->created_at }}</td>
                    </tr>

                  </tbody>
                </table>
              </div>
  
            
            
             
        @if($jobObjs -> isEmpty())
        <h4 style="margin-bottom: 3em;"><span class="octicon octicon-primitive-dot"></span>応募した案件はありません</h4>
        @else
        <h2 class="page-header"><span class="octicon octicon-primitive-dot"></span>応募した案件</h2> 
			<div class="table-responsive">
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>案件番号</th>
                      <th class="col-md-2">企業名</th>
                      <th class="col-md-4">応募時のコメント</th>
                      <th class="col-md-2">添付ファイル</th>
                      <th class="col-md-2">応募日</th>
                      <th>企業情報</th>
                      
                    </tr>
                  </thead>
                  
                  <tbody>
                    @foreach($jobObjs as $jobObj)
                        <tr>
                            <td><?php $num = DB::table('jobs')->find($jobObj->job_id) -> job_number; ?>
                                {{ $num }}
                            </td>
                            <td>{{ $jobObj->company_name }}</td>
                            
                            <td>
                                {{ $jobObj->note }}<br /><br />
                                {{-- [添付ファイル]：<a href="{{ $jobObj->attach_path }}" class="dlf">{{ $jobObj->attach_name }}</a> --}}
                                
                            </td>
                            
                            <td>
                            	<span>{{ $jobObj->attach_name }}</span><br />
                                
                                @if(isset($jobObj->attach_name))
                                <form id="dlFile" method="post" action="/script/download.php"> {{-- method="post" action="/download.php" --}}
                                
                                	<input type="hidden" name="fPath" value="{{ $jobObj->attach_path }}" />
                                    <input type="hidden" name="fName" value="{{ $jobObj->attach_name }}" />
                                    
                                    <button type="submit" class="dlf">
                                    	<span class="octicon octicon-arrow-down"></span>
                                    </button>
                                </form>
                                @endif
                            </td>
                     
                            <td>
                                {{ getStrDate($jobObj->created_at)}}
                            </td>

                            <td>
                                <a href="{{ getUrl('recruit/job/'. $num) }}" class="btn btn-primary btn-sm center-block" target="_blank">案件を確認</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif  
                

        @if($studyObjs->isEmpty())
        <h4 style="margin-bottom: 3em;"><span class="octicon octicon-primitive-dot"></span>申込みをした勉強会はありません</h4>
        @else
        <h2 class="page-header"><span class="octicon octicon-primitive-dot"></span>参加申し込み勉強会</h2> 
			<div class="table-responsive">
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>勉強会ID</th>
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

                        <td><a href="{{ getUrl('iroha/study/'. $studyObj->iroha_id) }}" class="btn btn-primary btn-sm center-block" target="_blank">勉強会を確認</a></td>
                    </tr>
                @endforeach
                
                    </tbody>
                </table>
            </div>
        
        @endif
        
        <div class="clearfix">
        <a href="{{ getUrl('/dashboard/userinfo') }}" class="btn btn-success btn-sm"><span class="octicon octicon-triangle-left"></span>一覧へ戻る</a>
        </div>
        
@endsection
