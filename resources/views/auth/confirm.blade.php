@extends('app')

@section('content')
    <ul class="breadcrumb">
        <li><a href="{{getUrl('/')}}"><span class="octicon octicon-home"></span>Home</a></li>
        <li>新規ユーザー登録（内容確認）</li>
    </ul>
    
    <main class="page-ct register">
    	<div class="main-head">
        	<h1>新規ユーザー登録</h1>
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
                    <td>
                    @if($datas['birth_year'] != '--' && $datas['birth_month'] != '--' && $datas['birth_day'] != '--')
                        {{ $datas['birth_year'] }}年 {{ $datas['birth_month'] }}月 {{ $datas['birth_day'] }}日
                    @endif
                    </td>
                </tr>
                <tr> 
                    <th scope="row">所在地</th>
                    <td>{{ $datas['address'] }}</td>
                </tr>
                <tr> 
                    <th scope="row">職歴</th>
                    <td>{!! nb($datas['work_history']) !!}</td>
                </tr>
                
                {{--
                <tr> 
                    <th scope="row">役職</th>
                    <td>{!! nb($datas['office_posi']) !!}</td>
                </tr>
                --}}
                
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
                    <td>@if($datas['get_year'] != '--'){{ nb($datas['get_year']) }}年@endif</td>
                </tr>
                <tr> 
                    <th scope="row">過去の経験監査業種</th>
                    <td>{!! nb($datas['exp_type']) !!}</td>
                </tr>
                <tr> 
                    <th scope="row">監査時のポジション</th>
                    <td>{!! nb($datas['audit_posi']) !!}</td>
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
            {!! Form::submit('戻 る', ['class'=>'back-btn', 'name' => '_return']) !!}
            {!! Form::submit('送 信', array('class'=>'next-btn', 'name' => '_apply')) !!}
            </div>
            
        {!! Form::close() !!}

        {{-- <a href="{{getUrl('/auth/register')}}" class="btn btn-default">戻る</a> --}}

	</main>
@endsection
