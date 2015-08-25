@extends('app')

@section('content')
	<ul class="breadcrumb">
        <li><a href="{{getUrl('/')}}"><span class="octicon octicon-home"></span>Home</a></li>
        <li><a href="{{getUrl('iroha')}}">監査役いろは</a></li>
        <li><a href="{{getUrl('iroha/study')}}">勉強会一覧</a></li>
        <li><a href="{{getUrl('iroha/study/'.$obj->id)}}">@if($obj->sub_title != ''){{$obj->sub_title}}
        @else{{$obj->title}}@endif</a></li>
        <li>お申し込み（内容確認）</li>
    </ul>
        
   <main class="page-ct study-entry">
    	<div class="main-head">
        	<h1 class="panel-head">{{$datas['study_name']}} 参加お申し込み</h1>
            <p></p>
        </div>
        
        @include('shared.move_2')

        <table class="table-d">
            <colgroup>
            	<col class="cth">
            	<col class="ctd">
            </colgroup>
                  
            <tbody>   
                <tr> 
                    <th scope="row">参加勉強会</th>
                    <td>{{$datas['study_name']}}</td>
                </tr>
                <tr> 
                    <th scope="row">名前</th>
                    <td>{{$datas['name']}}</td>
                </tr>
                <tr> 
                    <th scope="row">メールアドレス</th>
                    <td>{{$datas['mail']}}</td>
                </tr>
                <tr> 
                    <th scope="row">コメント</th>
                    <td>{!! nb($datas['note']) !!}</td>
                </tr>
            </tbody>
        </table>
            
            
        {!! Form::open(array( 
                        'method' => 'post',
                        //'action'=>'PageController@postContact' 
                    )) !!} {{-- 'url'=>'/finish' --}}
        
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
            {{-- <a href="{{ getUrl('iroha/entry/'.$datas['iroha_id']) }}" class="btn btn-default">戻 る</a> --}}
        {!! Form::close() !!}


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
