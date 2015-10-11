@extends('app')

@section('content')

	<ul class="breadcrumb">
        <li><a href="{{getUrl('/')}}"><span class="octicon octicon-home"></span>Home</a></li>
        <li><a href="{{getUrl('recruit')}}">求人情報一覧</a></li>
        <li><a href="{{getUrl('recruit/job/'.$obj->job_number)}}">@if($obj->sub_title != ''){{$obj->sub_title}}
        @else{{$obj->company_name}}@endif</a></li>
        <li>案件に応募（完了）</li>
    </ul>
    
    <main class="page-ct job-entry">
    	<div class="main-head">
        	<h1>{{$obj->company_name}} へ応募</h1>
        </div>
                
        @include('shared.move_3')
        
    	<div class="send-end">
	        <img src="{{asset('images/main/il-comp.png')}}"><br>
	        <span>応募完了</span><br><br>
            案件の応募をお受け致しました。<br>
            確認メールを送信しておりますので、合わせてご確認下さい。
    	</div>

        <div>
            <a href="{{getUrl('/')}}" class="edit-btn"><span class="octicon octicon-mail-reply"></span>HOMEへ</a>
        </div>
	</main>
@endsection