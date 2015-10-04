<?php 
$isDash = Request::is('dashboard/*');
if($isDash)
	$t = 'appDashBoard'; 
else
	$t = 'app';
?>

@extends($t)

@section('content')

    	<article class="page-ct error404">
        	<header>
        		<h1 class="main-title">エラー：404</h1>
            </header>
            @if($isDash)
            <p>お探しのページがありませんでした。<br><a href="{{getUrl('dashboard/')}}">TOPページ</a>に戻り、再度リンクなどよりお入り直し下さい。</p>
                <a href="{{getUrl('dashboard/')}}" class="btn btn-success">TOPへ</a>
            @else
            <div style="text-align:center;">
            	<img src="{{asset('images/main/il-comp.png')}}">
                <p style="margin: 2em 0; font-size: 1.05em;">お探しのページがありませんでした。<br><a href="{{getUrl('/')}}">TOPページ</a>に戻り、再度リンクなどよりお入り直し下さい。</p>
                <a href="{{getUrl('/')}}" class="edit-btn"><span class="octicon octicon-mail-reply"></span> TOPへ</a>
            </div>
            @endif
        </article>

@endsection
