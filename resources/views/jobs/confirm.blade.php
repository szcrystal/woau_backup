@extends('app')

@section('content')
	
    <ul class="breadcrumb">
        <li><a href="{{getUrl('/')}}"><span class="octicon octicon-home"></span>Home</a></li>
        <li><a href="{{getUrl('recruit')}}">求人情報一覧</a></li>
        <li><a href="{{getUrl('recruit/job/'.$obj->job_number)}}">@if($obj->company_name != ''){{$obj->company_name}}
        @else{{$obj->title}}@endif</a></li>
        <li>案件に応募する（内容確認）</li>
    </ul>
    
	<main class="page-ct job-entry">
    	<div class="main-head">
        	<h1>{{$datas['comp_name']}} へ応募</h1>
        </div>    
        
        @include('shared.move_2')
        
        <table class="table-d">
              <colgroup>
                <col class="cth">
                <col class="ctd">
              </colgroup>
              
              <tbody>
                <tr> 
                    <th scope="row">応募企業</th>
                    <td>{{$datas['comp_name']}}</td>
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
                
                <tr> 
                    <th scope="row">添付ファイル名</th>
                    <td>@if(isset($datas['orgName']))
                    {!! nb($datas['orgName']) !!}
                    @endif</td>
                </tr>

              </tbody>
        </table>
                
            
        {!! Form::open(array( 
                        'method' => 'post',
                        //'action'=>'PageController@postContact',
                        //'enctype' => 'multipart/form-data',
                        //'files' => true, 
                    )) !!} {{-- 'url'=>'/finish' --}}
        
            @foreach($datas as $key => $val) 
                @if($key != '_token')
                    {!! Form::hidden($key, $val) !!}
                @endif
            @endforeach
            
            {{-- <input type="file" name="add_file" value="{{$datas['add_file']}}" disabled /> --}}
            
            {!! Form::input('hidden', 'end', TRUE) !!}
            
            <div class="wrap-b">
            {!! Form::submit('戻 る', ['class'=>'back-btn', 'name' => '_return']) !!}
            {!! Form::submit('送 信', array('class'=>'next-btn', 'name' => '_apply')) !!}
            </div>
        
        {!! Form::close() !!}
            
        {{-- <a href="#" class="btn btn-success" onclick="history.back(); return false;">戻る</a> --}}

	</main>
@endsection
