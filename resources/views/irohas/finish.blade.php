@extends('app')

@section('content')
	<ul class="breadcrumb">
        <li><a href="{{getUrl('/')}}"><span class="octicon octicon-home"></span>Home</a></li>
        <li><a href="{{getUrl('iroha')}}">監査役いろは</a></li>
        <li><a href="{{getUrl('iroha/study')}}">勉強会一覧</a></li>
        <li><a href="{{getUrl('iroha/study/'.$obj->id)}}">@if($obj->sub_title != ''){{$obj->sub_title}}
        @else{{$obj->title}}@endif</a></li>
        <li>お申し込み（完了）</li>
    </ul>

    <main class="page-ct study-entry">
    	<div class="main-head">
        	<h1 class="panel-head">{{$obj->title}} 参加お申し込み</h1>
            <p></p>
        </div>
        
        @include('shared.move_3')
        
    	<div class="send-end">
            <img src="/images/main/il-comp.png"><br>

            <span>お申し込み完了</span><br><br>
            勉強会の参加お申し込みをお受け致しました。<br>
            確認メールを送信しておりますので、合わせてご確認下さい。
        </div>

        <div>
            <a href="{{ getUrl('/') }}" class="edit-btn"><span class="octicon octicon-mail-reply"></span>HOMEへ</a>
        </div>
    </main>

@endsection