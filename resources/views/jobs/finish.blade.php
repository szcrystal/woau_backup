@extends('app')

    @section('content')
    <div class="job-entry">
    	<h2 class="panel-head"><img src="/images/main/i-job.png">へ応募する</h2>
        
        @include('shared.move_3')
        
    	<div class="send-end">
	        <img src="/images/main/il-comp.png"><br>
	        <span>送信完了</span><br>
    	    ご応募ありがとうございました
    	</div>

        <div>
            <a href="/" class="center-block send-btn">HOMEへ</a>
        </div>
	</div>
    @endsection