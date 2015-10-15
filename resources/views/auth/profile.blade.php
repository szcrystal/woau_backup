@extends('app')

    @section('content')
    
        <ul class="breadcrumb">
            <li><a href="{{getUrl('/')}}"><span class="octicon octicon-home"></span>Home</a></li>
            <li>ユーザー情報</li>
        </ul>
    
    	@if(isset($authProfile))
    		<h3>管理者用のプロフィールはありません</h3>
    	@else
    	<article class="page-ct">
        	<header>
        	<h1>{{$user->name}} さんのユーザー登録情報</h1>
        	</header>
            @if (session('status'))
                <div class="alert alert-success">
                    <span class="octicon octicon-check"></span> {{ session('status') }}
                </div>
            @endif

        	<section class="userinfo">
            	<div class="clearfix">
                	<a href="{{ url('profile/edit/'.$user->user_number) }}" class="edit-btn pull-right">編集する</a>
                </div>
            
            	<h2>ユーザー情報</h2>

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
                          <th scope="row">ユーザー番号</th>
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
                          	{{--
                            {{$birth[0]=='0000' ? '--' : $birth[0]}}年 
                            {{$birth[1]=='00' ? '--' : $birth[1]}}月 
                            {{$birth[2]=='00' ? '--' : $birth[2]}}日
                            --}}
                            {{ getStrDate($user->birth) }}
                          </td>
                        </tr>
                        
                        <tr>
                          <th scope="row">
                            所在地（住所）
                          </th>
                          <td>{{$user->address}}</td>
                        </tr>
                        
                        <tr>
                          <th scope="row">
                            職歴<br><small>(現在までの職歴,部署,役職等)</small>
                          </th>
                          <td>{{$user->work_history}}</td>
                        </tr>
                        
                        {{--
                        <tr>
                          <th scope="row">
                            役職
                          </th>
                          <td>{{$user->office_posi}}</td>
                        </tr>
                        --}}
                        
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
                          <td>{{$user->get_year == 0 ? '' : $user->get_year . '年'}}</td>
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
                  
			</section>
              
        
        <section id="entry-company">
            <h2>応募した案件</h2> 
            
            @if($jobObjs -> isEmpty())
            <p style="padding-bottom: 2em;">{{$user->name}}さんが応募した案件はまだありません。<br>
            気になる案件がありましたら応募してみましょう。<br>
            <a href="{{getUrl('recruit')}}" class="conf-btn">案件一覧へ »</a></p>
            @else
            <div class="table-responsive">
                <table class="table table-bordered entry-table">
                  <thead>
                    <tr>
                      <th class="col-md-1">企業No</th>
                      <th class="col-md-2">企業名</th>
                      <th class="col-md-3">応募時のコメント</th>
                      <th>添付したファイル</th>
                      <th>応募日</th>
                      <th></th>
                      
                    </tr>
                  </thead>
                  
                  <tbody>
                    @foreach($jobObjs as $jobObj)
                        <tr>
                            <td><?php 
                                $num = DB::table('jobs')->find($jobObj->job_id)-> job_number; ?>
                                {{ $num }}
                            </td>
                            <td>
                                {{ $jobObj->company_name }}
                            </td>
                            
                            <td>
                                {{ $jobObj->note }}
                            </td>
                            <td>
                                {{ $jobObj->attach_name }}
                            </td>                    
                            <td>
                                {{ getStrDate($jobObj->created_at)}}
                            </td>

                            <td> 
                                <a href="{{ getUrl('recruit/job/'. $num) }}" class="conf-btn">案件を<br>確認する</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </section>
         

        <section id="entry-study">
            <h2 class="page-header">申し込みをした勉強会</h2>
            
            @if($studyObjs->isEmpty())
            <p>{{$user->name}}さんが申し込みをした勉強会はまだありません。<br>
            自分に役立つ勉強会を探して、ぜひ参加してみませんか？<br>
            <a href="{{getUrl('iroha/study')}}" class="conf-btn">勉強会一覧へ »</a></p>
            
            @else
            <div class="table-responsive">
                <table class="table table-bordered entry-table">
                  <thead>
                    <tr>
                      <th class="col-md-1">勉強会No</th>
                      <th class="col-md-3">勉強会名</th>
                      <th class="col-md-5">応募時のコメント</th>
                      <th>応募日</th>
                      <th></th>
                    </tr>
                  </thead>
                  
                  <tbody>
                
                    @foreach($studyObjs as $studyObj)
                        <tr>
                            <td>{{ $studyObj->iroha_id }}</td>
                            
                            <td>{{ $studyObj->study_name }}</td>
                            
                            <td>{{ $studyObj->note }}</td>
                                                
                            <td>{{ getStrDate($studyObj->created_at)}}</td>

                            <td><a href="{{ getUrl('iroha/study/'. $studyObj->iroha_id) }}" class="conf-btn">勉強会を<br>確認する</a></td>
                        </tr>
                    @endforeach
                
                    </tbody>
                </table>
            </div>
            @endif
        </section>
        
        
    </article>
        
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
