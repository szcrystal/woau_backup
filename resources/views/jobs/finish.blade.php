@extends('app')

@section('content')

	<ul class="breadcrumb">
        <li><a href="{{getUrl('/')}}"><span class="octicon octicon-home"></span>Home</a></li>
        <li><a href="{{getUrl('recruit')}}">求人情報一覧</a></li>
        <li><a href="{{getUrl('recruit/job/'.$obj->job_number)}}">@if($obj->sub_title != ''){{$obj->sub_title}}
        @else{{$obj->title}}@endif</a></li>
        <li>応募する（完了）</li>
    </ul>
    
    <main class="page-ct job-entry">
    	<div class="main-head">
        	<h1 class="panel-head">{{$obj->title}}へ応募する</h1>
            {{--<img src="/images/main/about/entry.png">--}}
            <p></p>
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