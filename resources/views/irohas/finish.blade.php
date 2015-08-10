@extends('app')

    @section('content')
    <div class="study-entry">
    	<h2 class="panel-head"><img src="/images/main/i-study.png">勉強会参加お申し込み</h2>
        
        @include('shared.move_3')
        
    	<div class="send-end">
            <img src="/images/main/il-comp.png"><br>

            <span>送信完了</span><br>
            お申し込みありがとうございました
        </div>

        <div>
            <a href="/" class="center-block send-btn">HOMEへ</a>
        </div>
    </div>
    @endsection