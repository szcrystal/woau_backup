@extends('app')

@section('content')
    <ul class="breadcrumb">
        <li><a href="{{getUrl('/')}}"><span class="octicon octicon-home"></span>Home</a></li>
        <li>{{$headTitle}}（内容確認）</li>
    </ul>
    
    <main class="page-ct register">
    	<div class="main-head">
        	<h1 class="panel-head">{{$headTitle}}</h1>
        </div>
        
        @include('shared.move_2')
        
        	<table class="table-d">
              <colgroup>
                <col class="cth">
                <col class="ctd">
              </colgroup>
              
              <tbody>
                
                <tr> 
                    <th scope="row">名前</th>
                    <td>{{ $datas['name'] }}</td>
                </tr>
                <tr> 
                    <th scope="row">メールアドレス</th>
                    <td>{{ $datas['email'] }}</td>
                </tr>
                <tr> 
                    <th scope="row">生年月日</th>
                    <td>{{ $datas['birth_year'] }}年{{ $datas['birth_month'] }}月{{ $datas['birth_day'] }}日</td>
                </tr>
                <tr> 
                    <th scope="row">所在地</th>
                    <td>{{ $datas['address'] }}</td>
                </tr>
                <tr> 
                    <th scope="row">職歴</th>
                    <td>{{ $datas['work_history'] }}</td>
                </tr>
                <tr> 
                    <th scope="row">役職</th>
                    <td>{{ $datas['office_posi'] }}</td>
                </tr>
                <tr> 
                    <th scope="row">出張の可否</th>
                    <td>{{ nb($datas['is_trip']) }}</td>
                </tr>
                <tr> 
                    <th scope="row">英語能力</th>
                    <td>{{ nb($datas['eng_ability']) }}</td>
                </tr>
                <tr> 
                    <th scope="row">公認会計士資格取得年</th>
                    <td>{{ nb($datas['get_year']) }}年</td>
                </tr>
                <tr> 
                    <th scope="row">過去の経験監査業種</th>
                    <td>{{ nb($datas['exp_type']) }}</td>
                </tr>
                <tr> 
                    <th scope="row">監査時のポジション</th>
                    <td>{{ nb($datas['audit_posi']) }}</td>
                </tr>

              </tbody>
            </table>
    

            
        
        {!! Form::open(array( 
            'method' => 'post', 
            //'url'=>'/auth/register/end',
            )) 
        !!}
        
            @foreach($datas as $key => $val) 
                @if($key != '_token')
                    {!! Form::hidden($key, $val) !!}
                @endif
            @endforeach
            
            {!! Form::input('hidden', 'end', TRUE) !!}
            
            <div class="wrap-b">
            {!! Form::submit('送 信', array('class'=>'next-btn pull-left', 'name' => '_apply')) !!}
            {!! Form::submit('戻 る', ['class'=>'back-btn pull-right', 'name' => '_return']) !!}
            </div>
            
        {!! Form::close() !!}
            
            
        {{-- <a href="{{getUrl('/auth/register')}}" class="btn btn-default">戻る</a> --}}

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

	</main>
@endsection
