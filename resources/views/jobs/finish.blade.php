@extends('app')

@section('content')

	<ul class="breadcrumb">
        <li><a href="{{getUrl('/')}}"><span class="octicon octicon-home"></span>Home</a></li>
        <li><a href="{{getUrl('recruit')}}">求人情報一覧</a></li>
        <li><a href="{{getUrl('recruit/job/'.$obj->job_number)}}">@if($obj->company_name != ''){{$obj->company_name}}
        @else{{$obj->title}}@endif</a></li>
        <li>案件に応募する（完了）</li>
    </ul>
    
    <main class="page-ct job-entry">
    	<div class="main-head">
        	<h1 class="panel-head">{{$obj->company_name}}へ応募する</h1>
            {{--<img src="/images/main/about/entry.png">--}}
        </div>
                
        @include('shared.move_3')
        
    	<div class="send-end">
	        <img src="{{asset('images/main/il-comp.png')}}"><br>
	        <span>送信完了</span><br>
    	    ご応募ありがとうございました
    	</div>

        <div>
            <a href="{{getUrl('/')}}" class="edit-btn">HOMEへ</a>
        </div>
	</main>
@endsection